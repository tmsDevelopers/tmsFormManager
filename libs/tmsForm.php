<?php
/**
 * class Form used to create an object of selected form
 *
 * @author Morozov A.A.
 * @email morozov_aa@tonymstudio.ru
 * @site tonymstudio.ru
 * @version 1
 */
namespace tmsFormManager;

class Form {

    protected $CONFIG = array() ;  // array of configuration parametrs
    protected $FIELDS = array() ; // array of fieldobjects

    protected $ACCEPTCHARSET = null;
    protected $ACTION = null;
    protected $ENCTYPE = null;
    protected $METHOD = 'post';
    protected $ID = null;


    protected $DEFAULT_LINE_DELIMITER = '<br/>';
    protected $LINE_DELIMITER ='<br/>';


    protected $CURRENT_FIELD = 0; // pointer to current field

    /**
     * метод устанавливает конфигурационные параметры
     * @param array $config
     * @return boolean
     */
    public function setConfig($config = array())
    {
        if(!is_array($config))return false;

        $this->CONFIG = $config;

        return true;
    }

    public function setLineDelimiter($delimiter=NULL)
    {
        if($delimiter==NULL)
            $this->LINE_DELIMITER=$this->DEFAULT_LINE_DELIMITER;
        else
            $this->LINE_DELIMITER=$delimiter;
        return true;
    }

/**
     * Метод создаёт форму из полей на основании переданной конфигурации
     */
    public function buildForm()
    {

        if($this->CONFIG['id']!='')$this->setId ($this->CONFIG['id']);
        if($this->CONFIG['name']!='')$this->setName ($this->CONFIG['name']);

        if($this->CONFIG['acceptcharset']!='')$this->setAcceptcharset($this->CONFIG['acceptcharset']);

        if($this->CONFIG['action']!='')$this->setAction ($this->CONFIG['action']);

        if($this->CONFIG['enctype']!='')$this->setEnctype ($this->CONFIG['enctype']);

        if($this->CONFIG['method']!='')$this->setMethod($this->CONFIG['method']);

        $n = count($this->CONFIG['fields']);
        if($n>0)
        {
            foreach( $this->CONFIG['fields'] as $field_config)
            {
                if($field_config['type'] != '')
                {
                    $field_class = $field_config['type'];
                    $field_class = ucfirst(strtolower($field_class)).'Field';

                    $field_class = '\\tmsFormManager\\'.$field_class;
                    if(\class_exists($field_class))
                    {
                        $field = new $field_class() ;
                        
                        $field->LoadConfig($field_config);

                        $f_num = count($this->FIELDS);
                        $this->FIELDS[$f_num]['id'] = $field->getId();
                        $this->FIELDS[$f_num]['field'] = $field;

                        $label_class = '\\tmsFormManager\\Label';
                        if(\class_exists($label_class))
                        {
                            $label = new $label_class() ;
                            $label->load($field_config);
                            $label->setId($this->FIELDS[$f_num]['id']);
                            $this->FIELDS[$f_num]['label'] = $label;
                        }
                    }

                }
            }
        }
        
        
    }

    /**
     * Метод возвращает html код для поля по его id
     * @param string $id
     * @return string
     */
    public function getHTMLfield($id=NULL)
    {
        if($id==NULL)return false;
       // if(!\key_exists($id, $this->FIELDS))return false;
       $id_num = NULL;
       $flag_id_num_exist = false;
        $result = '';

        $flag_field_exist = false;

        if(\preg_match('/\[[0-9]+\]$/', $id, $matches))
        {
            $id_num = \substr($matches[0], 1, \strlen($matches[0])-1);
            
            $id = \substr($id, 0, \strpos($id,'[')+1).\substr($id,  \strpos($id, ']'), \strlen($id)-1);

        }

        $n = count($this->FIELDS);

        $repeat=-1;

        for($i=0;$i<$n;$i++)
        {
            if($this->FIELDS[$i]['id']==$id)
            {
                $flag_field_exist = true;
                $result .= $this->FIELDS[$i]['field']->getHTML();

                if($id_num!= NULL)
                {
                    $repeat++;
                    if($repeat==$id_num)
                    {
                        $flag_id_num_exist = true;
                        $result = $this->FIELDS[$i]['field']->getHTML() ;
                        break;
                    }
                }
            }

        }

        if($id_num != NULL)
            if(!$flag_id_num_exist)
                throw new \Exception('No field with a such id[index]');

        if(!$flag_field_exist) throw new \Exception('No field with a such id');

        return $result;
        
        //return $this->FIELDS[$id]->getHTML();

        
    }

    public function setAcceptcharset($charset=null)
    {
        $charset = trim($charset);
        if(\is_null($charset))return false;
        $this->ACCEPTCHARSET = $charset;
        return true;
    }

    public function setAction($action=null)
    {
        $action = trim($action);
        if(\is_null($action))return false;
        $this->ACTION = $action;
        return true;
    }

