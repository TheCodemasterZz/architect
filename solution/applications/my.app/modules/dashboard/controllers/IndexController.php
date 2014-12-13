<?php

/**
 * architect - a PHP Framework for rapid developing
 *
 * @package  architect
 * @author   Baris Kalaycioglu <thecodemasterzz@gmail.com>
 */

namespace Modules\Dashboard\Controllers;

class IndexController extends \Phalcon\Mvc\Controller
{
    public $settings;

    public function initialize()
    {
        $this->settings = array(
            "mySetting" => "value"
        );
    }

    public function notFoundAction()
    {
        // Send a HTTP 404 response header
        $this->response->setStatusCode(404, "Not Found");
    }

    public function onConstruct()
    {
        
    }
    
    public function indexAction()
    {
    	$this->assets
		    ->addCss('global/css/bootstrap.min.css')
		    ->addCss('assets/themes/my.theme/css/style.css');

    	$this->assets
		    ->addJs('//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js')
		    ->addJs('global/js/bootstrap.min.js');
    }
}