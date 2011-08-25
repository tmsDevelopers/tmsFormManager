<?php
/**
 * класс описывает поле типа <label>
 * @author Morozov Anton Andreevich aamorozov83@gmail.com
 * @link http://tonymstudio.ru
 * @copyright Morozov Anton Andreevich
 * @license GPLv3
 * @package tmsFormManager
 * @version 1
 */
namespace tmsFormManager;

class Label {

    protected $ID='';   // id поля
    /*** label ***/
    protected $LABEL = '';      // значение лэйбла
    protected $LABELPOSITION = 'left';  // позиция лэйбла относительно поля
    protected $LABEL_POSITIONS = array('left', 'right', 'inside'); // возможние позиции лэйбла относительно поля

    /*** required ***/
    protected $REQUIRED = false; // является ли поле обязательным к заполнению
    protected $REQUIRED_SYMBOL = '*'; // символ, который указывает на то что поле обязательно к заполнению

    /**
     * Method set label text
     * @param string $label
     * @return boolean
     */
    public function setLabel($label = '')
    {
        $label = trim($label);
        $this->LABEL = $label;
        return false;
    }

    /**
     * Method return label text
     * @return string
     */
    public function getLabel()
    {
        return$this->LABEL;
    }

    /**
     * Method set FOR parametr of label
     * @param String $id
     * @return boolean
     */
    public function setId($id='')
    {
        $this->ID= $id;
        return true;
    }

     /**
     * Method set FOR parametr of label
     * @param String $id
     * @return boolean
     */
    public function setfor($id='')
    {
        return $this->setId($id);
    }

    /**
     * method return value of parametr FOR of label
     * @return string
     */
    public function getId()
    {
        return $this->ID;
    }

    /**
     * method return value of parametr FOR of label
     * @return string
     */
    public function getFor()
    {
        return $this->getId();
    }

    /**
     * Method set position of label near field
     * @param string $position
     * @return boolean
     */
    public function setLabelposition($position='')
    {
        $position=\strtolower(trim($position));
        if(!\in_array($position, $this->LABEL_POSITIONS )) return false;
        $this->LABELPOSITION = $position;
        return true;
    }

    /**
     * method return position of label
     * @return boolean
     */
    public function getLabelposition()
    {
        return $this->LABELPOSITION;
    }

    /**
     * Method set parametr Required
     * @param boolean $required
     * @return boolean
     */
    public function setRequired($required=false)
    {
        if(!\in_array($required,array(true, flase)))return false;
        $this->REQUIRED = $required;
        return true;
    }

    /**
     * Method set required symbol
     * @param  string $symbol
     * @return boolean
     */
    public function setRequiredsymbol($symbol='*')
    {
        $this->REQUIRED_SYMBOL = $symbol;
        return true;
    }

    /**
     * Method return html code of label
     * @param string $html field code
     * @return string
     */
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

    

    /**
     * Method load config of label on base of field config
     * @param array $config
     * @return boolean
     */
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
