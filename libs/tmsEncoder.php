<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
namespace tmsFormManager;

abstract  class Encoder implements IFencoder{

    protected  static $CONFIG_FILE = '';

    abstract  public static function ReloadConfigfile()
    {
        
    }

    public static function setConfigfile(string $path ='')
    {
        $path = trim($path);
        if(!file_exists($path))return false;

        self::$CONFIG_FILE = $path;
        return true;
    }

}
?>
