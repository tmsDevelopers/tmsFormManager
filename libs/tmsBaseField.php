<?php
/**
 * class BaseField used to describe base properties and action common to all fields
 *
 * @author Morozov A.A.
 * @email morozov_aa@tonymstudio.ru
 * @site tonymstudio.ru
 * @version 1
 */

namespace tmsFormManager;

abstract  class BaseField{
    protected $CLASS = '';
    protected $ID = '';
    protected $NAME = '';
    protected $TYPE = '';
    protected $VALUE = '';

    protected $actions = array('onblur', 'onchange', 'onclick', 'ondblclick', 'onfocus', 'onkeydown', 'onkeypress', 'onkeyup', 'onload', 'onmousedown', 'onmousemove', 'onmouseout', 'onmouseover', 'onmouseup', 'onreset', 'onselect', 'onsubmit', 'onunload');


    protected $ACTION_ONBLUR='';
    protected $ACTION_ONCHANGE ='';
    protected $ACTION_ONCLICK = '';
    protected $ACTION_ONDBLCLICK ='';
    protected $ACTION_ONFOCUS = '';
    protected $ACTION_ONKEYDOWN;
    protected $ACTION_ONKEYPRESS = '';
    protected $ACTION_ONKEYUP = '';
    protected $ACTION_ONLOAD = '';
    protected $ACTION_ONMOUSEDOWN  = '';
    protected $ACTION_ONMOUSEMOVE = '';
    protected $ACTION_ONMOUSEOUT = '';
    protected $ACTION_ONMOUSEOVER = '';
    protected $ACTION_ONMOUSEUP = '';
    protected $ACTION_ONRESET = '';
    protected $ACTION_ONSELECT = '';
    protected $ACTION_ONSUBMIT = '';
    protected $ACTION_ONUNLOAD = '';


    abstract public function LoadConfig(array $config=array());
    abstract public function getHTML() ; // get html code of
    abstract public function setValue(); // Метод задаёт значение параметра value элемента

    /**
     * метод возвращает строку с параметрами наиболее общими для элементов (name, id, class...)
     * @return string
     */
    public function getBaseHTMLparametrs()
    {
        $result = '';
        if($this->CLASS!='') $result .= ' class="'.$this->CLASS.'" ';

        if($this->ID!='') $result .= ' id="'.$this->ID.'" ';

        if($this->NAME!='')$result .= ' name="'.$this->NAME.'" ';
        else $result.= ' name="'.$this->ID.'" ';

        return $result;
    }

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
     * Метод возвращает значение параметра class
     * @return string or false
     */
    public function getClass()
    {
        if($this->CLASS=='')return false;
        else return $this->CLASS;
    }

    /**
     * Метод возвращает значение параметра id элемента
     * @return string or false
     */
    public function getId()
    {
        if($this->ID=='')return false;
        else return $this->ID;
    }

    /**
     * Метод возвращает значение параметра name  элемента
     * @return string or false
     */
    public function getName()
    {
        if($this->NAME=='')return false;
        else return $this->NAME;
    }

    /**
     * метод возвращает тип элемента
     * @return string or false
     */
    public function getType()
    {
        if($this->TYPE=='')return false;
        else return $this->TYPE;
    }

    /**
     * метод возвращает значение элемента в установленном для него формате
     * @return mixed
     */
    public function getValue()
    {
        return $this->VALUE;
    }

    /**
     * Метод задаёт значение параметра class
     * @param string $class
     * @return boolean
     */
    public function setClass($class=NULL)
    {
        if($class == NULL)return false;
        $class = trim($class);
        if($class=='')return false;

        if(!preg_match('/^[a-z0-9_]+$/i', $class))
            return false;

        $this->CLASS = $class;
        return true;
    }

   /**
    * Метод задаёт значение id элемента (+ если на задан параметр name, то name=id)
    * @param string $id
    * @return boolean
    */
   public function setId( $id=NULL)
    {
       if($id == NULL)return false;
        $id = trim($id);
        if($id=='')return false;

        if(!preg_match('/^[a-z0-9_\[\]]+$/i', $id))
            return false;

        $this->ID = $id;

        if($this->NAME=='')$this->setName($id) ;
        
        return true;
    }

    /**
     * Метод устанавливает значение параметра name
     * @param string $Name
     * @return boolean
     */
    public function setName( $Name=NULL)
    {
        if($name == NULL)return false;;
        $name = trim($name);
        if($name=='')return false;

        if(!preg_match('/^[a-z0-9_\[\]]+$/i', $name))
            return false;

        $this->NAME = $name;
        return true;
    }

    public function setOnBlur($action = '')
    {
        return $this->setAction('ONBLUR', $action);
    }

    public function setOnChange($action = '')
    {
        return $this->setAction('ONCHANGE', $action);
    }

    public function setOnClick($action = '')
    {
        return $this->setAction('ONCLICK', $action);
    }

    public function setOnDblclick($action = '')
    {
        return $this->setAction('ONDBLCLICK', $action);
    }

    public function setOnFocus($action = '')
    {
        return $this->setAction('ONFOCUS', $action);
    }

    public function setOnKeydown($action = '')
    {
        return $this->setAction('ONKEYDOWN', $action);
    }

    public function setOnKeypress($action = '')
    {
        return $this->setAction('ONKEYPRESS', $action);
    }

    public function setOnKeyup($action = '')
    {
        return $this->setAction('ONKEYUP', $action);
    }

    public function setOnLoad($action = '')
    {
        return $this->setAction('ONLOAD', $action);
    }

    public function setOnMousedown($action = '')
    {
        return $this->setAction('ONMOUSEDOWN', $action);
    }

    public function setOnMousemove($action = '')
    {
        return $this->setAction('ONMOUSEMOVE', $action);
    }

    public function setOnMouseout($action = '')
    {
        return $this->setAction('ONMOUSEOUT', $action);
    }

    public function setOnMouseover($action = '')
    {
        return $this->setAction('ONMOUSEOVER', $action);
    }

    public function setOnMouseup($action = '')
    {
        return $this->setAction('ONMOUSEUP', $action);
    }

    public function setOnReset($action = '')
    {
        return $this->setAction('ONRESET', $action);
    }

    public function setOnSelect($action = '')
    {
        return $this->setAction('ONSELECT', $action);
    }

    public function setOnSubmit($action = '')
    {
        return $this->setAction('ONSUBMIT', $action);
    }

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
