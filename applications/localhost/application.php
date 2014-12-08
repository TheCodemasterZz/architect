<?php

/**
 * architect - a PHP Framework for rapid developing
 *
 * @package  architect
 * @author   Baris Kalaycioglu <thecodemasterzz@gmail.com>
 */

define("THEME_NAME", 	"default" );
return;

define("ENVIRONMENT", "development" );

$config = new \Architect\Config();

$config->setAll(array(
    'app.mode' => ENVIRONMENT
));

$config->configureMode('development', function () use ($config) {
    $config->setAll(array(
        'app.debug' => true,
    	'app.exception_handler_type' => "PrettyPage"
    ));
});

$app = new \Architect\Architect();

$app->run();

function get_base_url($baseUrl) {
	$protocol = (isset($_SERVER['HTTPS']) && ($_SERVER['HTTPS'] != "off")) ? "https" : "http";
	if ( is_null($baseUrl) )
		return $protocol . "://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
	else 
		return $baseUrl;
}

define("BASE_URL", 		$config->get('app.base_url') );
define("THEME_NAME", 	get_base_url( $config->get('app.theme_name') ) );
