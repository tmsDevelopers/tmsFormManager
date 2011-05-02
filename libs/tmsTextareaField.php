<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of tmsTextareaField
 *
 * @author chipset
 */
namespace tmsFormManager;

class TextareaField extends BaseField {
    protected $TYPE = 'textarea';
    protected $COLS = false;  // default html
    protected $ROWS = false;  // default html

    public function  LoadConfig(array $config = array()) {
        
    }

    public function getHTML() {}
    public function  setValue() {
        
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
    public function setCols(integer $cols= NULL)
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
    public function setRows(integer $rows=NULL)
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
