<?php

namespace PNS\AAPanel\Traits;

trait System
{
    public function getSystemInfo($type)
    {
        $completeUrl    = $this->url . '/system?action=' . $type;

        $data           = $this->encrypt();

        $result         = $this->httpPostCookie($completeUrl, $data);

        return json_decode($result, true);
    }

    public function getSystemInfoTotal()
    {
        return $this->getSystemInfo('GetSystemTotal');
    }

    public function getSystemDiskInfo()
    {
        return $this->getSystemInfo('GetDiskInfo');
    }

    public function getSystemNetworkInfo()
    {
        return $this->getSystemInfo('GetNetWork');
    }
}