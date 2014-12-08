<?php

/**
 * architect - a PHP Framework for rapid developing
 *
 * @package  architect
 * @author   Baris Kalaycioglu <thecodemasterzz@gmail.com>
 */

$router->setDefaultModule("dashboard");

$router->setUriSource(\Phalcon\Mvc\Router::URI_SOURCE_GET_URL); 
$router->setUriSource(\Phalcon\Mvc\Router::URI_SOURCE_SERVER_REQUEST_URI); 

$router->add('/:controller/:action', array(
	'module' => 'dashboard',
	'controller' => 1,
	'action' => 2,
));

//Read the annotations from ProductsController if the uri starts with /api/products
$router->addModuleResource('dashboard', 'Products', '/api/products');

$router->add("/login", array(
	'module' => 'dashboard2',
	'controller' => 'index',
	'action' => 'index',
));

return $router;