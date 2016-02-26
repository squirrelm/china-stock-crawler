<?php
/**
 * Created by PhpStorm.
 * User: songshuM
 * Date: 2016/2/26 0026
 * Time: 18:48
 */
use helps\Cli;
use models\CrawlerException;

define('BASE_PATH', dirname(__DIR__));

spl_autoload_register(function ($class) {
    $file = BASE_PATH . DIRECTORY_SEPARATOR . $class . '.php';
    $file = str_replace('\\', DIRECTORY_SEPARATOR, $file);
    require $file;
});

set_exception_handler(function ($e) {
    if ($e instanceof CrawlerException) {
        Cli::output($e->getMessage());
    } else {
        Cli::output("系统错误。".$e->getMessage());
    }
    die();
});