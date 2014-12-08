<?php

/**
 * architect - a PHP Framework for rapid developing
 *
 * @package  architect
 * @author   Baris Kalaycioglu <thecodemasterzz@gmail.com>
 */

namespace Multiple\Dashboard2;

class Module extends \Application
{
	public function registerAutoloaders()
	{
		$loader = new \Phalcon\Loader();
		$loader->registerNamespaces(array(
			"Multiple\Dashboard2\Controllers" 	=> $this->getFolder( APPLICATION_PATH . 'modules/dashboard2/controllers/' ),
			"Multiple\Dashboard2\Models" 		=> $this->getFolder( APPLICATION_PATH . 'modules/dashboard2/models/' ),
		));

		$loader->register();
	}

	public function registerServices($di)
	{
		//Registering a dispatcher
		$di->set('dispatcher', function() {
			$dispatcher = new \Phalcon\Mvc\Dispatcher();
			//Attach a event listener to the dispatcher
			$eventManager = new \Phalcon\Events\Manager();
			$eventManager->attach('dispatch', new \Acl('dashboard2'));
			$dispatcher->setEventsManager($eventManager);
			$dispatcher->setDefaultNamespace("Multiple\Dashboard2\Controllers\\");
			return $dispatcher;
		});

		//Registering the view component
		$di->set('view', function() {
			$view = new \Phalcon\Mvc\View();
			$view->setViewsDir(APPLICATION_PATH . 'modules/dashboard2/views/');
			$view->registerEngines(array(
				'.volt' => function($view, $di) {
					$volt = new \Phalcon\Mvc\View\Engine\Volt($view, $di);
					$volt->setOptions(array(
						'compiledPath' => STORAGE_PATH . 'cache/',
						'compiledSeparator' => '_',
	       				'compiledExtension' => '.compiled'
					));
					return $volt;
				}
			));
			return $view;
		});

	}

}