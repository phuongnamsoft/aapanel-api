<?php

namespace PNS\AAPanel;

/**
 *  AAPANEL API
 *
 *  Use this section to define what this class is doing, the PhpDocumentor will use this
 *  to automatically generate the API documentation
 *
 *  @author Nam Nguyen
 * @package phuongnamsoft/aapanel-api
 */
class AAPanel
{
    use Traits\Site;
    use Traits\Domain;
    use Traits\Misc;
    use Traits\System;
    use Traits\Task;

    protected $key = null;
    protected $url = null;

    public function __construct($url, $key)
    {
        $this->key = $key;
        $this->url = $url;
    }

    private function encrypt()
    {
        $unixTime = time();
        return [
            'request_token' => md5($unixTime . md5($this->key)),
            'request_time' => $unixTime,
        ];
    }

    private function httpPostCookie($url, $data, $timeout = 60)
    {
        //Define where cookies are saved
        $cookieFile = sys_get_temp_dir() . DIRECTORY_SEPARATOR . md5($this->url) . '.cookie';
        if (!file_exists($cookieFile)) {
            $fp = fopen($cookieFile, 'w+');
            fclose($fp);
        }

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_TIMEOUT, $timeout);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_COOKIEJAR, $cookieFile);
        curl_setopt($ch, CURLOPT_COOKIEFILE, $cookieFile);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $output = curl_exec($ch);
        curl_close($ch);

        return $output;
    }
}
