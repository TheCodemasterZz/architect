<?php

return array(

	/*
	|--------------------------------------------------------------------------
	| Database Connections
	|--------------------------------------------------------------------------
	| 
	| In Phalcon, all models can belong to the same database connection or 
	| have an individual one. Actually, when Model needs to connect to the 
	| database it requests the “db” service in the application’s services 
	| container. If you want to add more database you can overwrite by 
	| changing config array key like this one : 
	|
	| 'db1' => array(
    |	'type' => '\Phalcon\Db\Adapter\Pdo\Mysql',
    |   'host' => 'localhost',
	|	'port' => 3306,
    |   'username' => 'root',
    |   'password' => '',
    |   'dbname' => 'test',
    |   'persistent' => false
	| )
	|
	*/

	'db' => array(
        'type' => '\Phalcon\Db\Adapter\Pdo\Postgresql',
        'config' => array (
        	'host' => 'localhost',
			'port' => 5432,
	        'username' => 'postgres',
	        'password' => '123456',
	        'dbname' => 'isg-sistemi'
	    )
	)
);