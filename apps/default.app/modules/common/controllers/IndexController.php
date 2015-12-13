<?php

/**
* architect - a PHP Framework for rapid developing
*
* @package  architect
* @author   Baris Kalaycioglu <thecodemasterzz@gmail.com>
*/

namespace Modules\Common\Controllers;

class IndexController extends \Phalcon\Mvc\Controller 
{
    public function indexAction() 
    {	
		var_dump(
			\Orders::findFirst(1)
		);

		die;
    }
}