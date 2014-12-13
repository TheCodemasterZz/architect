<?php

/**
 * architect - a PHP Framework for rapid developing
 *
 * @package  architect
 * @author   Baris Kalaycioglu <thecodemasterzz@gmail.com>
 */

namespace Multiple\Dashboard;

use \Phalcon\Mvc\View,
    \Phalcon\Mvc\ModuleDefinitionInterface;

class Module implements ModuleDefinitionInterface
{
	public function registerautoloaders() {}

	public function registerServices($di)
	{
        //Geting view settings from application
		$view = $di->get('view');

		//Registering the view component
		$di->set('view', function() use ($view) {
			$view->setViewsDir(APPLICATION_PATH.'modules/dashboard/views/');
			$view->registerEngines( $view->getRegisteredEngines() );
			return $view;
		});

	}

}