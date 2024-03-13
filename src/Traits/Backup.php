<?php

namespace PNS\AAPanel\Traits;

trait Backup
{
    public function getListBackups($siteId, $page = 1, $limit = 10)
    {
        $data = $this->encrypt();
        $data['type']  = 0;
        $data['p']  = $page;
        $data['limit'] = $limit;
        $data['tojs'] = 'get_site_backup';
        $data['search'] = $siteId;

        $result = $this->httpPostCookie($this->url . '/data?action=getData&table=backup', $data);

        return json_decode($result, true);
    }
}