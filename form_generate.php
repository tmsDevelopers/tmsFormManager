<?php
/**
 * example of the use tmsFormManager to generate fields and forms
 * @author Morozov Anton Andreevich aamorozov83@gmail.com
 * @link http://tonymstudio.ru
 * @copyright Morozov Anton Andreevich
 * @license GPLv3
 * @package tmsFormManager
 * @version 1
 */
ini_set('display_errors', 1);
error_reporting(E_ALL ^ E_NOTICE);
echo '<pre>';
define('LIBS', 'libs/');
if(file_exists(LIBS.'tmsFormManager.inc.php'))require_once (LIBS.'tmsFormManager.inc.php');

$form_manager = new tmsFormManager\FormManager(); // создаём объект
$form_manager->setEncoderMethod('YAML'); // указываем метод декодирования настроечного файла (вначале)
$form_manager->setConfigfile('etc/forms.yml'); // считываем конфигурацию

$form_manager->ReloadConfig(); // обновляем данные менеджера на основе конфигурации

$form_manager->setForm('auth'); // указываем форму, с которой будем работать

?><h1>Auto creation</h1><?php
echo $form_manager->getHTMLform();

?><h1>Not auto creation</h1><?php
echo $form_manager->getHTMLformsstarttag() ;
echo $form_manager->getHTMLlabel4field('login');
echo $form_manager->getHTMLfield('login');
echo $form_manager->getHTMLlabel4field('passwd');
echo $form_manager->getHTMLfield('passwd');
echo $form_manager->getHTMLfield('btnsubmit');
echo $form_manager->getHTMLfield('btnreset');
echo '</form>';

?><h1>Rendered form</h1><?php
echo $form_manager->RenderForm('table');

$form_manager->processForm();

?>