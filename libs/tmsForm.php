<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
namespace tmsFormManager;
/**
 * Description of tmsForm
 *
 * @author chipset
 */
class Form {

    protected  $CONFIG = array() ;  // array of configuration parametrs

    public function setConfig($config = array())
    {
        if(!is_array($config))return false;

        $this->CONFIG = $config;
        return true;
    }

    public function buildForm()
    {
        
    }



}
?>
