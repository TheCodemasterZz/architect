<?php

define('VERSION', '2.0.0');

//Create an Application
if (PHP_SAPI === 'cli') {
    $application = new \Phalcon\CLI\Console($di);
} else {
    $application = new \Phalcon\Mvc\Application($di);
    $di['app'] = $application;
}

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

// Register the installed modules
$application->registerModules(
    $appConfig->modules->toArray()
);

if (PHP_SAPI === 'cli') 
{
    $arguments = array();
    $arguments['task'] = $appConfig->default_task;
    $arguments['action'] = $appConfig->default_action;

    if ( isset( $_SERVER['argv'][1] ) AND strpos($argv[1], "@") !== FALSE  ) {
        $itemNumber = 0;
        $allArguments = explode("@", $argv[1]);
        if ( count($allArguments) === 2 )
        {
            $itemNumber = 1;
        }
        $taskArguments = explode(":", $allArguments[$itemNumber]);
        $arguments['task'] = $taskArguments[0];
        $arguments['action'] = $taskArguments[1];
    } else {

    }

    $arguments['params'] = array();

    foreach($_SERVER['argv'] as $k => $arg) {
        if($k >= 2) {
            $arguments['params'][] = $arg;
        }
    }

    // handle incoming arguments
    $application->handle($arguments); 
} 
else 
{   
    $debugWidget = new \Phalcon\Debug\DebugWidget($di);
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

}

