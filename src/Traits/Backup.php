<?php

namespace PNS\AAPanel\Traits;

trait Backup
{
    public function getListBackups($siteId, $page = 1, $limit = 10)
    {
        $completeUrl    = $this->url . '/data?action=getData&table=backup';

        $data           = $this->encrypt();
        $data['type']  = 0;
        $data['p']  = $page;
        $data['limit']  = $limit;
        $data['tojs']   = 'get_site_backup';
        $data['search'] = $siteId;

        $result         = $this->httpPostCookie($completeUrl, $data);

        return json_decode($result, true);
    }
}