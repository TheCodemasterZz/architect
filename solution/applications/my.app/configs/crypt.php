<?php

$crypt = new \Phalcon\Crypt();
//Type of cipher algoritm
$crypt->setCipher('RIJNDAEL_256');
//Set a global encryption key
$crypt->setKey('%311.1e$i86e$f!8jz');
//Return crypt
return $crypt;