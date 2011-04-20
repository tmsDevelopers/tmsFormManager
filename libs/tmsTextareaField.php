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

    public function getCols()
    {
        return $this->COLS;
    }

    public function getRows()
    {
        return $this->ROWS;
    }

    public function setCols(integer $cols=0)
    {
        if($cols != (int) $cols) return false;

        if($cols === 0)
            $this->COLS = false;
        else
            $this->COLS = $cols;

        return true;
    }

    public function setRows(integer $rows=0)
    {
        if($rows != (int) $rows) return false;

        if($rows === 0)
            $this->ROWS = false;
        else
            $this->ROWS = $rows;

        return true;
    }

}
?>
