<?php
/**
 * class SelectField to describe the field <select>
 *
 * @author Morozov A.A.
 * @email morozov_aa@tonymstudio.ru
 * @version 1
 */
namespace tmsFormManager;

class SelectField  extends BaseField{

    protected  $TYPE = 'select';
    protected  $SIZE = 1;
    protected  $MULTIPLE = false;

    /**
     * Метод настраевает пустой объект типа TextField на основании передаваемых параметров
     * @param array $config
     */
    public function  LoadConfig(array $config = array())
    {
        if($config['id']!='')$this->setId ($config['id']);
        if($config['name']!='')$this->setName ($config['name']);
        if($config['value']!='')$this->setValue ($config['value']);
        if($config['multiple']!='')$this->setMultiple($config['multiple']);
        if($config['size']!='')$this->setSize($config['size']);
        if($config['class']!='')$this->setClass ($config['class']);

        if($this->getId()===false)
        {
            if($this->getName()===false)
                throw new \Exception ('No field ID');
            else
                $this->setId ($this->getName());
        }

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

        $result .= ' size="'.  $this->SIZE.'" ';

        if($this->MULTIPLE===true) $result .= ' multiple="multiple" ';

        $options = '';
        
        $n=count($this->VALUE);
        if($n>0)
        {
            $option = '';
            foreach ($this->VALUE as $value_raw)
            {
                $option = '<option ';
                $option .= ' value="'.$value_raw['value'].'" ';
                if($value_raw['disabled'])$option .= ' disabled="disabled" ';
                if($value_raw['selected'])$option .= ' selected="selected" ';
                $option .= '>'.$value_raw['value_title'].'</option>';

                $options .= $option;                
            }
        }

        $result = '<select '.$result.'>'.$options.'</select>';

        return $result;

    }

    /**
     * Метод устанавливает ширину элемента в символах 
     * @param integer $size
     * @return boolean
     */
    public function setSize($size = 0)
    {
        $size = trim($size);

        if(!preg_match('/^[0-9]+$/', $size))
                return false;

        $this->SIZE = $size;
        return true;
    }

    /**
     * Метод задаёт значение элемента
     * @param array $value
     * @return boolean
     */
    public function setValue($value_array='')
    {
        
        if(!\is_array($value_array))throw new \Exception ('invalid value type. must be array');

        $n = count($value_array) ;
        if(!$n)return true;

        $i=0;
        foreach ($value_array as $value)
        {
            if(!\key_exists('value', $value))throw new \Exception ('not defined option value');
            $this->VALUE[$i]['value'] = $value['value'];
            if((!\key_exists('value', $value)) || (trim($value['title'])==''))
                $this->VALUE[$i]['value_title'] = $value['value'];
            else
                $this->VALUE[$i]['value_title'] = $value['title'];

            if($value['disabled']===true)$this->VALUE[$i]['disabled'] = true;

            if($value['selected']===true)$this->VALUE[$i]['selected'] = true;

            $i++;
        }
        
        return true;
    }

    public function setMultiple($multiple=false)
    {
        if(!\in_array($multiple, array (true, false)))return false;

        $this->MULTIPLE = $multiple;
        return true;
    }
}
?>
