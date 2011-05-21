<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
namespace tmsFormManager;

class TextField extends BaseField{

    protected  $TYPE = 'text';
    protected  $SIZE = 10;
    protected  $MAXLENGTH = NULL;

    /**
     * Метод настраевает пустой объект типа TextField на основании передаваемых параметров
     * @param array $config
     */
    public function  LoadConfig(array $config = array())
    {
        if($config['id']!='')$this->setId ($config['id']);
        if($config['name']!='')$this->setName ($config['name']);
        if($config['value']!='')$this->setValue ($config['value']);
        if($config['size']!='')$this->setSize($config['size']);
        if($config['maxlength']!='')$this->setMaxlength ($config['maxlength']);
        if($config['class']!='')$this->setClass ($config['class']);

        if($this->getId()===false)
        {
            if($this->getName()===false)
                throw new \Exception ('No field ID');
            else
                $this->setId ($this->getName());
        }

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
        
        $result .= ' size="'.  $this->SIZE.'" ';
        
        if($this->MAXLENGTH!=NULL)$result .=' maxlength="'.  $this->MAXLENGTH.'" ';

        $result = '<input type="text" '.$result.'>';


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
     * Метод устанавливает ширину элемента в символах (поумолчанию 10)
     * @param integer $size
     * @return boolean
     */
    public function setSize($size = 0)
    {
        $size = trim($size);

        if(!preg_match('/^[0-9]+$/', $size))
                return false;

        $this->SIZE = $size;
        return true;
    }

    /**
     * метод устанавливает максимальное количество символов допустимых для ввода в элемент 
     * @param integer $size
     * @return boolean
     */
    public function setMaxlength($size = 0)
    {
        $size = trim($size);

        if(!preg_match('/^[0-9]+$/', $size))
                return false;

        $this->MAXLENGTH = $size;
        return true;
    }
}
?>
