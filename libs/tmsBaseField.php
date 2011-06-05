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

abstract  class BaseField extends BaseActions{
    protected $CLASS = '';
    protected $ID = '';
    protected $NAME = '';
    protected $TYPE = '';
    protected $VALUE = '';

    

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

    

}
?>
