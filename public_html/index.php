<?php

/**
 * architect - a PHP Framework for rapid developing
 *
 * @package  architect
 * @author   Baris Kalaycioglu <thecodemasterzz@gmail.com>
 */

/*
|--------------------------------------------------------------------------
| Register The Auto Loader
|--------------------------------------------------------------------------
|
| Composer provides a convenient, automatically generated class loader
| for our application. We just need to utilize it! We'll require it
| into the script here so that we do not have to worry about the
| loading of any our classes "manually". Feels great to relax.
|
*/

require '../solution/autoload.php';

/*
|--------------------------------------------------------------------------
| Application Theme
|--------------------------------------------------------------------------
|
| After application routing, template.php is setting here by looking the 
| parameters in app.php config file.
*/

require PUBLIC_PATH.'/templates/'.THEME_NAME.'/template.php';