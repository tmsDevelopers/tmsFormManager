<?php
/**
 * class InputimageField used to describe <input type="image"> field
 *
 * @author Morozov A.A.
 * @email morozov_aa@tonymstudio.ru
 * @site tonymstudio.ru
 * @version 1
 */
namespace tmsFormManager;

class InputimageField extends BaseField{
    //put your code here
    protected $TYPE = 'inputimage';
    protected $SRC = '';
    protected $BORDER = 0;
    protected $VSPACE = 0;
    protected $HSPACE = 0;

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


    public function  setValue($value = NULL)
    {
        return false;
    }


    public function setSrc($src = NULL)
    {
        if($src==NULL)return false;

        $this->SRC=$src;
        return true;
    }

    public function setBorder($border = 0)
    {
        if(!\preg_match('/^[0-9]+$/', $border ))return false;

        $this->BORDER = $border;
        return true;
    }

    public function setVspace($vspace = 0)
    {
        if(!\preg_match('/^[0-9]+$/', $vspace ))return false;

        $this->VSPACE = $vspace;
        return true;
    }

    public function setHspace($hspace = 0)
    {
        if(!\preg_match('/^[0-9]+$/', $hspace ))return false;

        $this->HSPACE = $hspace;
        return true;
    }

    public function getSrc()
    {
        if($this->SRC=='')return false;
        return $this->SRC;
    }

    public function getBorder()
    {
        return $this->BORDER;
    }

    public function getVspace()
    {
        return $this->VSPACE;
    }

    public function getHspace()
    {
        return $this->HSPACE;
    }

}
?>
