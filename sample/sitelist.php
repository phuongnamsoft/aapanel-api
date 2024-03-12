<?php
use PNS\AApanel\AApanel;

$aapanel = new AApanel;

$aapanel->key = 'z6jcyJFMRgJCWNdyHelgi5ilrCbsHO19';
$aapanel->url = 'http://192.168.2.12:7800';


var_dump($aapanel->siteList(10, 1));
