<?php
 

//Read the annotations from ProductsController if the uri starts with /api/products
$router->addResource('Modules\Dashboard\Controllers\Index', '/api/users');

//Return all routing settings
return $router;