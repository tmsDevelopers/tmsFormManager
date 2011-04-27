<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
namespace tmsFormManager;
/**
 * Description of tmsFormManager
 *
 * @author chipset
 */
class FormManager {
    protected $Encoder = null;    // object of encoder
    protected $CONFIG = array() ; // array of forms configuration
    protected $CURRENT_FORM_ID = ''; // id of form to work with
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
        $this->CURRENT_FORM_ID = '';
        
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

        $n = count($this->CONFIG);
        if($n == 0)return false;

        foreach($this->CONFIG as $form_id => $form)
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

        $n = count($this->CONFIG);
        if($n == 0)return false;

        foreach($this->CONFIG as $form_id => $form)
            if($form_id == $id)
            {
                if(!\array_key_exists($id,  $this->FORMS))
                {
                    $form = new \tmsFormManager\Form();
                    if($form->setConfig($this->CONFIG[$id]))
                    {
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

    }

}
?>
