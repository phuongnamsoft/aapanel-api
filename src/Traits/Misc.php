<?php

namespace PNS\AAPanel\Traits;

trait Misc
{
    public function logs()
    {
        $completeUrl    = $this->url . '/data?action=getData';

        $data           = $this->encrypt();
        $data['table']  = 'logs';
        $data['limit']  = 10;
        $data['tojs']   = 'test';

        $result         = $this->httpPostCookie($completeUrl, $data);

        return json_decode($result, true);
    }

    public function unzip($sourceFile, $destinationFile, $password = null)
    {
        $completeUrl    = $this->url . '/files?action=UnZip';

        $data               = $this->encrypt();
        $data['sfile']      = $sourceFile;
        $data['dfile']      = $destinationFile;
        $data['type']       = 'zip';
        $data['coding']     = 'UTF-8';
        $data['password']   = $password;

        $result         = $this->httpPostCookie($completeUrl, $data);

        return json_decode($result, true);
    }

    public function forceHTTPS($sitename)
    {
        $completeUrl    = $this->url . '/site?action=HttpToHttps';

        $data               = $this->encrypt();

        $data['siteName']   = $sitename;

        $result         = $this->httpPostCookie($completeUrl, $data);

        return json_decode($result, true);
    }

    public function applySSL($domain, $idDomain)
    {
        $completeUrl    = $this->url . '/acme?action=apply_cert_api';

        $data               = $this->encrypt();

        $data['domains']        = '["' . $domain . '"]';
        $data['id']             = $idDomain;
        $data['auth_to']        = $idDomain;
        $data['auth_type']      = 'http';
        $data['auto_wildcard']  = '0';

        $result         = $this->httpPostCookie($completeUrl, $data);
        $result         = json_decode($result, true);

        $urlSSL     = $this->url . '/site?action=SetSSL';

        $data2      = $this->encrypt();

        $data2['type']      = '1';
        $data2['siteName']  = $domain;
        $data2['key']       = $result['private_key'];
        $data2['csr']       = $result['cert'] . ' ' . $result['root'];

        $result2        = $this->httpPostCookie($urlSSL, $data2);

        return json_decode($result2, true);
    }

    public function importDbase($file, $dbasename)
    {
        $completeUrl    = $this->url . '/database?action=InputSql';

        $data               = $this->encrypt();

        $data['file']       = $file;
        $data['name']       = $dbasename;

        $result         = $this->httpPostCookie($completeUrl, $data);

        return json_decode($result, true);
    }

    public function safeFileBody($datafile, $path)
    {
        $completeUrl    = $this->url . '/files?action=SaveFileBody';

        $data               = $this->encrypt();

        $data['data']       = $datafile;
        $data['path']       = $path;
        $data['encoding']   = 'utf-8';

        $result         = $this->httpPostCookie($completeUrl, $data);

        return json_decode($result, true);
    }
}