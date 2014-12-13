<?php

/**
 * architect - a PHP Framework for rapid developing
 *
 * @package  architect
 * @author   Baris Kalaycioglu <thecodemasterzz@gmail.com>
 */

$router->setUriSource(\Phalcon\Mvc\Router::URI_SOURCE_GET_URL); 
$router->setUriSource(\Phalcon\Mvc\Router::URI_SOURCE_SERVER_REQUEST_URI); 

$router->setDefaultModule('dashboard');
$router->setDefaultNamespace('Multiple\Dashboard\Controllers');

$router->add('/dashboard', array(
    'module' => 'dashboard',
    'action' => 'index',
    'params' => 'index'
));

//Read the annotations from UsersController if the uri starts with /api/users
$router->addModuleResource('dashboard', 'Multiple\Dashboard\Controllers\Users');

//Return all routing settings
return $router;