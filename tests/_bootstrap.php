<?php
/**
 * Created by PhpStorm.
 * User: squirrelm
 * Date: 2016/2/26 0026
 * Time: 18:48
 */
define('BASE_PATH', dirname(__DIR__));

spl_autoload_register(function ($class) {
    $file = BASE_PATH . DIRECTORY_SEPARATOR . $class . '.php';
    $file = str_replace('\\', DIRECTORY_SEPARATOR, $file);
    if (file_exists($file)) {
        require $file;
    }
});
