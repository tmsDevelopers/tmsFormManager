<?php
/**
 * form viewer
 *
 * @author Morozov A.A.
 * @email morozov_aa@tonymstudio.ru
 * @site tonymstudio.ru
 * @version 1
 */
namespace tmsFormManager;

class FormViewer {
    protected  $VIEW = '<table>{$REPEAT}<tr><td>{$LABEL}</td><td>{$FIELD}</td></tr>{/$REPEAT}</table>';
    protected $PATH = 'etc/view/';
    protected $VIEW_FILE = null;
    protected $FORM = null;

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

    public function render(\tmsFormManager\Form $form, $view=null)
    {
       if(\is_null($view))throw new Exception('you must specify view of form');

       if(!$this->loadView($view))
           throw new Exception('can not load view');

       $this->FORM = $form;

       return $this->findRepeate() ;
    }

    protected function repeat($repeat=null)
    {
        //$repeat = \preg_replace('/(\{\$FIELD\})/', 'eee', $repeat);

        if(!\is_object($this->FORM))throw new Exception('Wrong form type');

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

    protected  function loadView($view=null)
    {
        if(\is_null($view))throw new Exception('you must specify view of form');
        $view = trim($view);
        if(!file_exists($this->PATH.$view.'.view'))
            throw new Exception ('View file not exist');
            
        $this->VIEW_FILE = $this->PATH.$view.'.view';
        $content=\file_get_contents($this->VIEW_FILE);
        if($content===false)
            throw new Exception('Error while loading view content');

        $this->VIEW = $content;
        unset($content);
        return true;
    }
}
?>
