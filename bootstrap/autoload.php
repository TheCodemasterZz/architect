<?php

/**
 * architect - a PHP Framework for rapid developing
 *
 * @package  architect
 * @author   Baris Kalaycioglu <thecodemasterzz@gmail.com>
 */

if (!extension_loaded('phalcon')) {
    _d('Phalcon extension isn\'t installed. Please follow these instructions to install it: http://docs.phalconphp.com/en/latest/reference/install.html');
}

# ROOT PATH is defined.
define("ROOT_PATH", realpath( __DIR__."/../") );

# The FactoryDefault Dependency Injector automatically registers the right services providing a full-stack framework
if (PHP_SAPI === 'cli') {
	$di = new \Phalcon\DI\FactoryDefault\CLI();
} else {
	$di = new \Phalcon\DI\FactoryDefault();
}

$pathConfigs = new \Phalcon\Config(
    include_once __DIR__."/paths.php"
);

$applicationRouting = new \Phalcon\Config(
    include_once __DIR__."/route.php"
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

if ( !isset($applicationRouting->routing->$configurationName->name) ) {
	if ( isset( $applicationRouting->routing->default->name ) ) {
		$applicationName = $applicationRouting->routing->default->name;
	} else {
		_d("Solution routing configuration is failed. Please check your application route configurations");
	}
} else {
	$applicationName = $applicationRouting->routing->$configurationName->name;
}

define("APPLICATION_NAME", $applicationName);

/*
|--------------------------------------------------------------------------
| Define Paths
|--------------------------------------------------------------------------
|
| I defined some path which can be called anywhere. Root, Solution, 
| Public, | Vendor, Apps and Application path is defined here. 
| 
*/

define("SOLUTION_PATH", 	$pathConfigs->solution_path );
define("STORAGE_PATH", 		$pathConfigs->storage_path );
define("APPLICATION_PATH", 	$pathConfigs->solution_path.APPLICATION_NAME."/" );
define("PUBLIC_PATH", 		$pathConfigs->public_path );
define("VENDOR_PATH", 		$pathConfigs->vendor_path );

/*
|--------------------------------------------------------------------------
| Check Application Path
|--------------------------------------------------------------------------
|
| I am checking whether there is a application in application path or not
| 
*/

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
| Application Routing
|--------------------------------------------------------------------------
|
| Application routing by looking $_SERVER["SERVER_NAME"] parameter and
| solution config file. However routing may be done in different way if
| you want to develope console application. (command-line application) 
*/

include_once __DIR__."\application.php";