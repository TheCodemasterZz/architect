<?php

return array(
    
    /*
    |--------------------------------------------------------------------------
    | Solution Path
    |--------------------------------------------------------------------------
    |
    | Container of the applications is setting as solution path. You can set
    | solution path in this config by changing solution_path variable.
    |
    */

	'solution_path' => ROOT_PATH."/apps/",

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

	'application_path' => ROOT_PATH."/apps/{appName}/",

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