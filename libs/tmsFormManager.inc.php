<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

$tms_LIB_PATH = 'libs';

if(file_exists($tms_LIB_PATH.'/tmsIFencoder.php'))require_once $tms_LIB_PATH.'/tmsIFencoder.php';
if(file_exists($tms_LIB_PATH.'/tmsBaseField.php'))require_once $tms_LIB_PATH.'/tmsBaseField.php';
if(file_exists($tms_LIB_PATH.'/tmsEncoder.php'))require_once $tms_LIB_PATH.'/tmsEncoder.php';

$dir = opendir($tms_LIB_PATH);

while (false !==($file = readdir($dir)))
{
   if(($file != 'tmsFormManager.inc.php') && (is_file($tms_LIB_PATH.'/'.$file) ) )
   {
       require_once ($file);
   }
   
}
closedir($dir);

?>
