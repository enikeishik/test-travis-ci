<?php
ini_set('display_errors', '1');
ini_set('error_reporting', E_ALL);
date_default_timezone_set('Europe/Moscow');

$m = new Memcached();
assert(Memcached::class === get_class($m));
$m = new Memcache();
assert(Memcache::class === get_class($m));

echo 'OK';
