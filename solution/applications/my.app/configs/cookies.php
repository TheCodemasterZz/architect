<?php

$cookies = new \Phalcon\Http\Response\Cookies();
$cookies->useEncryption(false);
return $cookies;