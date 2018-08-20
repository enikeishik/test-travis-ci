<?php
ini_set('display_errors', '1');
ini_set('error_reporting', E_ALL);
date_default_timezone_set('Europe/Moscow');
setlocale(LC_ALL, 'ru_RU.utf-8', 'rus_RUS.utf-8', 'ru_RU.utf8');
mb_internal_encoding('UTF-8');

require_once 'config.php';
define('C_SQLFILES_PATH', __DIR__ . '/sql');
define('C_SQL_TABLE_PREFIX', '/* TABLE_PREFIX */');

/**
 * @throws Exception
 * @todo make check prefix and execute queries if no exists tables with prefix in config
 */
function execSqls()
{
    $sqlFiles = glob(C_SQLFILES_PATH . '/*.sql');
    if (!is_array($sqlFiles)) {
        throw new Exception('There are no SQL files');
    }
    if (0 == count($sqlFiles)) {
        throw new Exception('There are no SQL files');
    }
    
    if (false === $link = @mysqli_connect(C_DB_SERVER, C_DB_USER, C_DB_PASSWD, C_DB_NAME)) {
        throw new Exception('Connect to database failed, error: ' . 
                            preg_replace('/[^a-z0-1\s\.\-;:,_~]+/i', '', mysqli_connect_error()));
    }
    if (false === $result = mysqli_query($link, 'SHOW TABLES')) {
        throw new Exception('Query execution error');
    }
    if (0 < mysqli_num_rows($result)) {
        throw new Exception('DB must be empty, but this are not');
    }
    mysqli_free_result($result);
    
    //var_dump($sqlFiles); return;
    mysqli_query($link, 'SET NAMES ' . C_DB_CHARSET);
    $begin = microtime(true);
    echo 'Processing SQL queries' . PHP_EOL;
    foreach ($sqlFiles as $sqlFile) {
        echo basename($sqlFile) . PHP_EOL;
        if (false !== $content = file_get_contents($sqlFile)) {
            $sqls = explode(';', str_replace(C_SQL_TABLE_PREFIX, C_DB_TABLE_PREFIX, $content));
            foreach ($sqls as $sql) {
                if ('' != $sql = trim($sql)) {
                    echo 'SQL: ' . $sql . PHP_EOL;
                    if (mysqli_query($link, $sql)) {
                        echo 'complete' . PHP_EOL;
                    } else {
                        echo 'error: ' . mysqli_error($link) . PHP_EOL;
                    }
                }
            }
        } else {
            echo 'error: not readable' . PHP_EOL;
        }
        echo PHP_EOL;
    }
    echo 'Execution time: ' . (microtime(true) - $begin) . PHP_EOL;
    mysqli_close($link);
}


try {
    execSqls();
} catch (Exception $e) {
    echo 'Error: ' . $e->getMessage() . PHP_EOL;
}
