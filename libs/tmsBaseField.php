<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

namespace tmsFormManager;

abstract  class BaseField{
    protected $CLASS = '';
    protected $ID = '';
    protected $NAME = '';
    protected $TYPE = '';
    protected $VALUE = '';

    abstract public function LoadConfig(array $config=array()){}

    public function getClass()
    {
        if($this->CLASS=='')return false;
        else return $this->CLASS;
    }

    public function getId()
    {
        if($this->ID=='')return false;
        else return $this->ID;
    }

    public function getName()
    {
        if($this->NAME=='')return false;
        else return $this->NAME;
    }

    public function getType()
    {
        if($this->TYPE=='')return false;
        else return $this->TYPE;
    }

    public function getValue()
    {
        return $this->VALUE;
    }

    public function setClass(string $class='')
    {
        $class = trim($class);
        if($class=='')return false;

        if(!preg_match('/^[a-z0-9_]+$/i', $class))
            return false;

        $this->CLASS = $class;
        return true;
    }

   public function setId(string $id='')
    {
        $id = trim($id);
        if($id=='')return false;

        if(!preg_match('/^[a-z0-9_\[\]]+$/i', $id))
            return false;

        $this->ID = $id;

        if($this->NAME=='')$this->setName($id) ;
        
        return true;
    }

    public function setName(string $Name='')
    {
        $name = trim($name);
        if($name=='')return false;

        if(!preg_match('/^[a-z0-9_\[\]]+$/i', $name))
            return false;

        $this->NAME = $name;
        return true;
    }

    /*
    public function setType(string $type='')
    {
        $type = trim($type);
        if($type=='')return false;

        if(!preg_match('/^[a-z0-9_]+$/i', $type))
            return false;

        $this->TYPE = $type;
        return true;
    }
    */
    
    public function setValue(string $value='')
    {
        $this->VALUE = $value;
        return true;
    }

}
?>
