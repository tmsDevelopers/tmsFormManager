<?php
/* 
 * example of the use tmsFormManager to generate fields and forms
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

$form_manager->setForm('test'); // указываем форму, с которой будем работать

//$form_manager->setLineDelimiter('<hr>');
?><small><br>input type="text"</small><br><?php
echo $form_manager->getHTMLfield('singletxtname');

?><small><br>input type="password"</small><br><?php
echo $form_manager->getHTMLfield('password');

?><small><br>1D-array of input type="text"</small><br><?php
echo $form_manager->getHTMLfield('txtname[]');

?><small><br>input type="text" with index=1 from 1D-array</small><br><?php
echo $form_manager->getHTMLfield('txtname[1]');

?><small><br><br>textarea</small><br><?php
echo $form_manager->getHTMLfield('testtextarea');

?><small><br>input type="image"</small><br><?php
echo $form_manager->getHTMLfield('btnimage');

?><small><br>input type="submit"</small><br><?php
echo $form_manager->getHTMLfield('btnsubmit');

?><small><br>input type="reset"</small><br><?php
echo $form_manager->getHTMLfield('btnreset');

?><small><br>input type="button"</small><br><?php
echo $form_manager->getHTMLfield('btnbutton');

?><small><br>select</small><br><?php
echo $form_manager->getHTMLfield('select1');

?><small><br>select size!=1</small><br><?php
echo $form_manager->getHTMLfield('select2');

?><small><br>select multiple</small><br><?php
echo $form_manager->getHTMLfield('select3');

?><small><br>checkbox</small><br><?php
echo $form_manager->getHTMLfield('chbox1');

?><small><br>hidden</small><br><?php
echo $form_manager->getHTMLfield('hidden');

?><h1>Set value</h1><?php
$form_manager->Field('singletxtname')->setValue('new text');
echo $form_manager->getHTMLfield('singletxtname');
?>