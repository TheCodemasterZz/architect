<?php

return array(
    
    /*
    |--------------------------------------------------------------------------
    | Application Routing
    |--------------------------------------------------------------------------
    | 
    | This is simple application routing. It is cheking the config file and  
    | server variables $_SERVER['SERVER_NAME']. default app is a MUST.
    |
    | Enviroment is a which can be usa for all php files which can be included
    | in the framework. Like configs, controller, models, seeds etc.
    |
    | You can at local.dev domain as the example below.
    |
    | "local.dev" => array(
    |   "name" => "my.local.app",
    |   "enviroment" => "development"
    | )
    |
    */

    'routing' => array(
        "default" => array(
            "name" => "default.app",
            "enviroment" => "dev"
        )
    )
);