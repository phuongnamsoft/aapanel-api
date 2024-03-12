<?php

namespace PNS\AAPanel\Traits;

trait Site
{
    public function addSite($domain, $path, $desc, $type_id = 0, $type = 'php', $phpversion = '73', $port = '80', $ftp = null, $ftpusername = null, $ftppassword = null, $sql = null, $userdbase = null, $passdbase = null, $setSsl = 0, $forceSsl = 0)
    {
        $completeUrl    = $this->url . '/site?action=AddSite';

        $datajson       = [
            'domain'        => $domain,
            'domainlist'    => [],
            'count'         => 0,
        ];
        $data                   = $this->encrypt();
        $data['webname']        = json_encode($datajson);
        $data['path']           = "/www/wwwroot/" . $path;
        $data['ps']             = $desc;
        $data['type_id']        = $type_id;
        $data['type']           = $type;
        $data['version']        = $phpversion;
        $data['port']           = $port;

        if (isset($ftp)) {
            $data['ftp']            = $ftp;
            $data['ftp_username']   = $ftpusername;
            $data['ftp_password']   = $ftppassword;
        }
        if (isset($sql)) {
            $data['sql']            = $sql;
            $data['datauser']       = $userdbase;
            $data['datapassword']   = $passdbase;
        }

        $data['codeing']        = 'utf8';
        $data['set_ssl']        = $setSsl;
        $data['force_ssl']      = $forceSsl;


        $result         = $this->httpPostCookie($completeUrl, $data);

        return json_decode($result, true);
    }

    /*
     * List of Your Website Project 
     * boolean php | nodejs | pm2 | all
     * ================================
     * TODO: Show all project by default
     */
    public function siteList($limit, $page, $projectType = 'php', $search = null)
    {
        // Show Default Project Site
        switch ($projectType) {
            case 'nodejs':
                $completeUrl        = $this->url . '/project/nodejs/get_project_list';
                break;
            case 'php':
                $completeUrl        = $this->url . '/data?action=getData';
                break;
            case 'pm2':
                $completeUrl        = $this->url . '/plugin?action=a&s=List&name=pm2';
                break;
            default:
                $completeUrl        = $this->url . '/project/nodejs/get_project_list';
                break;
        }

        $data               = $this->encrypt();

        $data['table']      = 'sites';
        $data['limit']      = $limit;
        $data['p']          = $page;
        $data['search']     = $search;
        $data['type']       = '-1';

        $result             = $this->httpPostCookie($completeUrl, $data);

        return json_decode($result, true);
    }

    public function deleteSite($webname, $id)
    {
        $completeUrl    = $this->url . '/site?action=DeleteSite';

        $data               = $this->encrypt();

        $data['ftp']        = "1";
        $data['database']   = "1";
        $data['path']       = "1";
        $data['id']         = $id;
        $data['webname']    = $webname;

        $result         = $this->httpPostCookie($completeUrl, $data);

        return json_decode($result, true);
    }

    public function disableSite($idDomain, $domain, $projectType = 'PHP')
    {
        // Move For 1st Encrypt Do.
        $data           = $this->encrypt();

        // Show Default Project Site
        switch ($projectType) {
            case 'Node':
                $completeUrl    = $this->url . '/project/nodejs/stop_project';
                $data['data']   = json_encode(['project_name' => $domain]);
                break;
            case 'PHP':
                $completeUrl    = $this->url . '/site?action=SiteStop';
                $data['id']     = $idDomain;
                $data['name']   = $domain;
                break;
            default:
                $completeUrl    = $this->url . '/site?action=SiteStop';
                $data['id']     = $idDomain;
                $data['name']   = $domain;
                break;
        }

        $result   = $this->httpPostCookie($completeUrl, $data);

        return json_decode($result, true);
    }

    public function enableSite($idDomain, $domain, $projectType = 'PHP')
    {
        // Move For 1st Encrypt Do.
        $data           = $this->encrypt();

        // Show Default Project Site
        switch ($projectType) {
            case 'Node':
                $completeUrl    = $this->url . '/project/nodejs/start_project';
                $data['data']   = json_encode(['project_name' => $domain]);
                break;
            case 'PHP':
                $completeUrl    = $this->url . '/site?action=SiteStart';
                $data['id']     = $idDomain;
                $data['name']   = $domain;
                break;
            default:
                $completeUrl    = $this->url . '/site?action=SiteStart';
                $data['id']     = $idDomain;
                $data['name']   = $domain;
                break;
        }

        $result         = $this->httpPostCookie($completeUrl, $data);

        return json_decode($result, true);
    }
}