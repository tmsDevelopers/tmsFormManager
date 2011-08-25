<?php
/**
 * Базовый класс описывающий события для полей
 * @author Morozov Anton Andreevich aamorozov83@gmail.com
 * @link http://tonymstudio.ru
 * @copyright Morozov Anton Andreevich 
 * @license GPLv3
 * @package tmsFormManager
 * @version 1
 */
namespace tmsFormManager;

class BaseActions {
    protected $actions = array('onblur', 'onchange', 'onclick', 'ondblclick', 'onfocus', 'onkeydown', 'onkeypress', 'onkeyup', 'onload', 'onmousedown', 'onmousemove', 'onmouseout', 'onmouseover', 'onmouseup', 'onreset', 'onselect', 'onsubmit', 'onunload');


    protected $ACTION_ONBLUR='';        // action ONBLUR property
    protected $ACTION_ONCHANGE ='';     // action ONCHANGE property
    protected $ACTION_ONCLICK = '';     // action ONCLICK property
    protected $ACTION_ONDBLCLICK ='';   // action ONDBLCLICK property
    protected $ACTION_ONFOCUS = '';     // action ONFOCUS property
    protected $ACTION_ONKEYDOWN;        // action ONKEYDOWN property
    protected $ACTION_ONKEYPRESS = '';  // action ONKEYPRESS property
    protected $ACTION_ONKEYUP = '';     // action ONKEYUP property
    protected $ACTION_ONLOAD = '';      // action ONLOAD property
    protected $ACTION_ONMOUSEDOWN  = '';// action ONMOUSEDOWN property
    protected $ACTION_ONMOUSEMOVE = ''; // action ONMOUSEMOVE property
    protected $ACTION_ONMOUSEOUT = '';  // action ONMOUSEOUT property
    protected $ACTION_ONMOUSEOVER = ''; // action ONMOUSEOVER property
    protected $ACTION_ONMOUSEUP = '';   // action ONMOUSEUP property
    protected $ACTION_ONRESET = '';     // action ONRESET property
    protected $ACTION_ONSELECT = '';    // action ONSELECT property
    protected $ACTION_ONSUBMIT = '';    // action ONSUBMIT property
    protected $ACTION_ONUNLOAD = '';    // action ONUNLOAD property

    /**
     * Метод возвращает часть html кода связанную с событиями мыши для поля
     * @return string
     */
    public function getBaseHTMLactions()
    {
        $result = '';

        if($this->ACTION_ONBLUR != '') $result .= ' onblur="'.$this->ACTION_ONBLUR.'" ';
        if($this->ACTION_ONCHANGE != '') $result .= ' onchange="'.$this->ACTION_ONCHANGE.'" ';
        if($this->ACTION_ONCLICK != '') $result .= ' onclick="'.$this->ACTION_ONCLICK.'" ';
        if($this->ACTION_ONDBLCLICK  != '') $result .= ' ondblclick="'.$this->ACTION_ONDBLCLICK.'" ';
        if($this->ACTION_ONFOCUS  != '') $result .= ' onfocus="'.$this->ACTION_ONFOCUS.'" ';
        if($this->ACTION_ONKEYDOWN != '') $result .= ' onkeydown="'.$this->ACTION_ONKEYDOWN.'" ';
        if($this->ACTION_ONKEYPRESS != '') $result .= ' onkepress="'.$this->ACTION_ONKEYPRESS.'" ';
        if($this->ACTION_ONKEYUP != '') $result .= ' onkeyup="'.$this->ACTION_ONKEYUP.'" ';
        if($this->ACTION_ONLOAD  != '') $result .= ' onload="'.$this->ACTION_ONLOAD.'" ';
        if($this->ACTION_ONMOUSEDOWN  != '') $result .= ' onmousedown="'.$this->ACTION_ONMOUSEDOWN.'" ';
        if($this->ACTION_ONMOUSEMOVE  != '') $result .= ' onmousemove="'.$this->ACTION_ONMOUSEMOVE.'" ';
        if($this->ACTION_ONMOUSEOUT  != '') $result .= ' onmouseout="'.$this->ACTION_ONMOUSEOUT.'" ';
        if($this->ACTION_ONMOUSEOVER  != '') $result .= ' onmouseover="'.$this->ACTION_ONMOUSEOVER.'" ';
        if($this->ACTION_ONMOUSEUP  != '') $result .= ' onmouseup="'.$this->ACTION_ONMOUSEUP.'" ';
        if($this->ACTION_ONRESET  != '') $result .= ' onreset="'.$this->ACTION_ONRESET.'" ';
        if($this->ACTION_ONSELECT  != '') $result .= ' onselect="'.$this->ACTION_ONSELECT.'" ';
        if($this->ACTION_ONSUBMIT  != '') $result .= ' onsubmit="'.$this->ACTION_ONSUBMIT.'" ';
        if($this->ACTION_ONUNLOAD  != '') $result .= ' onunload="'.$this->ACTION_ONUNLOAD.'" ';
        return $result;
    }

