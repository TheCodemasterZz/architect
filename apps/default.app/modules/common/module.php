<?php

/**
 * architect - a PHP Framework for rapid developing
 *
 * @package  architect
 * @author   Baris Kalaycioglu <thecodemasterzz@gmail.com>
 */

namespace Modules\Common;

use Phalcon\Loader;
use Phalcon\Mvc\View;
use Phalcon\DiInterface;
use Phalcon\Mvc\Dispatcher;
use Phalcon\Mvc\ModuleDefinitionInterface;

class Module implements ModuleDefinitionInterface
{
    /**
     * Register a specific autoloader for the module
     */
    public function registerAutoloaders(DiInterface $dependencyInjector = null)
    {
        $loader = new Loader();

        $loader->registerNamespaces(
            array(
                'Modules\Common\Controllers' => __DIR__ . '/controllers/',
                'Modules\Common\Models'      => __DIR__ . '/models/',
            )
        );

        $loader->register();
    }

    /**
     * Register specific services for the module
     */
    public function registerServices(DiInterface $di)
    {
        // Registering a dispatcher
        $di->set('dispatcher', function () {
            $dispatcher = new Dispatcher();
            $dispatcher->setDefaultNamespace("Modules\Common\Controllers");
            return $dispatcher;
        });

        // Setting up the view component
        $view = $di->get('view');
        $view->setViewsDir( __DIR__ . '/views/');
        $di->set('view', $view);
    }
}