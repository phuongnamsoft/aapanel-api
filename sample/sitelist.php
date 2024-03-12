<?php
use PNS\AAPanel\AAPanel;

$key = 'z6jcyJFMRgJCWNdyHelgi5ilrCbsHO19';
$url = 'http://192.168.2.12:7800';

$aapanel = new AAPanel($key, $url);

var_dump($aapanel->siteList(10, 1));
