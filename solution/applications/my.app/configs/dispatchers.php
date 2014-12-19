<?php

//Obtain the standard eventsManager from the DI
$eventsManager = $di->getShared('eventsManager');
//Dispatcher is setting
$dispatcher = new \Phalcon\Mvc\Dispatcher();
//Bind the EventsManager to the Dispatcher
$dispatcher->setEventsManager($eventsManager);
//Return dispatcher
return $dispatcher;