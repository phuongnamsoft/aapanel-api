<?php

namespace PNS\AAPanel\Traits;

trait Task
{
    public function getTaskCount()
    {
        $completeUrl    = $this->url . '/ajax?action=GetTaskCount';

        $data           = $this->encrypt();

        $result         = $this->httpPostCookie($completeUrl, $data);

        return json_decode($result, true);
    }
}