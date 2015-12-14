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
    | Public Path
    |--------------------------------------------------------------------------
    |
    | Container of the assets is setting as public path. You can set public
    | path in this config by changing public_path variable.
    |
    */

    'public_path' => ROOT_PATH."/public/",

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

    /*
    |--------------------------------------------------------------------------
    | Global Config Path
    |--------------------------------------------------------------------------
    |
    | Global config is used to define solution routing, paths etc.
    |
    */

    'global_config_path' => ROOT_PATH."/configs/",
);