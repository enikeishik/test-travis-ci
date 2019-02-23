<?php
ini_set('display_errors', '1');
ini_set('error_reporting', E_ALL);
date_default_timezone_set('Europe/Moscow');

$m = new Memcached();
$c = get_class($m);
assert(Memcached::class === $c);

echo 'OK';
