<?php

/**
 * architect - a PHP Framework for rapid developing
 *
 * @package  architect
 * @author   Baris Kalaycioglu <thecodemasterzz@gmail.com>
 */

# @TODO: i must add getting solution routing configuration.

$applicationFile = "application";

# Global function for file including if exists.
function _gf($folderName, $fileName) {
	$file = "{$folderName}" . ENVIRONMENT . "/{$fileName}";
    if (!file_exists($file)) {
		$file = "{$folderName}{$fileName}";
	    if (!file_exists($file))
	    	return false;
    }
	return $file;
}

if (PHP_SAPI === 'cli') {
	# @TODO: i will add console application routing
} else {
	$projectName = $_SERVER["SERVER_NAME"];
}	
 
# @TODO: Until creating routing configuration i set projectName as localhost.
# @TODO: after creating and getting routing configuration i will delete code below
$projectName = "my.app";

define("PROJECT_NAME", $projectName );

/*
|--------------------------------------------------------------------------
| Define Paths
|--------------------------------------------------------------------------
|
| I defined some path which can be called anywhere. Root, Solution, Public,
| Vendor, Apps and Application path is defined here. I will move 
| framework path to the vendor when i finish project-bk
*/

define("ROOT_PATH", __DIR__."/../" );
define("SOLUTION_PATH", ROOT_PATH."solution/" );
define("STORAGE_PATH", ROOT_PATH."storage/" );
define("APPLICATION_PATH", SOLUTION_PATH."applications/{$projectName}/" );
define("PUBLIC_PATH", ROOT_PATH."public_html/" );
define("VENDOR_PATH", ROOT_PATH."vendor/" );

if ( !is_file( APPLICATION_PATH."{$applicationFile}.php" ) ) 
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
| Application Routing
|--------------------------------------------------------------------------
|
| Application routing by looking $_SERVER["SERVER_NAME"] parameter and
| solution config file. However routing may be done in different way if
| you want to develope console application. (command-line application) 
*/

include_once APPLICATION_PATH."{$applicationFile}.php";

return;

$fileContent = file_get_contents(APPLICATION_PATH."{$applicationFile}.php");
$newFileName = APPLICATION_PATH . "application.compiled.php";

if (!file_exists($newFileName)) {

	$regexp = "<a\s[^>]*href=(\"??)([^\" >]*?)\\1[^>]*>(.*)<\/a>";
	$regexp = 'return include_once _gf\(([^)>]*?)[,]([, ])\"([^)>]*?)\"\);';
	if(preg_match_all("/$regexp/siU", $fileContent, $matches)) {

		$i = 0;
		foreach ($matches[0] as $key => $value) {
			$matches[1][$i] = str_replace(".", "", $matches[1][$i]);
			$matches[1][$i] = str_replace("\"", "", $matches[1][$i]);
			$matches[1][$i] = str_replace("APPLICATION_PATH", APPLICATION_PATH, $matches[1][$i]);
			$configContent = file_get_contents( _gf($matches[1][$i], $matches[3][$i] ) );
			$configContent = str_replace("<?php", "", $configContent);
			$configContent = str_replace("<?", "", $configContent);
			$configContent = str_replace("?>", "", $configContent);
			$fileContent = str_replace($matches[0][$i], $configContent, $fileContent);

			$i += 1;
		}
	}

	$fh = fopen($newFileName, 'w') or die("can't open file");
	fwrite($fh, $fileContent);
	fclose($fh);
}

include_once APPLICATION_PATH."{$applicationFile}.php";