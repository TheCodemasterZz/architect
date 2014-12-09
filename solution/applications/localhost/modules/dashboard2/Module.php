<?php

/**
 * architect - a PHP Framework for rapid developing
 *
 * @package  architect
 * @author   Baris Kalaycioglu <thecodemasterzz@gmail.com>
 */

namespace Multiple\Dashboard;

use \Phalcon\Loader,
    \Phalcon\Mvc\Dispatcher,
    \Phalcon\Mvc\View,
    \Phalcon\Mvc\ModuleDefinitionInterface;

class Module implements ModuleDefinitionInterface
{
	public function registerautoloaders() 
	{
        $loader = new Loader();

        $loader->registerNamespaces(
            array(
                'Multiple\Dashboard2\Controllers' => APPLICATION_PATH . 'modules/dashboard2/controllers/',
                'Multiple\Dashboard2\Models'      => APPLICATION_PATH . 'modules/dashboard2/models/',
            )
        );

        $loader->register();
    }

	public function registerServices($di)
	{

        //Registering a dispatcher
        $di->set('dispatcher', function() {
            $dispatcher = new Dispatcher();
            $dispatcher->setDefaultNamespace('Multiple\Dashboard2\Controllers');
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