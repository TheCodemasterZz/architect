<?php

/**
 * architect - a PHP Framework for rapid developing
 *
 * @package  architect
 * @author   Baris Kalaycioglu <thecodemasterzz@gmail.com>
 */

//Router class is loaded
$router = new \Phalcon\CLI\Router();

$router->handle(array(
    'task' => 'main',
    'action' => 'main'
));

//Return all routing settings
return $router;