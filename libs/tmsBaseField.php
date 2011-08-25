<?php
/**
 * Базовый класс описывающий наиболее общие свойства и методы полей
 * @author Morozov Anton Andreevich aamorozov83@gmail.com
 * @link http://tonymstudio.ru
 * @copyright Morozov Anton Andreevich
 * @license GPLv3
 * @package tmsFormManager
 * @version 1
 */
namespace tmsFormManager;

abstract  class BaseField extends BaseActions{
    protected $CLASS = '';  // class parametr
    protected $ID = '';     // id parametr
    protected $NAME = '';   // name parametr
    protected $TYPE = '';   // type parametr
    protected $VALUE = '';  // value parametr


      /*** required ***/
    protected $REQUIRED = false;

    /**
     * метод позволяющий производить автонастройку поля
     */
    abstract public function LoadConfig(array $config=array()); 

    /**
     * Метод возвращает html код поля
     */
    abstract public function getHTML() ;

    /**
     *  Метод задаёт значение параметра value элемента
     */
    abstract public function setValue();

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

    /**
     * метод задаёт является ли поле обязательным к заполнению
     * @param boolean $required
     * @return boolean
     */
    public function setRequired($required=false)
    {
        if(!\in_array($required,array(true, false)))return false;
        $this->REQUIRED = $required;
        return true;
    }

    /**
     * метод принимает значение поля формы методом GET
     * @return mixed
     */
    public function getGET()
    {
        $this->VALUE=$_GET[$this->ID];
        return $this->VALUE;
    }

    /**
     * метод принимает значение поля методом POST
     * @return mixed
     */
    public function getPOST()
    {
        $this->VALUE=$_POST[$this->ID];
        return $this->VALUE;
    }

    /**
     * Метод загрушает настройки поля из массива
     * @param array $config
     * @return boolean
     */
    protected function Load($config=array())
    {
         return true;
    }

}
?>
