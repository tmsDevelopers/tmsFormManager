<?php
/**
 * Класс описывает поле типа <input type="hidden"
 * @author Morozov Anton Andreevich aamorozov83@gmail.com
 * @link http://tonymstudio.ru
 * @copyright Morozov Anton Andreevich
 * @license GPLv3
 * @package tmsFormManager
 * @version 1
 */
namespace tmsFormManager;

class CheckboxField extends BaseField{

    protected  $TYPE = 'checkbox';  // type
    protected  $CHECKED = false;    // parametr checked
    

    /**
     * Метод настраевает пустой объект типа TextField на основании передаваемых параметров
     * @param array $config
     */
    public function  LoadConfig(array $config = array())
    {
        if($config['id']!='')$this->setId ($config['id']);
        if($config['name']!='')$this->setName ($config['name']);
        if($config['value']!='')$this->setValue ($config['value']);
        if($config['checked']!='')$this->setChecked($config['checked']);
        
        if($config['class']!='')$this->setClass ($config['class']);

        if($this->getId()===false)
        {
            if($this->getName()===false)
                throw new \Exception ('No field ID');
            else
                $this->setId ($this->getName());
        }

        $this->Load($config) ;
        $this->setBaseActions($config);

    }

    /**
     * Метод возвращает html код поля 
     * @return string
     */
    public function getHTML()
    {
        if(($this->ID=='')&&($this->NAME==''))return false;

        $result = '';
        $result .= $this->getBaseHTMLparametrs();
        $result  .= ' '.$this->getBaseHTMLactions();

        $result .= ' value="'.$this->VALUE.'" ';
        
        if($this->CHECKED===true)$result .=' checked="checked" ';

        $result = '<input type="checkbox" '.$result.'>';


        return $result;
        
    }

    /**
     * Метод задаёт значение элемента
     * @param string $value
     * @return boolean
     */
    public function setValue($value='')
    {
        $this->VALUE = $value;
        return true;
    }


    /**
     * Метод устанавливает/снимает отметку с элемента checkbox
     * @param boolean $checked
     * @return boolean
     */
    public function setChecked($checked=false)
    {
        if(!\in_array($checked,array(true, false)))return false;

        $this->CHECKED = $checked;
        return true;
    }

    
}
?>
