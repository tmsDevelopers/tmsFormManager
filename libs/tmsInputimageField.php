<?php
/**
 * класс описывает поле типа <input type="image">
 * @author Morozov Anton Andreevich aamorozov83@gmail.com
 * @link http://tonymstudio.ru
 * @copyright Morozov Anton Andreevich
 * @license GPLv3
 * @package tmsFormManager
 * @version 1
 */
namespace tmsFormManager;

class InputimageField extends BaseField{
    //put your code here
    protected $TYPE = 'inputimage'; // тип поля
    protected $SRC = '';            // атрибут src
    protected $BORDER = 0;          // атрибут border
    protected $VSPACE = 0;          // атрибут vspace
    protected $HSPACE = 0;          // атрибут hspace

    /**
     * Метод настраевает пустой объект типа Inputimage на основании передаваемых параметров
     * @param array $config
     */
    public function  LoadConfig(array $config = array())
    {
        if($config['id']!='')$this->setId ($config['id']);
        if($config['name']!='')$this->setName ($config['name']);

        if($config['class']!='')$this->setClass ($config['class']);
        if($config['src']!='')$this->setSrc ($config['src']);
        if($config['border']!='')$this->setBorder ($config['border']);
        if($config['vspace']!='')$this->setVspace ($config['vspace']);
        if($config['hspace']!='')$this->setHspace ($config['hspace']);

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
     * Метод возвращает html код поля
     * @return string
     */
    public function getHTML()
    {
        if(($this->ID=='')&&($this->NAME==''))return false;

        $result = '';
        $result .= $this->getBaseHTMLparametrs();
        $result  .= ' '.$this->getBaseHTMLactions();



        $result .= ' src="'.  $this->SRC.'" ';

        if($this->BORDER!=NULL)$result .=' border="'.  $this->BORDER.'" ';
        if($this->HSPACE!=NULL)$result .=' hspace="'.  $this->HSPACE.'" ';
        if($this->VSPACE!=NULL)$result .=' vspace="'.  $this->VSPACE.'" ';

        $result = '<input type="image" '.$result.'>';


        return $result;

    }

    /**
     * Метод задаёт значение несуществующего элемента
     * @param null $value
     * @return boolean
     */
    public function  setValue($value = NULL)
    {
        return false;
    }

    /**
     * метод задаёт атрибут src
     * @param string $src
     * @return boolean
     */
    public function setSrc($src = NULL)
    {
        if($src==NULL)return false;

        $this->SRC=$src;
        return true;
    }

    /**
     * метод задаёт атрибут border
     * @param integer $border
     * @return boolean
     */
    public function setBorder($border = 0)
    {
        if(!\preg_match('/^[0-9]+$/', $border ))return false;

        $this->BORDER = $border;
        return true;
    }

    /**
     * метод задаёт атрибут vspace
     * @param integer $vspace
     * @return boolean
     */
    public function setVspace($vspace = 0)
    {
        if(!\preg_match('/^[0-9]+$/', $vspace ))return false;

        $this->VSPACE = $vspace;
        return true;
    }

    /**
     * метод задаёт атрибут hspace
     * @param integer $hspace
     * @return boolean
     */
    public function setHspace($hspace = 0)
    {
        if(!\preg_match('/^[0-9]+$/', $hspace ))return false;

        $this->HSPACE = $hspace;
        return true;
    }

    /**
     * метод возвращает значение атрибут src
     * @return string
     */
    public function getSrc()
    {
        if($this->SRC=='')return false;
        return $this->SRC;
    }

    /**
     * метод возвращает значение атрибута border
     * @return integer
     */
    public function getBorder()
    {
        return $this->BORDER;
    }

    /**
     * метод возвращает значение атрибута vspace
     * @return integer
     */
    public function getVspace()
    {
        return $this->VSPACE;
    }

    /**
     * метод возвращает значение атрибута hspace
     * @return integer
     */
    public function getHspace()
    {
        return $this->HSPACE;
    }

}
?>
