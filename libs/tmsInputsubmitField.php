<?php
/**
 * class InputsubmitField used to describe <input type="submit"> field
 *
 * @author Morozov A.A.
 * @email morozov_aa@tonymstudio.ru
 * @site tonymstudio.ru
 * @version 1
 */
namespace tmsFormManager;

class InputsubmitField extends BaseField {

    //put your code here
    protected $TYPE = 'inputsubmit';

    /**
     * Метод настраевает пустой объект типа ImageInput на основании передаваемых параметров
     * @param array $config
     */
    public function  LoadConfig(array $config = array())
    {
        if($config['id']!='')$this->setId ($config['id']);
        if($config['name']!='')$this->setName ($config['name']);

        if($config['value']!='')$this->setValue ($config['value']);

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

        $result = '<input type="submit" '.$result.'>';

        return $result;
    }


    public function  setValue($value = NULL)
    {
        if($value==NULL)return false;

        $this->VALUE=$value;
        return true;
    }




}
?>
