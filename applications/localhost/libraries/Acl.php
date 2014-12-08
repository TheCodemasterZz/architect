<?php

/**
 * architect - a PHP Framework for rapid developing
 *
 * @package  architect
 * @author   Baris Kalaycioglu <thecodemasterzz@gmail.com>
 */

use \Phalcon\Events\Event;
use \Phalcon\Mvc\Dispatcher;

class Acl extends \Phalcon\Mvc\User\Component
{
	protected $_module;

	public function __construct($module)
	{
		$this->_module = $module;
	}
}