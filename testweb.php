<?php
ini_set('display_errors', '1');
ini_set('error_reporting', E_ALL);
date_default_timezone_set('Europe/Moscow');
assert_options(ASSERT_ACTIVE, true);

define('CONTENT', 'test web content');
define('PHP_CONTENT', 'test web PHP content');

$content = file_get_contents('http://localhost/testweb.html');
assert(false !== strpos($content, CONTENT));
var_dump($content);

$content = file_get_contents('http://localhost/testwebphp.php');
assert(false !== strpos($content, PHP_CONTENT));
var_dump($content);
