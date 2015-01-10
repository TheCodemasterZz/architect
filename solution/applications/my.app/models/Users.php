<?php

/**
 * architect - a PHP Framework for rapid developing
 *
 * @package  architect
 * @author   Baris Kalaycioglu <thecodemasterzz@gmail.com>
 */

class Users extends \Phalcon\Mvc\Model
{
	public $id;
    public $name;
    public $created_at;
    public $user_id_created;
    public $is_modified;
    public $modified_at;
    public $user_id_modified;
    public $is_deleted;
    public $deleted_at;
    public $user_id_deleted;
    public $is_versioned;
    public $version;
}