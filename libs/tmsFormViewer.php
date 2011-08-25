<?php
/**
 * Класс декоратора, позволяющего задавать формат представления формы
 * @author Morozov Anton Andreevich aamorozov83@gmail.com
 * @link http://tonymstudio.ru
 * @copyright Morozov Anton Andreevich
 * @license GPLv3
 * @package tmsFormManager
 * @version 1
 */
namespace tmsFormManager;

class FormViewer {
    protected  $VIEW = '<table>{$REPEAT}<tr><td>{$LABEL}</td><td>{$FIELD}</td></tr>{/$REPEAT}</table>'; // вид
    protected $PATH = 'etc/view/';  // путь к каталогу видов
    protected $VIEW_FILE = null;    // имя вида
    protected $FORM = null;         // указатель на объект формы

    /**
     * Метод указывает путь к каталогу представлений
     * @param string $etc
     * @return boolean
     */
    public function setViewerETC($etc=null)
    {
        if(\is_null($etc))return false;

        if((\file_exists($etc)) && (\is_dir($etc)))$this->PATH = $etc;
        return true;
    }

    /**
     * метод ищет повторяющуюся часть вида и заменяет её тегами, после чего возвращает html код формы
     * @return string
     */
    protected function findRepeate()
    {
        //return \preg_replace_callback('/(\{\$REPEAT\}).+(\{\/\$REPEAT\})/', create_function('$matches', 'return $this->repeat($matches);'), $this->VIEW);
        $start =  \preg_replace('/(.+)(\{\$REPEAT\})(.+)(\{\/\$REPEAT\})(.+)/mi', '$1', $this->VIEW);
        $finish = \preg_replace('/(.+)(\{\$REPEAT\})(.+)(\{\/\$REPEAT\})(.+)/mi', '$5', $this->VIEW);

        $repeat = \preg_replace('/(.+)(\{\$REPEAT\})(.+)(\{\/\$REPEAT\})(.+)/mi', '$3', $this->VIEW);
        $repeat = $this->repeat($repeat);

        $result = $start.$repeat.$finish;

        $result = $this->FORM->getHTMLformstarttag().$result.'</form>';
        return $result;
    }

    /**
     * Метод делает попытку декорирования объекта формы на основании указанного вида
     * @param \tmsFormManager\Form $form
     * @param string $view
     * @return string
     */
    public function render(\tmsFormManager\Form $form, $view=null)
    {
       if(\is_null($view))throw new \Exception('you must specify view of form');

       if(!$this->loadView($view))
           throw new \Exception('can not load view');

       $this->FORM = $form;

       return $this->findRepeate() ;
    }

    /**
     * Метод осуществляет замену тегов вида на html теги
     * @param string $repeat
     * @return string
     */
    protected function repeat($repeat=null)
    {
        //$repeat = \preg_replace('/(\{\$FIELD\})/', 'eee', $repeat);

        if(!\is_object($this->FORM))throw new \Exception('Wrong form type');

        $result = '';
        
        $this->FORM->setFirst();
        $stop_flag = true;
        while($stop_flag)
        {
            $part = '';
            $part = \preg_replace('/(\{\$FIELD\})/', $this->FORM->getCurrentField()->getHTML(), $repeat);
            $part = \preg_replace('/(\{\$LABEL\})/', $this->FORM->getCurrentLabel()->getHTML(), $part);

            $result .= $part;
            $stop_flag = $this->FORM->nextField();
        }

        return $result;
    }

    /**
     * метод загружает данные указанного вида
     * @param string $view
     * @return boolean
     */
    protected  function loadView($view=null)
    {
        if(\is_null($view))throw new \Exception('you must specify view of form');
        $view = trim($view);
        if(!file_exists($this->PATH.$view.'.view'))
            throw new \Exception ('View file not exist');
            
        $this->VIEW_FILE = $this->PATH.$view.'.view';
        $content=\file_get_contents($this->VIEW_FILE);
        if($content===false)
            throw new \Exception('Error while loading view content');

        $this->VIEW = $content;
        unset($content);
        return true;
    }

    
}
?>
