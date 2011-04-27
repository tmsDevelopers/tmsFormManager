<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of tmsYAMLEncoder
 *
 * @author chipset
 */
namespace tmsFormManager;

class YAMLEncoder extends Encoder{

    //protected  static $CONFIG_FILE = '';
    public function __construct(){//echo "ololo";
        
    }

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
