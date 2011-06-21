<?php
/**
 * class FormManager used to create an object to work with forms
 *
 * @author Morozov A.A.
 * @email morozov_aa@tonymstudio.ru
 * @site tonymstudio.ru
 * @version 1
 */
namespace tmsFormManager;

class FormManager {
    protected $Encoder = null;    // object of encoder
    protected $CONFIG = array() ; // array of forms configuration
    protected $CURRENT_FORM_ID = null; // id of form to work with
    protected $FORMS = array() ;    // array of form objects

    public function setEncoderMethod($method=NULL)
    {
        if($method==NULL)return false;
        $method = trim($method) ;
        if(!preg_match('/^[a-z0-9_]+$/i', $method)) return false;

        $class_name = 'tmsFormManager\\'.$method.'Encoder';
        if(!class_exists($class_name)) return false;

        $this->Encoder = new $class_name();
        
        return true;
    }

    protected function cleen_vars()
    {
        $this->CURRENT_FORM_ID = null;
        
        if(count($this->FORMS)>0)
        {
            foreach($this->FORMS as $form)
                    $form->__destruct() ;
        }
        $this->FORMS = array() ;

    }

    public function setConfigfile(  $file_path=NULL)
    {
        if($file_path== NULL)return false;
        if(!is_object($this->Encoder)) return false;
       
        return $this->Encoder->setConfigFile($file_path);
    }

    public function ReloadConfig()
    {
        if(!is_object($this->Encoder)) return false;
        
        $config = $this->Encoder->ReloadConfigfile();
        
        if(($config===false) || (!is_array($config)))return false;

        $this->CONFIG = $config;
        $this->cleen_vars();

        $n = count($this->CONFIG['forms']);
        if($n>0)
        {
            foreach ($this->CONFIG['forms'] as $formid => $formconfig)
            {
                $this->createFormById($formid);
            }
        }
        //print_r($this->CONFIG);
        return true;
    }


    /**
     * Метод задаёт форму, с которой будет производиться работа по её id
     * @param string $id
     * @return boolean
     */
    public function setForm($id=NULL)
    {
        if($id == NULL)return false;
        $id = trim($id);
        if($id=='')return false;

        $n = count($this->CONFIG['forms']);
        if($n == 0)return false;

        foreach($this->CONFIG['forms'] as $form_id => $form)
            if($form_id == $id)
            {
                $this->CURRENT_FORM_ID = $id;
                return true;
            }
        return false;
    }

    protected  function createFormById($id=NULL)
    {
        if($id == NULL)return false;
        $id = trim($id);
        if($id=='')return false;

        $n = count($this->CONFIG['forms']);
        if($n == 0)return false;

        foreach($this->CONFIG['forms'] as $form_id => $form)
            if($form_id == $id)
            {
                if(!\array_key_exists($id,  $this->FORMS))
                {
                    $form = new \tmsFormManager\Form();
                    $form->setId($id);
                    if($form->setConfig($this->CONFIG['forms'][$id]))
                    {
                        $form->buildForm();
                        $this->FORMS[$id] = $form;
                        return true;
                    }
                }
                return false;
            }
        return false;
    }


    public function getHTMLfield($id=NULL)
    {
        if(is_null($this->CURRENT_FORM_ID))throw new \Exception('No form selected');
        
        return $this->FORMS[$this->CURRENT_FORM_ID]->getHTMLfield($id);
    }

    public function setLineDelimiter($delimiter=NULL)
    {
        if(is_null($this->CURRENT_FORM_ID))throw new \Exception('No form selected');

        return $this->FORMS[$this->CURRENT_FORM_ID]->setLineDelimiter($delimiter);
    }

    public function getHTMLform($id=null)
    {
        if(\is_null($id))
            if(\is_null($this->CURRENT_FORM_ID)) throw new Exception('Form is not identified');
            else
            {
                if(\key_exists($this->CURRENT_FORM_ID, $this->FORMS))
                    return $this->FORMS[$this->CURRENT_FORM_ID]->getHTMLform();
            }
        else
        {
            $n=count($this->FORMS);
            if($n==0)throw new Exception('no form to build');
            if(\key_exists($id, $this->FORMS))
                return $this->FORMS[$id]->getHTMLform();
        }
    }

    public function getHTMLformsstarttag($id=null)
    {
        if(\is_null($id))
            if(\is_null($this->CURRENT_FORM_ID)) throw new Exception('Form is not identified');
            else
            {
                if(\key_exists($this->CURRENT_FORM_ID, $this->FORMS))
                    return $this->FORMS[$this->CURRENT_FORM_ID]->getHTMLformstarttag();
            }
        else
        {
            $n=count($this->FORMS);
            if($n==0)throw new Exception('no form to build');
            if(\key_exists($id, $this->FORMS))
                return $this->FORMS[$id]->getHTMLformstarttag();
        }
    }

    public function getHTMLlabel4field($id=null)
    {
        if(\is_null($id))throw new Exception('field id is not defined');
        if(is_null($this->CURRENT_FORM_ID))throw new \Exception('No form selected');

        return $this->FORMS[$this->CURRENT_FORM_ID]->getHTMLlabel4field($id);
    }

    public function RenderForm($view=null,$form_id = null )
    {
        if(\is_null($view))throw new Exception('you must specify view of form');

        if(!class_exists('\\tmsFormManager\\FormViewer'))
            throw new Exception('FormViewer class not exists');

        $FormViewer = new \tmsFormManager\FormViewer();

        if(\is_null($form_id))
            if(\is_null($this->CURRENT_FORM_ID)) throw new Exception('Form is not identified');
            else
            {
                if(\key_exists($this->CURRENT_FORM_ID, $this->FORMS))
                    return $FormViewer->render($this->FORMS[$this->CURRENT_FORM_ID], $view);
            }
        else
        {
            $n=count($this->FORMS);
            if($n==0)throw new Exception('no form to build');
            if(\key_exists($form_id, $this->FORMS))
                return $FormViewer->render($this->FORMS[$form_id], $view);
        }
        
    }

    public function processForm($object=null)
    {
        if(\is_null($this->CURRENT_FORM_ID)) throw new Exception('Form is not identified');
        else
        {
            if(\key_exists($this->CURRENT_FORM_ID, $this->FORMS))
                return $this->FORMS[$this->CURRENT_FORM_ID]->processForm($object);
        }
    }
}
?>
