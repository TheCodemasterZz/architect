<?php

/**
 * architect - a PHP Framework for rapid developing
 *
 * @package  architect
 * @author   Baris Kalaycioglu <thecodemasterzz@gmail.com>
 */

# Global function for getting included file name
function _if($folderName, $fileName, $enviroment = null ) {
	if ( is_null($enviroment) )
		$enviroment = "ENVIRONMENT";
	$file = "{$folderName}{$enviroment}/{$fileName}";
    if (!file_exists($file)) {
		$file = "{$folderName}{$fileName}";
	    if (!file_exists($file))
	    	return false;
    }
	return $file;
}

# Global function for short var_dump
function _dd($object) {
	echo "<pre>";
	var_dump($object);
	echo "</pre>";
	die();
}


# Global function for short echo
function _de($string) {
	die($string);
}

if (!extension_loaded('phalcon')) {
    _de('Phalcon extension isn\'t installed, follow these instructions to install it: http://docs.phalconphp.com/en/latest/reference/install.html');
}

# ROOT PATH is defined.
define("ROOT_PATH", realpath(__DIR__."/../") );

/*
|--------------------------------------------------------------------------
| Solution Config
|--------------------------------------------------------------------------
|
| Get solution config parametrs from config file. This file is one of the 
| important file for the framework configurations
|
*/

$solutionConfig = new \Phalcon\Config(
    include_once _if(__DIR__."/", "solutions.php", "")
);

// The FactoryDefault Dependency Injector automatically registers the
// right services providing a full-stack framework
$di = new \Phalcon\DI\FactoryDefault();

$di->set('solution', function () use ($solutionConfig) {
    return $solutionConfig;
});

/*
|--------------------------------------------------------------------------
| Solution Routing
|--------------------------------------------------------------------------
|
| 
|
*/

if (PHP_SAPI === 'cli') {
	$applicationName = $_SERVER['argv'][1];
	$enviroment = "production";
} else {
	$serverName = $_SERVER['SERVER_NAME'];
	if ( !isset( $solutionConfig->routing->$serverName->name ) ) {
		if ( isset( $solutionConfig->routing->default->name ) ) {
			$applicationName = $solutionConfig->routing->default->name;
			$enviroment = $solutionConfig->routing->default->enviroment;
		} else {
			_de("Solution routing configuration is failed. Please check your configurations");
		}
	} else {
		$applicationName = $solutionConfig->routing->$serverName->name;
		$enviroment = $solutionConfig->routing->$serverName->enviroment;
	}
}	
 
define("ENVIRONMENT", $enviroment);
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

define("SOLUTION_PATH", 	$solutionConfig->solution_path );
define("STORAGE_PATH", 		$solutionConfig->storage_path );
define("APPLICATION_PATH", 	str_replace("{appName}", APPLICATION_NAME, $solutionConfig->application_path) );
define("PUBLIC_PATH", 		$solutionConfig->public_path );
define("VENDOR_PATH", 		$solutionConfig->vendor_path );

/*
|--------------------------------------------------------------------------
| Check Application Path
|--------------------------------------------------------------------------
|
| I am checking whether there is a application in application path or not
| 
*/

if ( !is_file( APPLICATION_PATH."application.php" ) ) 
	_de("There is no application called \"".APPLICATION_NAME."\" in your apps folder.");

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

if (!file_exists(VENDOR_PATH.'autoload.php')) {
	_de("Please run composer update to get files in vendor folder");
}

require VENDOR_PATH.'autoload.php';

/*
|--------------------------------------------------------------------------
| Application Routing
|--------------------------------------------------------------------------
|
| Application routing by looking $_SERVER["SERVER_NAME"] parameter and
| solution config file. However routing may be done in different way if
| you want to develope console application. (command-line application) 
*/

include_once APPLICATION_PATH."application.php";