<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
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
