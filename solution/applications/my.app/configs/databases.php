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
	| ), 
	| 'db2' => array(
    |	'type' => '\Phalcon\Db\Adapter\Pdo\PostgreSQL',
    |   'host' => 'localhost',
    |   'username' => 'root',
    |   'password' => '',
    |   'dbname' => 'test',
    |   'persistent' => false
	| )
	| 
	| Also in your model you can set which database you want to use with adding 
	| initialize method.
	|
	| public function initialize()
    | {
    |	//$this->setConnectionService('db2');
    |   $this->setReadConnectionService('db1');
    |	$this->setWriteConnectionService('db2');
    | }
	|
	|
	*/

	'db' => array(
        'type' => '\Phalcon\Db\Adapter\Pdo\Mysql',
        'host' => 'localhost',
		'port' => 3306,
        'username' => 'root',
        'password' => '',
        'dbname' => 'test',
        'persistent' => false
	)
);