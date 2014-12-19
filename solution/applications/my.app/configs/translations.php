<?php

$language = "tr";

if (file_exists(APPLICATION_PATH.'resources/languages/'.$language.".php"))
    include_once APPLICATION_PATH.'resources/languages/'.$language.".php";
else
    include_once APPLICATION_PATH.'resources/languages/en.php';
return new \Phalcon\Translate\Adapter\NativeArray(array(
    "content" => $messages
));