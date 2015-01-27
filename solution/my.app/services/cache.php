<?php

//Cache data for one day by default
$frontCache = new \Phalcon\Cache\Frontend\Data(array(
    "lifetime" => 86400
));

//Memcached connection settings
$cache = new \Phalcon\Cache\Backend\Memcache($frontCache, array(
    "host" => "localhost",
    "port" => "11211"
));

return $cache;