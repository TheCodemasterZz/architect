<?php

return array(
	'view_engines' => array(
            '.volt' => array(
                  'type' => '\Phalcon\Mvc\View\Engine\Volt',
                  'options' => array(
                        'compiledPath' => STORAGE_PATH . 'framework/views/',
                        'compiledSeparator' => '_',
                        'compiledExtension' => '.compiled',
                        'stat' => true
                  )
            )
	)
);
