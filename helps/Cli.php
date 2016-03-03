<?php

/**
 * Created by PhpStorm.
 * User: squirrelm
 * Date: 2016/2/26 0026
 * Time: 18:26
 */
namespace helps;

class Cli
{
    public static function output($str)
    {
        if (self::isWin()) {
            $str = mb_convert_encoding($str, 'GB2312', 'UTF-8');
        }
        echo $str;
    }

    private static function isWin()
    {
        return strtoupper(substr(PHP_OS, 0, 3)) === 'WIN';
    }
}