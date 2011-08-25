<?php
/**
 * Родительский класс для парсера файла конфигурации формы
 * @author Morozov Anton Andreevich aamorozov83@gmail.com
 * @link http://tonymstudio.ru
 * @copyright Morozov Anton Andreevich
 * @license GPLv3
 * @package tmsFormManager
 * @version 1
 */
namespace tmsFormManager;

abstract  class Encoder implements IFencoder{

    protected   $CONFIG_FILE = ''; // путь к конфигурационному полю

    /**
     * метод перезагрузки файла настроек
     */
    abstract  public  function ReloadConfigfile(); 

    /**
     * Метод указывает путь к файлу настройки форм
     * @param ыекштп $path
     * @return boolean
     */
    public function setConfigfile($path =NULL)
    {
        if($path == NULL)return false; 
        $path = trim($path);
        if(!file_exists($path))return false;
        $this->CONFIG_FILE = $path;
        return true;
    }

}
?>
