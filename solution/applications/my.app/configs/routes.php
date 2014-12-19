<?php

//Router class is loaded
$router = new \Phalcon\Mvc\Router\Annotations(false);

$router->setUriSource(\Phalcon\Mvc\Router::URI_SOURCE_GET_URL); 
$router->setUriSource(\Phalcon\Mvc\Router::URI_SOURCE_SERVER_REQUEST_URI); 

$router->setDefaultModule('dashboard');
$router->setDefaultNamespace('Modules\Dashboard\Controllers');

$router->add('/dashboard', array(
    'module' => 'dashboard',
    'action' => 'index',
    'params' => 'index'
));

//Read the annotations from UsersController if the uri starts with /api/users
$router->addModuleResource('dashboard', 'Modules\Dashboard\Controllers\Users');

//Return all routing settings
return $router;