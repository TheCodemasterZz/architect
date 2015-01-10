<?php

$whoops = new \Whoops\Run();

$handlerType = new Whoops\Handler\PrettyPageHandler();
$whoops->pushHandler($handlerType);
$whoops->register();  

return $whoops;