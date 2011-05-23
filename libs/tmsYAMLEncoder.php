<?php
/**
 * YAMLEncoder is used to decode yaml encripted files
 *
 * @author Morozov A.A.
 * @email morozov_aa@tonymstudio.ru
 * @site tonymstudio.ru
 * @version 1
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
