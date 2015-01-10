<?php

/**
 * architect - a PHP Framework for rapid developing
 *
 * @package  architect
 * @author   Baris Kalaycioglu <thecodemasterzz@gmail.com>
 */

use Phalcon\Mvc\Model\Relation;

class RefCities extends \Phalcon\Mvc\Model
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

    public function initialize() {

        $this->belongsTo("user_id_created", "Users", "id",  array(
            'alias' => 'UserCreated'
        )); 
    }
    
    public function afterFetch() { }

    public function beforeSave() { }
    public function beforeCreate() { }
    public function beforeUpdate() { }
    public function beforeDelete() { }

    public function afterUpdate() { }
    public function afterCreate() { }
    public function afterSave() { }
    public function afterDelete() { }

    public function notSave() { }

    public function beforeValidation() { }
    public function beforeValidationOnUpdate() { }
    public function beforeValidationOnCreate() { }

    public function afterValidation() { }
    public function afterValidationOnUpdate() { }
    public function afterValidationOnCreate() { }

    public function onValidationFails() { }
}