<?php

/**
 * architect - a PHP Framework for rapid developing
 *
 * @package  architect
 * @author   Baris Kalaycioglu <thecodemasterzz@gmail.com>
 */

define("ENVIRONMENT", "development");

try {

    $config = new \Phalcon\Config(
        include_once _gf(APPLICATION_PATH."configs/", "application.php")
    );
    
    //Create a FactoryDefault
    $di = new \Phalcon\DI\FactoryDefault();
    
    /*
    |--------------------------------------------------------------------------
    | Error Handler
    |--------------------------------------------------------------------------
    |
    | Error Handler is set by checking error config parameter in related
    | enviroment folder in application config folder path. 
    |
    */

    $di->set('error', function () {
        return include_once _gf(APPLICATION_PATH."configs/", "error.php");
    });

    //Create an Application
    $application = new \Phalcon\Mvc\Application($di);

    //Run error handler
    $application->error;

    //TODO: Config yappilacak
    $di->set('config', function () use ($config) {
        return $config;
    });

    //Setup the database service
    $di->set('db', function(){
        return include_once _gf(APPLICATION_PATH."configs/", "databases.php");
    });

    //Setup the cookie service
    $di->set('cookies', function(){
        return include_once _gf(APPLICATION_PATH."configs/", "cookies.php");
    });

    //Setup the response service
    $di->set('response', function(){
        return include_once _gf(APPLICATION_PATH."configs/", "response.php");
    });

    //Setup the email service
    $di->set('email', function(){
        return include_once _gf(APPLICATION_PATH."configs/", "email.php");
    });

    //Start the session the first time a component requests the session service
    $di->set('session', function() {
        return include_once _gf(APPLICATION_PATH."configs/", "sessions.php");
    });

    //Registering the asset component
    $di->set('assets', function () {
        return include_once _gf(APPLICATION_PATH."configs/", "assets.php");
    }, true);

    //Registering the url component
    $di->set('url', function () {
        return include_once _gf(APPLICATION_PATH."configs/", "url.php");
    }, true);

    //Registering the crypt component
    $di->set('crypt', function () {
        return include_once _gf(APPLICATION_PATH."configs/", "crypt.php");
    }, true);

    //Registering the security component
    $di->set('security', function(){
        return include_once _gf(APPLICATION_PATH."configs/", "security.php");
    }, true);

    //Registering the translate component
    $di->set('translate', function(){
        return include_once _gf(APPLICATION_PATH."configs/", "translations.php");
    });

    //Registering the view component
    $di->set('view', function() {
        return include_once _gf(APPLICATION_PATH."configs/", "views.php");
    });

    //Routing configuration is setted
    $di->set('router', function () {
        return include_once _gf(APPLICATION_PATH."configs/", "routes.php");
    });

    //Using an anonymous function, the instance will be lazy loaded
    $di->set("request", function() {
        return include_once _gf(APPLICATION_PATH."configs/", "request.php");
    });

    //Validation configuration is setted
    $di->set("validation", function() {
        return include_once _gf(APPLICATION_PATH."configs/", "validations.php");
    });

    //Filter configuration is setted
    $di->set("filter", function() {
        return include_once _gf(APPLICATION_PATH."configs/", "filter.php");
    });

    //Dispatcher configuration is setted
    $di->set('dispatcher', function() use ($di) {
        return include_once _gf(APPLICATION_PATH."configs/", "dispatchers.php");
    });

    // Register the installed modules
    $application->registerModules(
        include_once _gf(APPLICATION_PATH."configs/", "modules.php")
    );

    //Loader is setted
    $loader = new \Phalcon\Loader();

    //Application directories is registered
    $loader->registerDirs(
        include_once _gf(APPLICATION_PATH."configs/", "paths.php")
    );

    //Application namespaces is registered
    $loader->registerNamespaces(
        include_once _gf(APPLICATION_PATH."configs/", "namespaces.php")
    );

    //Register some prefixes
    $loader->registerPrefixes(
        include_once _gf(APPLICATION_PATH."configs/", "prefixes.php")
    );

    // Register some classes
    $loader->registerClasses(
        include_once _gf(APPLICATION_PATH."configs/", "classes.php")
    );

    //TODO: Set file extensions to check
    $loader->setExtensions(
        array("php", "inc", "phb")
    );

    $loader->register();

    //Handle the request
    echo $application->handle()->getContent();

} catch(Exception $e) {
    throw new Exception($e->getMessage());    
}