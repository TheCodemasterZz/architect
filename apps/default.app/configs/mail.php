<?php

return array(

	/*
	|--------------------------------------------------------------------------
	| Mail Configuration
	|--------------------------------------------------------------------------
	| 
	| Mailer wrapper over SwiftMailer for Phalcon.
	|
    | 'driver'     => 'smtp',
    | 'host'       => 'smtp.gmail.com',
    | 'port'       => 465,
    | 'encryption' => 'ssl',
    | 'username'   => 'example@gmail.com',
    | 'password'   => 'your_password',
    | 'from'       => array(
	| 	'email' => 'example@gmail.com',
	| 	'name'  => 'YOUR FROM NAME'
    | );
	|
	*/

    'driver'     => 'smtp',
    'host'       => 'smtp.gmail.com',
    'port'       => 465,
    'encryption' => 'ssl',
    'username'   => 'example@gmail.com',
    'password'   => 'your_password',
    'from'       => array(
		'email' => 'example@gmail.com',
		'name'  => 'YOUR FROM NAME'
    )
);