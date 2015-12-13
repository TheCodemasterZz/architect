<?php

/**
* architect - a PHP Framework for rapid developing
*
* @package  architect
* @author   Baris Kalaycioglu <thecodemasterzz@gmail.com>
*/

$router->add(
    "/:module/:controller/:action/:params",
    array(
        "module" => 1,
		'controller' => 2,
		'action' => 3,
		'params' => 4,
    )
);

//Return all routing settings
return $router;
