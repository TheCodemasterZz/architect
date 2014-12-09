<?php

/**
 * architect - a PHP Framework for rapid developing
 *
 * @package  architect
 * @author   Baris Kalaycioglu <thecodemasterzz@gmail.com>
 */

namespace Multiple\Dashboard\Controllers;

class IndexController extends \Phalcon\Mvc\Controller
{
    public function indexAction()
    {	
    	$this->assets
		    ->collection('header')
		    ->addJs('js/jquery.js')
		    ->addJs('js/bootstrap.min.js');
    }
}