<?php
/**
 * class Form used to create an object of selected form
 *
 * @author Morozov A.A.
 * @email morozov_aa@tonymstudio.ru
 * @site tonymstudio.ru
 * @version 1
 */
namespace tmsFormManager;

class Form {

    protected  $CONFIG = array() ;  // array of configuration parametrs
    protected $FIELDS = array() ; // array of fieldobjects

    protected $DEFAULT_LINE_DELIMITER = '<br/>';
    protected $LINE_DELIMITER ='<br/>';

        /**
     * метод устанавливает конфигурационные параметры
     * @param array $config
     * @return boolean
     */
    public function setConfig($config = array())
    {
        if(!is_array($config))return false;

        $this->CONFIG = $config;

        return true;
    }

    public function setLineDelimiter($delimiter=NULL)
    {
        if($delimiter==NULL)
            $this->LINE_DELIMITER=$this->DEFAULT_LINE_DELIMITER;
        else
            $this->LINE_DELIMITER=$delimiter;
        return true;
    }

/**
     * Метод создаёт форму из полей на основании переданной конфигурации
     */
    public function buildForm()
    {
        $n = count($this->CONFIG['fields']);
        if($n>0)
        {
            foreach( $this->CONFIG['fields'] as $field_config)
            {
                if($field_config['type'] != '')
                {
                    $field_class = $field_config['type'];
                    $field_class = ucfirst(strtolower($field_class)).'Field';

                    $field_class = '\\tmsFormManager\\'.$field_class;
                    if(\class_exists($field_class))
                    {
                        $field = new $field_class() ;
                        
                        $field->LoadConfig($field_config);

                        $f_num = count($this->FIELDS);
                        $this->FIELDS[$f_num]['id'] = $field->getId();
                        $this->FIELDS[$f_num]['field'] = $field;
                    }

                }
            }
        }
        
    }

    /**
     * Метод возвращает html код для поля по его id
     * @param string $id
     * @return string
     */
    public function getHTMLfield($id=NULL)
    {
        if($id==NULL)return false;
       // if(!\key_exists($id, $this->FIELDS))return false;
       $id_num = NULL;
       $flag_id_num_exist = false;
        $result = '';

        $flag_field_exist = false;

        if(\preg_match('/\[[0-9]+\]$/', $id, $matches))
        {
            $id_num = \substr($matches[0], 1, \strlen($matches[0])-1);
            
            $id = \substr($id, 0, \strpos($id,'[')+1).\substr($id,  \strpos($id, ']'), \strlen($id)-1);

        }

        $n = count($this->FIELDS);

        $repeat=-1;

        for($i=0;$i<$n;$i++)
        {
            if($this->FIELDS[$i]['id']==$id)
            {
                $flag_field_exist = true;
                $result .= $this->FIELDS[$i]['field']->getHTML().$this->LINE_DELIMITER;

                if($id_num!= NULL)
                {
                    $repeat++;
                    if($repeat==$id_num)
                    {
                        $flag_id_num_exist = true;
                        $result = $this->FIELDS[$i]['field']->getHTML() ;
                        break;
                    }
                }
            }

        }

        if($id_num != NULL)
            if(!$flag_id_num_exist)
                throw new \Exception('No field with a such id[index]');

        if(!$flag_field_exist) throw new \Exception('No field with a such id');

        return $result;
        
        //return $this->FIELDS[$id]->getHTML();

        
    }



}
?>
