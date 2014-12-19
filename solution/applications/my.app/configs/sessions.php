<?php

$session = new \Phalcon\Session\Adapter\Files();

$session->start();

return $session;