<?php

define('VERSION', '2.0.0');

$application = new \Phalcon\CLI\Console($di);

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
}

$arguments['params'] = array();
foreach($_SERVER['argv'] as $k => $arg) {
    if($k >= 2) {
        $arguments['params'][] = $arg;
    }
}
// handle incoming arguments
$application->handle($arguments); 
