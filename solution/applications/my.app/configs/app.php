<?php

/**
 * architect - a PHP Framework for rapid developing
 *
 * @package  architect
 * @author   Baris Kalaycioglu <thecodemasterzz@gmail.com>
 */

return array(
    "database" => array(
        "adapter"  => "Mysql",
        "host"     => "localhost",
        "username" => "scott",
        "password" => "cheetah",
        "dbname"     => "test_db",
    ),
     "app" => array(
        "controllersDir" => "../app/controllers/",
        "modelsDir"      => "../app/models/",
        "viewsDir"       => "../app/views/",
    ),
    "mysetting" => "the-value"
);