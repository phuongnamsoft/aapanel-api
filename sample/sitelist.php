<?php
use PNS\AAPanel\AAPanel;

$aapanel = new AAPanel;

$aapanel->key = 'z6jcyJFMRgJCWNdyHelgi5ilrCbsHO19';
$aapanel->url = 'http://192.168.2.12:7800';


var_dump($aapanel->siteList(10, 1));
