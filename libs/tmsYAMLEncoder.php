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

    protected  static $CONFIG_FILE = '';

    public static function ReloadConfigfile()
    {
        if(file_exists(self::CONFIG_FILE))
	{
            $data = Spyc::YAMLLoad(self::CONFIG_FILE);
            return $data;
	}
	return false;
    }

}
?>
