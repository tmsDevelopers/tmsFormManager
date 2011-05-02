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
    protected $FIELDS = array() ; // array of fieldobjects


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
                         
                        $this->FIELDS[$field->getId()] = $field;
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
        if(!\key_exists($id, $this->FIELDS))return false;

        return $this->FIELDS[$id]->getHTML();

        
    }



}
?>
