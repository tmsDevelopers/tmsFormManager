<?php
/**
 * класс описывает поле типа <textarea>
 * @author Morozov Anton Andreevich aamorozov83@gmail.com
 * @link http://tonymstudio.ru
 * @copyright Morozov Anton Andreevich
 * @license GPLv3
 * @package tmsFormManager
 * @version 1
 */
namespace tmsFormManager;

class TextareaField extends BaseField {
    protected $TYPE = 'textarea';   // тип поля
    protected $COLS = false;  // атрибут cols
    protected $ROWS = false;  // атрибут rows

    /**
     * Метод загружает конфигурационную информацию из массива
     * @param array $config
     */
    public function  LoadConfig(array $config = array())
    {
        if($config['id']!='')$this->setId ($config['id']);
        if($config['name']!='')$this->setName ($config['name']);
        if($config['value']!='')$this->setValue ($config['value']);
        if($config['cols']!='')$this->setCols ($config['cols']);
        if($config['rows']!='')$this->setRows ($config['rows']);
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
     * метод возвращает html код поля
     * @return string
     */
    public function getHTML()
    {
        if(($this->ID=='')&&($this->NAME==''))return false;

        $result = '';
        $result .= $this->getBaseHTMLparametrs();
        $result  .= ' '.$this->getBaseHTMLactions();

        if($this->COLS!=0) $result .= ' cols="'. $this->COLS.'" ';
        if($this->ROWS!=0) $result .= ' rows="'. $this->ROWS.'" ';
                
        $result = '<textarea '.$result.'>'.$this->VALUE.'</textarea>';

        return $result;
    }

    /**
     * Метод задаёт значение элемента
     * @param string $value
     * @return boolean
     */
    public function  setValue($value= NULL)
    {
        $this->VALUE = $value;
        return true;
    }

    /**
     * Метод возвращает значение ширины в символах. Если значение не задано, то возвращается false
     * @return integer or false
     */
    public function getCols()
    {
        return $this->COLS;
    }

    /**
     * метод возвращает значение высоты элемента в строках. Если значение не задано, то возвращается false
     * @return integer or false
     */
    public function getRows()
    {
        return $this->ROWS;
    }

    /**
     * метод задаёт ширину элемента в символах
     * @param integer $cols
     * @return boolean
     */
    public function setCols($cols= NULL)
    {
        if($cols == NULL) return false;
        if($cols != (int) $cols) return false;

        if($cols === 0)
            $this->COLS = false;
        else
            $this->COLS = $cols;

        return true;
    }

    /**
     * Метод задаёт значение высоты элемента в строках
     * @param integer $rows
     * @return boolean
     */
    public function setRows($rows=NULL)
    {
        if($rows == NULL)return false;
        if($rows != (int) $rows) return false;

        if($rows === 0)
            $this->ROWS = false;
        else
            $this->ROWS = $rows;

        return true;
    }

}
?>
