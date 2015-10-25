<?php
	
/*
|--------------------------------------------------------------------------
| Whoops
|--------------------------------------------------------------------------
|
| whoops is a nice little library that helps you develop and maintain 
| your projects better, by helping you deal with errors and exceptions 
| in a less painful way.
|
*/

use Whoops\Handler\PrettyPageHandler;
use Whoops\Handler\PlainTextHandler;

$run     = new Whoops\Run;
if (PHP_SAPI === 'cli') 
	$handler = new PlainTextHandler;
else
	$handler = new PrettyPageHandler;
	
$run->pushHandler($handler);

// Register the handler with PHP, and you're set!
$run->register();

return $run;