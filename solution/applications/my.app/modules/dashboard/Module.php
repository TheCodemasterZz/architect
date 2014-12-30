<?php

/**
 * architect - a PHP Framework for rapid developing
 *
 * @package  architect
 * @author   Baris Kalaycioglu <thecodemasterzz@gmail.com>
 */

namespace Modules\Dashboard;

use \Phalcon\Mvc\View,
    \Phalcon\Mvc\ModuleDefinitionInterface;

class Module implements ModuleDefinitionInterface
{
	public $moduleName = "dashboard";

	public function registerautoloaders() {}

	public function registerServices($di)
	{
        //Geting view settings from application
		$view = $di->get('view');

		//Registering the view component
		$di->set('view', function() use ($view) {
			$view->setViewsDir(APPLICATION_PATH."modules/{$this->moduleName}/views/");
			$view->registerEngines( $view->getRegisteredEngines() );
			return $view;
		});

	    //Dispatcher configuration is setted
	    $di->set('dispatcher', function() use ($di) {
	        //Obtain the standard eventsManager from the DI
	        $eventsManager = $di->getShared('eventsManager');
	        //Dispatcher is setting
	        $dispatcher = new \Phalcon\Mvc\Dispatcher();
	        //Bind the EventsManager to the Dispatcher
	        $dispatcher->setEventsManager($eventsManager);
	        //Return dispatcher
	        return $dispatcher;
	    });
	}

}