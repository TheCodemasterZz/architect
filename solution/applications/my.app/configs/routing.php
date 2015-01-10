<?php
 
//Read the annotations from UsersController if the uri starts with /api/users
$router->addResource('RefCities', '/api/ref/cities');

//Return all routing settings
return $router;