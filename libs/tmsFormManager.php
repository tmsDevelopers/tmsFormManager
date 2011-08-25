<?php
/**
 * Класс, формменеджера, с объектами которого пограммист и имеет дело
 * @author Morozov Anton Andreevich aamorozov83@gmail.com
 * @link http://tonymstudio.ru
 * @copyright Morozov Anton Andreevich
 * @license GPLv3
 * @package tmsFormManager
 * @version 1
 */
namespace tmsFormManager;

class FormManager {
    protected $Encoder = null;          // object of encoder
    protected $CONFIG = array() ;       // array of forms configuration
    protected $CURRENT_FORM_ID = null;  // id of form to work with
    protected $FORMS = array() ;        // array of form objects

    protected $VIEWER_OBJ = null;       // object of class FormViewer

    /**
     * Метод задаёт формат конфигурационного файла
     * @param string $method
     * @return boolean
     */
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

    /**
     * метод задаёт путь к каталогу с описанием отображений форм для декоратора
     * @param string $etc
     * @return boolean
     */
    public function setViewerETC($etc=null)
    {
        if(!class_exists('\\tmsFormManager\\FormViewer'))
            throw new Exception('FormViewer class not exists');

        if(!\is_object($this->VIEWER_OBJ))
            $this->VIEWER_OBJ = new \tmsFormManager\FormViewer();

        return $this->VIEWER_OBJ->setViewerETC($etc);


    }

    /**
     * Метод очищает переменный формы
     */
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

    /**
     * метод указывает путь к конфигурационному файлу, описывающему формы
     * @param string $file_path
     * @return boolean
     */
    public function setConfigfile(  $file_path=NULL)
    {
        if($file_path== NULL)return false;
        if(!is_object($this->Encoder)) return false;

        return $this->Encoder->setConfigFile($file_path);
    }

    /**
     * метод осуществляет перезагрузку конфигурационной информации
     * @return boolean
     */
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

    /**
     * Метод делает попытку создать объект формы по её id
     * @param string $id
     * @return boolean
     */
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

    /**
     * метод возвращает html код поля по его id
     * @param string $id
     * @return string
     */
    public function getHTMLfield($id=NULL)
    {
        if(is_null($this->CURRENT_FORM_ID))throw new \Exception('No form selected');

        return $this->FORMS[$this->CURRENT_FORM_ID]->getHTMLfield($id);
    }

    /**
     * метод задаёт разделитель строк в форме, чтобы поля не выводились в одну строку
     * @param string $delimiter
     * @return boolean
     */
    public function setLineDelimiter($delimiter=NULL)
    {
        if(is_null($this->CURRENT_FORM_ID))throw new \Exception('No form selected');

        return $this->FORMS[$this->CURRENT_FORM_ID]->setLineDelimiter($delimiter);
    }

    /**
     * метод возвращает html код формы по её id
     * @param string $id
     * @return string
     */
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

    /**
     * метод возвращает html код открывающего тега формы по её id
     * @param string $id
     * @return string
     */
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

    /**
     * метод возвращает html код лэйбла поля по его id
     * @param string $id
     * @return string
     */
    public function getHTMLlabel4field($id=null)
    {
        if(\is_null($id))throw new Exception('field id is not defined');
        if(is_null($this->CURRENT_FORM_ID))throw new \Exception('No form selected');

        return $this->FORMS[$this->CURRENT_FORM_ID]->getHTMLlabel4field($id);
    }

    /**
     * метод возвращает html код формы form_id от декоратора в соответствующем представлении
     * @param string $view
     * @param string $form_id
     * @return string
     */
    public function RenderForm($view=null,$form_id = null )
    {
        if(\is_null($view))throw new Exception('you must specify view of form');

        if(!class_exists('\\tmsFormManager\\FormViewer'))
            throw new Exception('FormViewer class not exists');

        if(!\is_object($this->VIEWER_OBJ))
            $this->VIEWER_OBJ = new \tmsFormManager\FormViewer();

        if(\is_null($form_id))
            if(\is_null($this->CURRENT_FORM_ID)) throw new Exception('Form is not identified');
            else
            {
                if(\key_exists($this->CURRENT_FORM_ID, $this->FORMS))
                    return $this->VIEWER_OBJ->render($this->FORMS[$this->CURRENT_FORM_ID], $view);
            }
        else
        {
            $n=count($this->FORMS);
            if($n==0)throw new Exception('no form to build');
            if(\key_exists($form_id, $this->FORMS))
                return $this->VIEWER_OBJ->render($this->FORMS[$form_id], $view);
        }

    }

    /**
     * метод запускает обработку данных формы от пользователя
     * если в качестве аргумента указан объект. то он наполняется данными.
     * Если аргумент опущен то форма наполняется данными водиночку
     * @param object $object
     * @return boolean
     */
    public function processForm($object=null)
    {
        if(\is_null($this->CURRENT_FORM_ID)) throw new Exception('Form is not identified');
        else
        {
            if(\key_exists($this->CURRENT_FORM_ID, $this->FORMS))
                return $this->FORMS[$this->CURRENT_FORM_ID]->processForm($object);
        }
    }

    /**
     * метод возвращает ссылку на объект поля по его id
     * @param string $id
     * @return object
     */
    public function Field($id=null)
    {
        if(\is_null($this->CURRENT_FORM_ID)) throw new Exception('Form is not identified');
        else
        {
            if(\key_exists($this->CURRENT_FORM_ID, $this->FORMS))
                return $this->FORMS[$this->CURRENT_FORM_ID]->field($id);
        }
        throw new \Exception('field error');
    }
}
?>
