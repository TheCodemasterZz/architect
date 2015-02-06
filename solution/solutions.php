<?php

return array(
    
    /*
    |--------------------------------------------------------------------------
    | Solution Routing
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
    |   "name"          => "my.local.app",
    |   "enviroment"    => "development"
    | )
    |
    */

	'routing' => array(
		"default" => array(
			"name" 			=> "my.app",
            "enviroment"    => "production"
		)
	),

    /*
    |--------------------------------------------------------------------------
    | Solution Path
    |--------------------------------------------------------------------------
    |
    | Container of the applications is setting as solution path. You can set
    | solution path in this config by changing solution_path variable.
    |
    */

	'solution_path' => ROOT_PATH."/solution",

    /*
    |--------------------------------------------------------------------------
    | Storage Path
    |--------------------------------------------------------------------------
    |
    | Container of the framework cache, database, logs, session, task cache
    | and uploaded files for every application is setting as storage path.
    | You can set solution path in this config by changing solution_path 
    | variable.
    |
    */

	'storage_path' => ROOT_PATH."/storage/",

    /*
    |--------------------------------------------------------------------------
    | Application Path
    |--------------------------------------------------------------------------
    |
    | Container of the application files is setting as application path. You
    | can set application path in this config by changing application_path
    | variable.
    |
    */

	'application_path' => ROOT_PATH."/solution/{appName}/",

    /*
    |--------------------------------------------------------------------------
    | Public Path
    |--------------------------------------------------------------------------
    |
    | Container of the assets is setting as public path. You can set public
    | path in this config by changing public_path variable.
    |
    */

	'public_path' => ROOT_PATH."/public_html/",

    /*
    |--------------------------------------------------------------------------
    | Vendor Path
    |--------------------------------------------------------------------------
    |
    | Container of the vendor files is setting as vendor path. You can set 
    | vendor path in this config by changing vendor_path variable.
    |
    */

	'vendor_path' => ROOT_PATH."/vendor/",
);