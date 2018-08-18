<?php
spl_autoload_register(
    function ($class) {
        $class = str_replace('CITest\\', 'citest' . DIRECTORY_SEPARATOR, $class);
        $file = __DIR__ . DIRECTORY_SEPARATOR . str_replace('\\', DIRECTORY_SEPARATOR, $class) . '.php';
        if (file_exists($file)) {
            require $file;
            return true;
        }
        return false;
    }
);
