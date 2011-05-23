<?php
/**
 * class Encoder is used to load configuration data from file to form manager object
 *
 * @author Morozov A.A.
 * @email morozov_aa@tonymstudio.ru
 * @site tonymstudio.ru
 * @version 1
 */
namespace tmsFormManager;

abstract  class Encoder implements IFencoder{

    protected   $CONFIG_FILE = '';

    abstract  public  function ReloadConfigfile();

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
