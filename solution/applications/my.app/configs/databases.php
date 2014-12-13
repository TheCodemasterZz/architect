<?php

/**
 * architect - a PHP Framework for rapid developing
 *
 * @package  architect
 * @author   Baris Kalaycioglu <thecodemasterzz@gmail.com>
 */

return new \Phalcon\Db\Adapter\Pdo\Mysql(array(
    "host" => "localhost",
    "username" => "root",
    "password" => "secret",
    "dbname" => "test_db"
));