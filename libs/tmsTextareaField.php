<?php
/**
 * class TextareaField used to describe textarea field
 *
 * @author Morozov A.A.
 * @email morozov_aa@tonymstudio.ru
 * @site tonymstudio.ru
 * @version 1
 */
namespace tmsFormManager;

class TextareaField extends BaseField {
    protected $TYPE = 'textarea';
    protected $COLS = false;  // default html
    protected $ROWS = false;  // default html

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

        $this->setBaseActions($config);
    }

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
