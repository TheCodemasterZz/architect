<?php

$security = new \Phalcon\Security();
//Set the password hashing factor to 12 rounds
$security->setWorkFactor(12);
return $security;