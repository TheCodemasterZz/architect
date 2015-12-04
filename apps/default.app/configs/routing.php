<?php

/**
* architect - a PHP Framework for rapid developing
*
* @package  architect
* @author   Baris Kalaycioglu <thecodemasterzz@gmail.com>
*/
	
$router->addResource('Products', '/api/products');

$router->addResource('Index', '/');

//Return all routing settings
return $router;
