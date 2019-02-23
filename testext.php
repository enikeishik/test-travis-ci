<?php
ini_set('display_errors', '1');
ini_set('error_reporting', E_ALL);
date_default_timezone_set('Europe/Moscow');

if (class_exists('Memcached')) {
    $m = new Memcached();
    assert(Memcached::class === get_class($m));
} else {
    echo 'class Memcached not exists' . PHP_EOL;
}

if (class_exists('Memcache')) {
    $m = new Memcache();
    assert(Memcache::class === get_class($m));
} else {
    echo 'class Memcache not exists' . PHP_EOL;
}

echo 'OK';
