<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
namespace tmsFormManager;
/**
 * Description of tmsFormManager
 *
 * @author chipset
 */
class FormManager {
    protected $Encoder = null;    // object of encoder
    protected $CONFIG = array() ; // array of forms configuration

    public function setEncoderMethod(string $method='')
    {
        $method = trim($method) ;
        if(!preg_match('/^[a-z0-9_]+$/', $method)) return false;

        $class_name = $method.'Encoder';
        if(!class_exists($class_name)) return false;

        $this->Encoder = new $class_name();
        return true;
    }

    public function setConfigfile(string $file_path='')
    {
        if(!is_object($this->Encoder)) return false;

        return $this->Encoder->setConfigFile($file_path);
    }

    public function ReloadConfig()
    {
        if(!is_object($this->Encoder)) return false;

        $config = $this->Encoder->ReloadConfigfile();
        if(($config===false) || (!is_array($config)))return false;

        $this->CONFIG = $config;
        return true;
    }

}
?>
