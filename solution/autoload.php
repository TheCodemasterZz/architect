<?php

/**
 * architect - a PHP Framework for rapid developing
 *
 * @package  architect
 * @author   Baris Kalaycioglu <thecodemasterzz@gmail.com>
 */

/*
|--------------------------------------------------------------------------
| Register Start Time of project-bk application
|--------------------------------------------------------------------------
|
| As a microtime, i register PBK-START-TIME variable as a start time of the
| project-bk framework. We can call it back for calculation loading time.
*/

define('PBK-START-TIME', microtime(true));

# @TODO: i must add getting solution routing configuration.

if (PHP_SAPI === 'cli') {
	# @TODO: i will add console application routing
} else {
	$projectName = $_SERVER["SERVER_NAME"];
}	
 
# @TODO: Until creating routing configuration i set projectName as localhost.
# @TODO: after creating and getting routing configuration i will delete code below
$projectName = "localhost";

/*
|--------------------------------------------------------------------------
| Define Paths
|--------------------------------------------------------------------------
|
| I defined some path which can be called anywhere. Root, Solution, Public,
| Vendor, Apps and Application path is defined here. I will move 
| framework path to the vendor when i finish project-bk
*/

define("ROOT_PATH", 				__DIR__ 	. "/../" );
define("FRAMEWORK_PATH", 			ROOT_PATH 	. "framework/" );
define("SOLUTION_PATH", 			ROOT_PATH 	. "solutions/" );
define("PUBLIC_PATH", 				ROOT_PATH 	. "public_html/" );
define("VENDOR_PATH", 				ROOT_PATH 	. "vendor/" );
define("STORAGE_PATH", 				ROOT_PATH 	. "storage/" );
define("PROJECT_PATH", 				ROOT_PATH 	. "applications/" );
define("APPLICATION_PATH", 			ROOT_PATH 	. "applications/{$projectName}/" );
define("PROJECT_NAME", 				$projectName );

if ( !is_file( APPLICATION_PATH."application.php" ) ) 
	die("There is no application called \"{$projectName}\" in your apps folder.");

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

require VENDOR_PATH.'autoload.php';

/*
|--------------------------------------------------------------------------
| Error Handler
|--------------------------------------------------------------------------
|
| Error Handler is set by checking error config parameter in related
| enviroment folder in application config folder path. 
|
*/

$whoops = new Whoops\Run();
$whoops->pushHandler(new Whoops\Handler\PrettyPageHandler());
$whoops->register();  

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