    public function setEnctype($enctype=null)
    {
        $enctype = trim($enctype);
        if(\is_null($enctype))return false;
        $this->ENCTYPE = $enctype;
        return true;
    }

    public function setMethod($method = 'post')
    {
        $method = \strtolower(trim($method));
        if(!\in_array($method,array('get', 'post')))$this->METHOD = 'post';
        else $this->METHOD=$method;
        return true;
    }

    public function setId($id = null)
    {
        $id = trim($id);
        if(($id=='') ||(\is_null($id)) )throw new \Exception('Form must have ID (Name)');
        $this->ID = $id;
        return true;
    }

    public function setName($name=null)
    {
        return $this->setId($name);
    }

    public function getId()
    {
        if(is_null($this->ID)) return false;
        return $this->ID;
    }

    /**
     * Method return number of fields in form
     * @return integer
     */
    public function getFieldNUM()
    {
        return count($this->FIELDS);
    }
    public function getName()
    {
        return $this->getId();
    }

    public function getHTMLform()
    {
      $result = '';

      $n = count($this->FIELDS);
      for($i=0;$i<$n;$i++)
      {
          $field_html = $this->FIELDS[$i]['field']->getHTML($this->FIELDS[$i]['id']);
          $field_html = $this->FIELDS[$i]['label']->getHTML($field_html);
          $result .= $field_html.$this->LINE_DELIMITER;
      }

      $form_html = $this->getHTMLformstarttag();
      
      $result =$form_html.$result.'</form>';

      return $result;
    }
    

    public function getHTMLformstarttag()
    {
      $form_html = '';
      $form_html = '<form ';
      if(!\is_null($this->ACTION)) $form_html .= ' action="'.$this->ACTION.'" ';

      $form_html .= ' method="'.$this->METHOD.'" ';

      if(!\is_null($this->ID)) $form_html .= ' name="'.$this->ID.'" ';

      if(\is_null($this->ENCTYPE))$this->ENCTYPE='application/x-www-form-urlencoded';
      $form_html .= ' enctype="'.$this->ENCTYPE.'" ';

      if(!\is_null($this->ACCEPTCHARSET)) $form_html .= ' accept-charset="'.$this->ACCEPTCHARSET.'" ';

      $form_html.='>';
      return $form_html;
    }

    public function getHTMLlabel4field($id=null)
    {
        if(\is_null($id))throw new \Exception('field id is not defined');
       
        $n = count($this->FIELDS);
        if(!$n)throw new \Exception('Form has no fields');
        for($i=0;$i<$n;$i++)
        {
            if($this->FIELDS[$i]['id']==$id)
                return $this->FIELDS[$i]['label']->getHTML();
        }
        throw new \Exception('No field with id='.$id.' in this form');
    }

    

    public function getCurrentField()
    {
        $n = $this->getFieldNUM();
        if(!$n)return false;
        
        if(($this->CURRENT_FIELD>=0)&&($this->CURRENT_FIELD<$n)) 
        {
            return $this->FIELDS[$this->CURRENT_FIELD]['field'];
        }
        return false;
    }

    public function getCurrentLabel()
    {
        $n = $this->getFieldNUM();
        if(!$n)return false;

        if(($this->CURRENT_FIELD>=0)&&($this->CURRENT_FIELD<$n))
        {
            return $this->FIELDS[$this->CURRENT_FIELD]['label'];
        }
        return false;
    }

    public function nextField()
    {
        $n = $this->getFieldNUM();
        if(!$n)return false;

        $next = $this->CURRENT_FIELD+1;
        if($next>=$n)
            return false;
        else
        {
            $this->CURRENT_FIELD++;
            return true;
        }
    }

    public function setFirst()
    {
        $this->CURRENT_FIELD=0;
        return true;
    }


    public function processForm($object=null)
    {
        if(!\is_object($object))$have_object = false;
        else $have_object = true;

        $n = $this->getFieldNUM();
        if(!$n)return false;

        for($i=0;$i<$n;$i++)
        {
            $method_name = 'IFM_set'.\strtoupper(\substr($this->FIELDS[$i]['id'],0, 1)).\substr($this->FIELDS[$i]['id'],1,strlen($this->FIELDS[$i]['id'])-1);
            
            if($this->METHOD=='get')
            {
                if(!$have_object) $this->FIELDS[$i]['field']->getGET();
                else
                {                    
                    if(\method_exists($object, $method_name))
                        $object->$method_name($this->FIELDS[$i]['field']->getGET());
                }
            }

            if($this->METHOD=='post')
            {
                if(!$have_object) $this->FIELDS[$i]['field']->getPOST();
                else
                {
                    if(\method_exists($object, $method_name))
                        $object->$method_name($this->FIELDS[$i]['field']->getPOST());
                }
            }
        }        
    }



    

       
}
?>
