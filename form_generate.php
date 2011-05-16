<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
ini_set('display_errors', 1);
error_reporting(E_ALL ^ E_NOTICE);
echo '<pre>';
if(file_exists('libs/tmsFormManager.inc.php'))require_once 'libs/tmsFormManager.inc.php';


//print_r(get_declared_classes());

$form_manager = new tmsFormManager\FormManager(); // создаём объект
$form_manager->setEncoderMethod('YAML'); // указываем метод декодирования настроечного файла (вначале)
$form_manager->setConfigfile('etc/forms.yml'); // считываем конфигурацию

$form_manager->ReloadConfig(); // обновляем данные менеджера на основе конфигурации

$form_manager->setForm('test'); // указываем форму, с которой будем работать
//echo $form_manager->getHTMLfield('txtname[]'); // запрашиваем для выбранной формы html код поля
//$form_manager->setLineDelimiter('<hr>');
echo $form_manager->getHTMLfield('singletxtname');
echo $form_manager->getHTMLfield('txtname[]');
?>