    /**
     * метод задаёт действие событию onblur
     * @param string $action
     * @return boolean
     */
    public function setOnBlur($action = '')
    {
        return $this->setAction('ONBLUR', $action);
    }

    /**
     * метод задаёт действие событию onchange
     * @param string $action
     * @return boolean
     */
    public function setOnChange($action = '')
    {
        return $this->setAction('ONCHANGE', $action);
    }

    /**
     * метод задаёт действие событию onclick
     * @param string $action
     * @return boolean
     */
    public function setOnClick($action = '')
    {
        return $this->setAction('ONCLICK', $action);
    }

    /**
     * метод задаёт действие событию ondblclick
     * @param string $action
     * @return boolean
     */
    public function setOnDblclick($action = '')
    {
        return $this->setAction('ONDBLCLICK', $action);
    }

    /**
     * метод задаёт действие событию onfocus
     * @param string $action
     * @return boolean
     */
    public function setOnFocus($action = '')
    {
        return $this->setAction('ONFOCUS', $action);
    }

    /**
     * метод задаёт действие событию onkeydown
     * @param string $action
     * @return boolean
     */
    public function setOnKeydown($action = '')
    {
        return $this->setAction('ONKEYDOWN', $action);
    }

    /**
     * метод задаёт действие событию onkeypress
     * @param string $action
     * @return boolean
     */
    public function setOnKeypress($action = '')
    {
        return $this->setAction('ONKEYPRESS', $action);
    }

    /**
     * метод задаёт действие событию onkeyup
     * @param string $action
     * @return boolean
     */
    public function setOnKeyup($action = '')
    {
        return $this->setAction('ONKEYUP', $action);
    }

    /**
     * метод задаёт действие событию onload
     * @param string $action
     * @return boolean
     */
    public function setOnLoad($action = '')
    {
        return $this->setAction('ONLOAD', $action);
    }

    /**
     * метод задаёт действие событию onmousedown
     * @param string $action
     * @return boolean
     */
    public function setOnMousedown($action = '')
    {
        return $this->setAction('ONMOUSEDOWN', $action);
    }

    /**
     * метод задаёт действие событию onmousemove
     * @param string $action
     * @return boolean
     */
    public function setOnMousemove($action = '')
    {
        return $this->setAction('ONMOUSEMOVE', $action);
    }

    /**
     * метод задаёт действие событию onmouseout
     * @param string $action
     * @return boolean
     */
    public function setOnMouseout($action = '')
    {
        return $this->setAction('ONMOUSEOUT', $action);
    }

    /**
     * метод задаёт действие событию onmouseover
     * @param string $action
     * @return boolean
     */
    public function setOnMouseover($action = '')
    {
        return $this->setAction('ONMOUSEOVER', $action);
    }

    /**
     * метод задаёт действие событию onmouseup
     * @param string $action
     * @return boolean
     */
    public function setOnMouseup($action = '')
    {
        return $this->setAction('ONMOUSEUP', $action);
    }

    /**
     * метод задаёт действие событию onreset
     * @param string $action
     * @return boolean
     */
    public function setOnReset($action = '')
    {
        return $this->setAction('ONRESET', $action);
    }

    /**
     * метод задаёт действие событию onselect
     * @param string $action
     * @return boolean
     */
    public function setOnSelect($action = '')
    {
        return $this->setAction('ONSELECT', $action);
    }

    /**
     * метод задаёт действие событию onsubmit
     * @param string $action
     * @return boolean
     */
    public function setOnSubmit($action = '')
    {
        return $this->setAction('ONSUBMIT', $action);
    }

    /**
     * метод задаёт действие событию onunload
     * @param string $action
     * @return boolean
     */
    public function setOnUnload($action = '')
    {
        return $this->setAction('ONUNLOAD', $action);
    }

    /**
     * Метод задаёт соответствие действия произошедшему событию
     * @param string $action_name
     * @param string $action
     * @return boolean
     */
    protected  function setAction($action_name = '', $action ='' )
    {
        $action = trim($action);
        $action_name = trim($action_name);
        if($action_name == '') return false;

        $action_name = 'ACTION_'.\strtoupper($action_name);
        if(!\property_exists($this, $action_name) )  return false;;

        $this->$action_name = $action;
        return true;
    }

    /**
     * Метод задаёт все события связанные с действием мышью, на основании конфигурационного массива
     * @param array $config
     * @return boolean
     */
    protected function  setBaseActions($config=NULL)
    {
        if(($config == NULL) || (!\is_array($config))) return false;

        $n = count($config) ;
        if($n<1) return false;

        foreach ($config as $key => $value)
        {
            if(\in_array(\strtolower($key), $this->actions))
                $this->setAction ($key, $value);
        }
    }

}
?>
