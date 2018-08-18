<?php
ini_set('display_errors', '1');
ini_set('error_reporting', E_ALL);
date_default_timezone_set('Europe/Moscow');

define('C_DB_SERVER', 'localhost');
define('C_DB_USER', 'root');
define('C_DB_PASSWD', '');
define('C_DB_NAME', 'ttci');
define('C_DB_TABLE_PREFIX', '');
define('C_DB_CHARSET', 'utf8');

require_once 'autoload.php';

$loader = new \CITest\Frontend\Loader();
$loader->setUrl('http://informer.gismeteo.ru/xml/27612.xml');
$data = $loader->getData();
assert(false !== $data);

$db = new \CITest\Frontend\Db();
$items = $db->getItems('SHOW TABLES');
assert(null !== $data);

echo 'OK';
