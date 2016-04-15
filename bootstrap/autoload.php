<?php

function _d( $string ) {
    die($string);
}

if (!extension_loaded('phalcon')) {
    _d('Phalcon extension isn\'t installed. Please follow these instructions to install it: http://docs.phalconphp.com/en/latest/reference/install.html');
}

function _if( $path, $name ) {
    $filePath = $path.'/'.(ENVIROMENT == '' ? '' : ENVIROMENT.'/').$name;
    if ( !is_file($filePath) )
        $filePath = $path.'/'.$name;
    return $filePath;
} 

/*
|--------------------------------------------------------------------------
| Define Paths
|--------------------------------------------------------------------------
|
| I defined some path which can be called anywhere. Root, Solution, 
| Public, | Vendor, Apps and Application path is defined here. 
| 
*/

define("ROOT_PATH", realpath( __DIR__."/../") );

$pathConfigs = new \Phalcon\Config(
    include_once __DIR__."/paths.php"
);

define("SOLUTION_PATH", $pathConfigs->solution_path );
define("STORAGE_PATH", $pathConfigs->storage_path );
define("PUBLIC_PATH", $pathConfigs->public_path );
define("VENDOR_PATH", $pathConfigs->vendor_path );
define("GLOBAL_CONFIG_PATH", $pathConfigs->global_config_path );

/*
|--------------------------------------------------------------------------
| Define Application
|--------------------------------------------------------------------------
|
| I define which application is running by using server/console parameters. 
| 
*/

$solutionRouting = new \Phalcon\Config(
    include_once GLOBAL_CONFIG_PATH."routing.php"
);

$configurationName = null;
if (PHP_SAPI === 'cli') {    
    if ( isset( $_SERVER['argv'][1] ) AND strpos($argv[1], "@") !== FALSE  ) {
        $arguments = explode("@", $argv[1]);
        $configurationName = $arguments[0];
    }
} else {
    if ( isset( $_SERVER['SERVER_NAME'] ) ) {
        $configurationName = $_SERVER['SERVER_NAME'];
    }
}

if ( !isset($solutionRouting->routing->$configurationName->name) ) {
    if ( isset( $solutionRouting->routing->default->name ) ) {
        $applicationName = $solutionRouting->routing->default->name;
        $enviromentName = "";
        if ( isset($solutionRouting->routing->default->enviroment) ) {
            $enviromentName = $solutionRouting->routing->default->enviroment;
        }
    } else {
        _d("Solution routing configuration is failed. Please check your application route configurations");
    }
} else {
    $applicationName = $solutionRouting->routing->$configurationName->name;
    $enviromentName = "";
    if ( isset($solutionRouting->routing->$configurationName->enviroment) ) {
        $enviromentName = $solutionRouting->routing->$configurationName->enviroment;
    }
}

define("ENVIROMENT", $enviromentName);
define("APPLICATION_NAME", $applicationName);
define("APPLICATION_PATH", $pathConfigs->solution_path.APPLICATION_NAME."/" );

if ( !is_dir( APPLICATION_PATH ) ) 
    _d("There is no application called \"".APPLICATION_NAME."\" in your apps folder.");

/*
|--------------------------------------------------------------------------
| Register The Composer Auto Loader
|--------------------------------------------------------------------------
|
| Composer provides a convenient, automatically generated class loader
| for our application. We just need to utilize it! We'll require it
| into the script here so that we do not have to worry about the
| loading of any our classes "manually". Feels great to relax.
*/

if ( !is_file( VENDOR_PATH.'autoload.php' ) ) {
    _d("There is no autoload.php in your \"".VENDOR_PATH."\". Please update your vendor folder.");
} else {
    require VENDOR_PATH.'autoload.php';
}

/*
|--------------------------------------------------------------------------
| Di Services 
|--------------------------------------------------------------------------
| Phalcon\Di is a component that implements Dependency Injection/Service 
| Location of services and it”s itself a container for them. 
*/

include_once __DIR__."/services.php";
include_once APPLICATION_PATH."/application.php";
