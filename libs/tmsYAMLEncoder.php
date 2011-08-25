<?php
/**
 * класс описывает объект, читающий крнфигурационную информацию из файлов формата yml
 * @author Morozov Anton Andreevich aamorozov83@gmail.com
 * @link http://tonymstudio.ru
 * @copyright Morozov Anton Andreevich
 * @license GPLv3
 * @package tmsFormManager
 * @version 1
 */
namespace tmsFormManager;

class YAMLEncoder extends Encoder{
   
    public function __construct(){ }


    /**
     * метод осуществляет чтение файла и возвращает массив с настройками форм
     * @return array or string
     */
    public function ReloadConfigfile()
    {
        if(file_exists($this->CONFIG_FILE))
	{
            $data = \Spyc::YAMLLoad($this->CONFIG_FILE);
            return $data;
	}
	return false;
    }

}
?>
