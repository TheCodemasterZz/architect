<?php

$view = new \Phalcon\Mvc\View();
$view->registerEngines(array(
    '.volt' => function($view, $di) {
        $volt = new \Phalcon\Mvc\View\Engine\Volt($view, $di);
        $volt->setOptions(array(
            'compiledPath' => STORAGE_PATH . 'views/',
            'compiledSeparator' => '_',
               'compiledExtension' => '.compiled'
        ));
        return $volt;
    }
));
return $view;