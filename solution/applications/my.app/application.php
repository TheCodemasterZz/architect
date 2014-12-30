<?php

/**
 * architect - a PHP Framework for rapid developing
 *
 * @package  architect
 * @author   Baris Kalaycioglu <thecodemasterzz@gmail.com>
 */


try {

    //Create an Application
    $application = new \Phalcon\Mvc\Application($di);

    /*
    |--------------------------------------------------------------------------
    | Application Configs
    |--------------------------------------------------------------------------
    |
    | Get application config parametrs from config. This file is one of the 
    | important file for the framework configurations
    |
    */

    $appConfig = new \Phalcon\Config(
        include_once _if(APPLICATION_PATH."configs/", "application.php")
    );

    $di->set('application', function () use ($appConfig) {
        return $appConfig;
    });

    //Loader is setted
    $loader = new \Phalcon\Loader();

    //Application paths are registered
    $loader->registerDirs(
        $appConfig->paths->toArray()
    );

    //Application namespaces are registered
    $loader->registerNamespaces(
        $appConfig->namespaces->toArray()
    );

    //Application prefixes are registered
    $loader->registerPrefixes(
        $appConfig->prefixes->toArray()
    );

    //Application classes are registered
    $loader->registerClasses(
        $appConfig->classes->toArray()
    );

    //Application extensions are registered
    $loader->setExtensions(
        $appConfig->extensions->toArray()
    );

    $loader->register();
    
    /*
    |--------------------------------------------------------------------------
    | Error Service
    |--------------------------------------------------------------------------
    |
    | Error Service is set by checking error config parameter in related
    | enviroment folder in application config folder path. 
    |
    */

    $di->set('error', function () use ($appConfig) {
        return include_once _if(APPLICATION_PATH."services/", "error.php");
    });

    //Run error handler
    $application->error;

    /*
    |--------------------------------------------------------------------------
    | Session Service
    |--------------------------------------------------------------------------
    |
    | The Session provides object-oriented wrappers to access session data.
    | Reasons to use this component instead of raw-sessions:
    |
    | - You can easily isolate session data across applications on the same domain
    | - Intercept where session data is set/get in your application
    | - Change the session adapter according to the application needs
    |
    */

    $di->set('session', function() {
        $session = new \Phalcon\Session\Adapter\Files();
        $session->start();
        return $session;
    });

    //Run session handler
    $application->session;

    /*
    |--------------------------------------------------------------------------
    | Database Service
    |--------------------------------------------------------------------------
    |
    | Phalcon encapsulates the specific details of each database engine in 
    | dialects. Those provide common functions and SQL generator to the 
    | adapters.
    | 
    | This component allows for a lower level database manipulation than 
    | using traditional models.
    |
    */

    $dbConfigs = new \Phalcon\Config(
        include_once _if(APPLICATION_PATH."configs/", "databases.php")
    );

    //Setup the database service
    foreach ($dbConfigs as $name => $dbConfig ) {
        $di->set($name, function() use ($dbConfig){
            $className = $dbConfig["type"];
            $database =  new $className($dbConfig->toArray());
            $database->connect();
            return $database;
        });
    }

    /*
    |--------------------------------------------------------------------------
    | Cookie Service
    |--------------------------------------------------------------------------
    |
    | PHP automatically fills the superglobal arrays $_GET and $_POST 
    | depending on the type of the request. These arrays contain the values 
    | present in forms submitted or the parameters sent via the URL. The 
    | variables in the arrays are never sanitized and can contain illegal 
    | characters or even malicious code, which can lead to SQL injection or 
    | Cross Site Scripting (XSS) attacks.
    |
    */

    $di->set('cookies', function() use ($appConfig) {
        $cookies = new \Phalcon\Http\Response\Cookies();
        $cookies->useEncryption($appConfig->cookie_encryption);
        return $cookies;
    });

    //Setup the cache service
    $di->set('cache', function(){
        return include_once _if(APPLICATION_PATH."services/", "cache.php");
    });

    /*
    |--------------------------------------------------------------------------
    | Response Service
    |--------------------------------------------------------------------------
    |
    | Part of the HTTP cycle is returning responses to clients. Response is 
    | the Phalcon component designed to achieve this task. HTTP responses are 
    | usually composed by headers and body.
    |
    */

    $di->set('response', function(){
        return new \Phalcon\Http\Response();
    });

    //Setup the email service
    $di->set('email', function(){
        return include_once _if(APPLICATION_PATH."services/", "email.php");
    });

    /*
    |--------------------------------------------------------------------------
    | Asset Service
    |--------------------------------------------------------------------------
    |
    | Phalcon\Assets is a component that allows the developer to manage static 
    | resources such as css stylesheets or javascript libraries in a web 
    | application.
    |
    */

    $di->set('assets', function () {
        $assetManager = new \Phalcon\Assets\Manager();
        return $assetManager;
    }, true);

    /*
    |--------------------------------------------------------------------------
    | Url Service
    |--------------------------------------------------------------------------
    |
    | Phalcon\Mvc\Url is the component responsible of generate urls in a 
    | Phalcon application. It’s capable of produce independent urls based on 
    | routes.
    |
    */

    $di->set('url', function () use ($appConfig) {
        $url = new \Phalcon\Mvc\Url();
        if (!is_null($appConfig->base_url))
            $url->setBaseUri($appConfig->base_url);
        return $url;
    }, true);

    /*
    |--------------------------------------------------------------------------
    | Crypt Service
    |--------------------------------------------------------------------------
    |
    | Phalcon provides encryption facilities via the Phalcon\Crypt component. 
    | This class offers simple object-oriented wrappers to the mcrypt php’s 
    | encryption library.
    |
    */

    $di->set('crypt', function () use ($appConfig) {
        $crypt = new \Phalcon\Crypt();
        //Type of cipher algoritm
        $crypt->setCipher($appConfig->cipher);
        //Set a global encryption key
        $crypt->setKey($appConfig->key);
        //Set a global encryption mode
        $crypt->setMode($appConfig->encryption_mode);
        //Return crypt
        return $crypt;
    }, true);

    /*
    |--------------------------------------------------------------------------
    | Security Service
    |--------------------------------------------------------------------------
    |
    | This component aids the developer in common security tasks such as 
    | password hashing and Cross-Site Request Forgery protection (CSRF).
    |
    */

    $di->set('security', function() use ($appConfig) {
        $security = new \Phalcon\Security();
        $security->setWorkFactor($appConfig->work_factor);
        return $security;
    }, true);

    //Registering the translate component
    $di->set('language', function() use ($appConfig) {
        $language = "tr"; //TODO: HOW TO GET THIS FROM WHERE?
        $fileName = APPLICATION_PATH.'resources/languages/'.$language.".php";
        if (file_exists($fileName)) {
            $messages = include_once $fileName;
        }
        else {
            $defaultLanguage = $appConfig->default_language;
            $fileName = APPLICATION_PATH.'resources/languages/'.$defaultLanguage.".php";        
            if (file_exists($fileName)) {
                $messages = include_once $fileName;
            } else {
                $messages = array();
            }
        }
        return new \Phalcon\Translate\Adapter\NativeArray(array(
            "content" => $messages
        ));
    });

    /*
    |--------------------------------------------------------------------------
    | View Service
    |--------------------------------------------------------------------------
    |
    | Views represent the user interface of your application. Views are often 
    | HTML files with embedded PHP code that perform tasks related solely to 
    | the presentation of the data. Views handle the job of providing data to 
    | the web browser or other tool that is used to make requests from your 
    | application.
    |
    */

    $viewConfigs = new \Phalcon\Config(
        include_once _if(APPLICATION_PATH."configs/", "views.php")
    );

    $di->set('view', function() use ($viewConfigs){
        $view = new \Phalcon\Mvc\View();
        $viewEngines = $viewConfigs->view_engines;
        foreach ($viewEngines as $extension => $parameters) {
            $view->registerEngines(array(
                $extension => function($view, $di) use ($parameters) {
                    $volt = new $parameters->type($view, $di);
                    $volt->setOptions($parameters->options->toArray());
                    return $volt;
                }
            ));
        }
        return $view;
    });

    /*
    |--------------------------------------------------------------------------
    | Router Service
    |--------------------------------------------------------------------------
    |
    | The router component allows defining routes that are mapped to 
    | controllers or handlers that should receive the request. A router simply 
    | parses a URI to determine this information. The router has two modes: 
    | MVC mode and match-only mode. The first mode is ideal for working with 
    | MVC applications.
    |
    */

    $di->set('router', function () use ($appConfig) {
        $router = new \Phalcon\Mvc\Router\Annotations(false);
        $router->setUriSource(\Phalcon\Mvc\Router::URI_SOURCE_GET_URL); 
        $router->setUriSource(\Phalcon\Mvc\Router::URI_SOURCE_SERVER_REQUEST_URI);
        $router->setDefaults(array(
            'namespace'     => $appConfig->default_namespace,
            'module'        => $appConfig->default_module,
            'controller'    => $appConfig->default_controller,
            'action'        => $appConfig->default_action
        ));
        $router->removeExtraSlashes($appConfig->extra_slashes);
        return include_once _if(APPLICATION_PATH."configs/", "routing.php");
    });

    /*
    |--------------------------------------------------------------------------
    | Request Service
    |--------------------------------------------------------------------------
    |
    | Every HTTP request (usually originated by a browser) contains additional 
    | information regarding the request such as header data, files, variables, 
    | etc. A web based application needs to parse that information so as to 
    | provide the correct response back to the requester. Phalcon\Http\Request 
    | encapsulates the information of the request, allowing you to access it 
    | in an object-oriented way.
    |
    */

    $di->set("request", function() {
        return new \Phalcon\Http\Request();
    });

    /*
    |--------------------------------------------------------------------------
    | Filter Service
    |--------------------------------------------------------------------------
    |
    | PHP automatically fills the superglobal arrays $_GET and $_POST 
    | depending on the type of the request. These arrays contain the values 
    | present in forms submitted or the parameters sent via the URL. The 
    | variables in the arrays are never sanitized and can contain illegal 
    | characters or even malicious code, which can lead to SQL injection or 
    | Cross Site Scripting (XSS) attacks.
    |
    */

    $di->set("filter", function() {
        return new \Phalcon\Filter();
    });

    /*
    |--------------------------------------------------------------------------
    | Validation Service
    |--------------------------------------------------------------------------
    |
    | Phalcon\Validation is an independent validation component that validates 
    | an arbitrary set of data. This component can be used to implement 
    | validation rules on data objects that do not belong to a model or 
    | collection.
    |
    */

    $di->set("validation", function() {
        return new \Phalcon\Validation();
    }); 

    // Register the installed modules
    $application->registerModules(
        $appConfig->modules->toArray()
    );

    //Handle the request
    $output = $application->handle()->getContent();

    // HTML Minification
    if ( $appConfig->html_minify ) {
        ob_start( function() use ($output) {
            $search = array( '/\>[^\S ]+/s', '/[^\S ]+\</s', '/(\s)+/s' );
            $replace = array( '>', '<', '\\1' );
            $buffer = preg_replace($search, $replace, $output);
            return $buffer;
        });
    }

    echo $output;

} catch(Exception $e) {
    throw new Exception($e->getMessage());    
}