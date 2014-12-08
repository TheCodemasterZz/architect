<?php

/**
 * architect - a PHP Framework for rapid developing
 *
 * @package  architect
 * @author   Baris Kalaycioglu <thecodemasterzz@gmail.com>
 */

class Application extends \Phalcon\Mvc\Application
{
	public $content;
	public $environment;

	protected function _registerServices()
	{
		$di = new \Phalcon\DI\FactoryDefault();
		$loader = new \Phalcon\Loader();
		/**
		 * We're a registering a set of directories taken from the configuration file
		 */
		$loader->registerDirs(
			array(
				APPLICATION_PATH . '/libraries/'
			)
		)->register();

		//Registering a router
		$di->set('router', function(){
			$router = new \Phalcon\Mvc\Router\Annotations(false);

			//Router configurations
			$routerConfigFile = $this->getFile(APPLICATION_PATH . "configs/", "router.php");
			include_once $routerConfigFile;
			return $router;
		});

		$this->setDI($di);
	}

	public function main($environment)
	{
		$this->environment = $environment;

		$this->_registerServices();
		//Modules configurations
		$moduleConfigFile = $this->getFile(APPLICATION_PATH . "configs/", "modules.php");
		//Register the installed modules
		$this->registerModules( include_once $moduleConfigFile );

		$this->content = $this->handle()->getContent();
	}

	public function getFile($folderPath, $file)
	{
		$filePath = "{$folderPath}{$this->environment}/{$file}";
		if ( is_file($filePath) )
			return $filePath;
		return "{$folderPath}/{$file}";
	}

	public function getFolder($folderPath)
	{
		$newFolderPath = "{$folderPath}{$this->environment}";
		if ( is_file($newFolderPath) )
			return $newFolderPath;
		return "{$folderPath}";
	}
}

define("BASE_URL",	"http://project-bk/");
define("THEME_NAME", 	"default" );
define("ENVIRONMENT", 	"development" );

$application = new Application();
$application->main(ENVIRONMENT);