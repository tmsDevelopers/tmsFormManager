<?php
/**
 * file for including all needed libraryes
 *
 * @author Morozov A.A.
 * @email morozov_aa@tonymstudio.ru
 * @site tonymstudio.ru
 * @version 1
 */
define ('tmsLIBS', 'libs');
$path_parts = pathinfo(tmsLIBS);

$path = realpath($path_parts['dirname']).DIRECTORY_SEPARATOR.tmsLIBS;
set_include_path(get_include_path() . PATH_SEPARATOR . $path);

function __autoload($classname)
{
    $classname = preg_replace('/^[a-z\\\]+(\\\)/i', '', $classname);

    if(file_exists(tmsLIBS.DIRECTORY_SEPARATOR.'tms'.$classname.'.php')) require_once (tmsLIBS.DIRECTORY_SEPARATOR.'tms'.$classname.'.php');
    if(file_exists(tmsLIBS.DIRECTORY_SEPARATOR.$classname.'.php'))require_once (tmsLIBS.DIRECTORY_SEPARATOR.$classname.'.php');
}
?>
