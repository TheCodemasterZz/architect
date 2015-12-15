<?php

define('VERSION', '2.0.0');

$application = new \Phalcon\Mvc\Application($di);
$di->set("app", $application);

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

//debug widget
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
