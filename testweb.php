<?php
ini_set('display_errors', '1');
ini_set('error_reporting', E_ALL);
date_default_timezone_set('Europe/Moscow');

define('CONTENT', 'test web content');

$content = file_get_contents('http://localhost/testweb.html');
assert(false !== strpos($content, CONTENT);
