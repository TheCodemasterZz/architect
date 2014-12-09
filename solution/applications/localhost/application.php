<?php

/**
 * architect - a PHP Framework for rapid developing
 *
 * @package  architect
 * @author   Baris Kalaycioglu <thecodemasterzz@gmail.com>
 */

use Phalcon\Loader,
    Phalcon\Mvc\Router,
    Phalcon\Mvc\Application,
    Phalcon\DI\FactoryDefault;

try {

	$loader = new Loader();

	$loader->registerNamespaces(
	    array(
	        "Multiple\Dashboard\Controllers"	=> APPLICATION_PATH . 'modules/dashboard/controllers/',
	        "Multiple\Dashboard\Models"	=> APPLICATION_PATH . 'modules/dashboard/models/',
	        "Multiple\Dashboard2\Controllers"	=> APPLICATION_PATH . 'modules/dashboard2/controllers/',
	        "Multiple\Dashboard2\Models"	=> APPLICATION_PATH . 'modules/dashboard2/models/'
	    )
	);

	$loader->register();

	$di = new FactoryDefault();

	$di->set('router', function () {
		//Router class is loaded
		$router = new \Phalcon\Mvc\Router\Annotations(false);

		$router->setUriSource(\Phalcon\Mvc\Router::URI_SOURCE_GET_URL); 
		$router->setUriSource(\Phalcon\Mvc\Router::URI_SOURCE_SERVER_REQUEST_URI); 

		$router->setDefaultModule('dashboard');
		$router->setDefaultNamespace('Multiple\Dashboard\Controllers');

		$router->add('/dashboard', array(
		    'module' => 'dashboard',
		    'action' => 'index',
		    'params' => 'index'
		));

		$router->add('/dashboard2', array(
		    'module' => 'dashboard2',
		    'action' => 'index',
		    'params' => 'index'
		));

		//Read the annotations from UsersController if the uri starts with /api/users
		$router->addModuleResource('dashboard', 'Multiple\Dashboard\Controllers\Users');

		//Return all routing settings
		return $router;
	});


	//Create an application
	$application = new \Phalcon\Mvc\Application($di);

	//Modules configurations
	$moduleConfigFile = APPLICATION_PATH . "configs/modules.php";

	// Register the installed modules
	$application->registerModules(
		include_once $moduleConfigFile
	);

	//Handle the request
    define('CONTENT', $application->handle()->getContent() );

} catch(\Exception $e) {
    throw new Exception($e->getMessage());
    
}
define("BASE_URL",	"http://project-bk/");
define("THEME_NAME", 	"default" );
define("ENVIRONMENT", 	"development" );