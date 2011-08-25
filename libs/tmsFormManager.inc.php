<?php
/**
 * Файл, подключающий все необходимые библиотеки пакета
 * @author Morozov Anton Andreevich aamorozov83@gmail.com
 * @link http://tonymstudio.ru
 * @copyright Morozov Anton Andreevich
 * @license GPLv3
 * @package tmsFormManager
 * @version 1
 */
define ('tmsLIBS', LIBS);
$path_parts = pathinfo(tmsLIBS);

$path = realpath($path_parts['dirname']).DIRECTORY_SEPARATOR.tmsLIBS;
set_include_path(get_include_path() . PATH_SEPARATOR . $path);

function __autoload_tmsFormManager($classname)
{
    $classname = preg_replace('/^[a-z\\\]+(\\\)/i', '', $classname);

    if(file_exists(tmsLIBS.DIRECTORY_SEPARATOR.'tms'.$classname.'.php')) require_once (tmsLIBS.DIRECTORY_SEPARATOR.'tms'.$classname.'.php');
    if(file_exists(tmsLIBS.DIRECTORY_SEPARATOR.$classname.'.php'))require_once (tmsLIBS.DIRECTORY_SEPARATOR.$classname.'.php');
}

spl_autoload_register('__autoload_tmsFormManager');
?>
