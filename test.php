<?php
ini_set('display_errors', '1');
ini_set('error_reporting', E_ALL);
date_default_timezone_set('Europe/Moscow');

require_once 'autoload.php';

$loader = new \CITest\Frontend\Loader();
$loader->setUrl('http://informer.gismeteo.ru/xml/27612.xml');
$data = $loader->getData();
assert($data);

echo 'OK';
