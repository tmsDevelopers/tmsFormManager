<?php
/**
 * class Label used to create labels for fields
 *
 * @author Morozov A.A.
 * @email morozov_aa@tonymstudio.ru
 * @site tonymstudio.ru
 * @version 1
 */
namespace tmsFormManager;

class Label {

    protected $ID='';
    /*** label ***/
    protected $LABEL = '';
    protected $LABELPOSITION = 'left';
    protected $LABEL_POSITIONS = array('left', 'right', 'inside');

    /*** required ***/
    protected $REQUIRED = false;
    protected $REQUIRED_SYMBOL = '*';

     public function setLabel($label = '')
    {
        $label = trim($label);
        $this->LABEL = $label;
        return false;
    }

    public function getLabel()
    {
        return$this->LABEL;
    }

    public function setId($id='')
    {
        $this->ID= $id;
        return true;
    }

    public function setfor($id='')
    {
        return $this->setId($id);
    }

    public function getId()
    {
        return $this->ID;
    }

    public function getFor()
    {
        return $this->getId();
    }

    public function setLabelposition($position='')
    {
        $position=\strtolower(trim($position));
        if(!\in_array($position, $this->LABEL_POSITIONS )) return false;
        $this->LABELPOSITION = $position;
        return true;
    }

    public function getLabelposition()
    {
        return $this->LABELPOSITION;
    }

    public function setRequired($required=false)
    {
        if(!\in_array($required,array(true, flase)))return false;
        $this->REQUIRED = $required;
        return true;
    }

    public function setRequiredsymbol($symbol='*')
    {
        $this->REQUIRED_SYMBOL = $symbol;
        return true;
    }

    public function getHTML($html='')
    {
        $result = '';
        if($this->LABEL!='')
        {
            $result = '<label for="'.$this->ID.'">'.$this->LABEL;
            if($this->REQUIRED)
                    $result .= $this->REQUIRED_SYMBOL;
            $result .= '</label>';
        }
        
        switch ($this->LABELPOSITION)
        {
            default :
            case 'left':
                $result = $result.$html;
                break;
            case 'right':
                $result = $html.$result;
                break;
            case 'inside':
                $result = \preg_replace('/(<\/label>)$/', $html.'</label>', $result);
                break;
        }
        return $result;
    }

    

    public function load($config = array())
    {
        
        if(!count($config))return false;

        if($config['label']!='')$this->setLabel($config['label']);
        if($config['label_position']!='')$this->setLabelposition($config['label_position']);

        if(($config['required']==true) || ($config['required']==false))
        {
            $this->REQUIRED = $config['required'];
        }

        if(\key_exists('required_symbol', $config))
            $this->REQUIRED_SYMBOL = $config['required_symbol'];

        return true;
    }
}
?>
