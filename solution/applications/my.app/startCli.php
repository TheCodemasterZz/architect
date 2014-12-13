<?php

/**
 * architect - a PHP Framework for rapid developing
 *
 * @package  architect
 * @author   Baris Kalaycioglu <thecodemasterzz@gmail.com>
 */


define("BASE_URL",  "http://project-bk/");
define("THEME_NAME",    "default" );
define("ENVIRONMENT",   "development" );

define('VERSION', '1.0.0');

try {

    $config = new \Phalcon\Config(
        require APPLICATION_PATH."configs/app.php"
    );

    /*
    |--------------------------------------------------------------------------
    | Error Handler
    |--------------------------------------------------------------------------
    |
    | Error Handler is set by checking error config parameter in related
    | enviroment folder in application config folder path. 
    |
    */

    $whoops = new Whoops\Run();
    $whoops->pushHandler(new Whoops\Handler\PlainTextHandler());
    $whoops->register();  
    
    //Create a FactoryDefault
    $di = new \Phalcon\DI\FactoryDefault\CLI();
    
    //Create an Application
    $application = new \Phalcon\CLI\Console($di);

    //TODO: hepsini istersem yükle yapacağım.

    //TODO: Config yapılacak
    $di->set('config', function (){
        return new ArrayObject(array(), ArrayObject::ARRAY_AS_PROPS);
    });

    //Setup the database service
    $di->set('db', function(){
        return include_once APPLICATION_PATH . "configs/databases.php";
    });

    //Start the session the first time a component requests the session service
    $di->set('session', function() {
        return include_once APPLICATION_PATH . "configs/sessions.php";
    });

    //Registering the asset component
    $di->set('assets', function () {
        return new Phalcon\Assets\Manager();
    }, true);

    //Registering the url component
    $di->set('url', function () {
        return new Phalcon\Mvc\Url();
    }, true);

    //Registering the crypt component
    $di->set('crypt', function () {
        $crypt = new Phalcon\Crypt();
        //Type of cipher algoritm
        $crypt->setCipher('RIJNDAEL_256');
        //Set a global encryption key
        $crypt->setKey('%311.1e$i86e$f!8jz');
        //Return crypt
        return $crypt;
    }, true);

    //Registering the security component
    $di->set('security', function(){
        $security = new Phalcon\Security();
        //Set the password hashing factor to 12 rounds
        $security->setWorkFactor(12);
        return $security;
    }, true);

    //Registering the translate component
    $di->set('translate', function(){
        $language = "tr";

        if (file_exists(APPLICATION_PATH.'resources/languages/'.$language.".php"))
            require APPLICATION_PATH.'resources/languages/'.$language.".php";
        else
            require APPLICATION_PATH.'resources/languages/en.php';

        return new \Phalcon\Translate\Adapter\NativeArray(array(
            "content" => $messages
        ));
    });

    //Registering the view component
    $di->set('view', function() {
        $view = new \Phalcon\Mvc\View();
        $view->setLayoutsDir('../../../resources/layouts/');
        $view->setLayout('_layout');
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

    //Routing configuration is setted
    $di->set('router', function () {
        //Routing configuration file
        $routeConfigFile = APPLICATION_PATH . "configs/consoleRoutes.php";
        //Return all routing settings
        return include_once $routeConfigFile;
    });

    //Using an anonymous function, the instance will be lazy loaded
    $di->set("request", function() {
        return new \Phalcon\Http\Request();
    });

    //Validation configuration is setted
    $di->set("validation", function() {
        $validation = new \Phalcon\Validation();
        return $validation;
    });

    //Filter configuration is setted
    $di->set("filter", function() {
        $filter = new \Phalcon\Filter();
        return $filter;
    });

    //Dispatcher configuration is setted
    $di->set('dispatcher', function() use ($di) {
        //Obtain the standard eventsManager from the DI
        $eventsManager = $di->getShared('eventsManager');
        //Dispatcher is setting
        $dispatcher = new Phalcon\Cli\Dispatcher();
        //Bind the EventsManager to the Dispatcher
        $dispatcher->setEventsManager($eventsManager);
        //Return dispatcher
        return $dispatcher;
    });

    //Storage Path is setting;  
    $di->set('storage', function() {
        return new \Phalcon\DI\Storage('/some/directory');
    }, true);

    //TODO: ARTISAN DUMP

    // Register the installed modules
    $application->registerModules(
        include_once APPLICATION_PATH . "configs/modules.php"
    );

    //Loader is setted
    $loader = new \Phalcon\Loader();

    //Application directories is registered
    $loader->registerDirs(array(
        APPLICATION_PATH . '/tasks'
    ));

    $loader->register();

    /**
    * Process the console arguments
    */
    $arguments = array();

    foreach($argv as $k => $arg) {
        if($k == 1) {
            $arguments['task'] = $arg;
        } elseif($k == 2) {
            $arguments['action'] = $arg;
        } elseif($k >= 3) {
            $arguments['params'][] = $arg;
        }
    }

    // define global constants for the current task and action
    define('CURRENT_TASK', (isset($argv[1]) ? $argv[1] : null));
    define('CURRENT_ACTION', (isset($argv[2]) ? $argv[2] : null));

    //Handle the request
    $application->handle($arguments);

} catch(\Exception $e) {
    throw new Exception($e->getMessage());
}