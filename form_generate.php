<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
ini_set('display_errors', 1);
error_reporting(E_ALL ^ E_NOTICE);

if(file_exists('libs/tmsFormManager.inc.php'))require_once 'libs/tmsFormManager.inc.php';


//print_r(get_declared_classes());

$form = new tmsFormManager\FormManager();
$form->setEncoderMethod('YAML');
$form->setConfigfile('etc/forms.yml');

$form->ReloadConfig();
?>
