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


if (PHP_SAPI === 'cli') {
	# @TODO: i will add console application routing
} else {
	$projectName = $_SERVER["SERVER_NAME"];
}	

/*
|--------------------------------------------------------------------------
| Define Paths
|--------------------------------------------------------------------------
|
| I defined some path which can be called anywhere. Root, Solution, Public,
| Vendor, Project and Application path is defined here. I will move 
| framework path to the vendor when i finish project-bk
|
| @TODO: moving framework to the vendor folder. 
*/

define("ROOT_PATH", 				__DIR__ . "/../" );
define("FRAMEWORK_PATH", 			ROOT_PATH . "framework/" );
define("SOLUTION_PATH", 			ROOT_PATH . "solutions/" );
define("PUBLIC_PATH", 				ROOT_PATH . "public_html/" );
define("VENDOR_PATH", 				ROOT_PATH . "vendor/" );
define("PROJECT_PATH", 				ROOT_PATH . "projects/" );
define("APPLICATION_PATH", 			ROOT_PATH . "projects/{$projectName}/" );
define("PROJECT_NAME", 				$projectName );

if ( !is_file( APPLICATION_PATH."application.php" ) ) 
	die("There is no application called \"{$projectName}\" in your projects folder.");

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
| Application Routing
|--------------------------------------------------------------------------
|
| Application routing by looking $_SERVER["SERVER_NAME"] parameter and
| solution config file. However routing may be done in different way if
| you want to develope console application. (command-line application) 
*/


include_once APPLICATION_PATH."application.php";