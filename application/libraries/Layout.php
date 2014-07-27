<?php  
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Layout
{

    public $obj;
    public $layout;
    public $layoutDir;
    public $viewDir;

    function __construct()
    {
        $this->obj =& get_instance();
        $this->layout = 'main';
        $this->layoutDir = '/layouts/';
        $this->viewDir = '/main/';
    }

    public function setLayout($layout)
    {
      $this->layout = $layout;
    }

    public function setLayoutDir($layoutDir)
    {
      $this->layoutDir = '/'.$layoutDir.'/';
    }

    public function setViewDir($viewDir)
    {
      $this->viewDir = '/'.$viewDir.'/';
    }

    public function view($view, $data=null, $return=false)
    {
        $loadedData = array();
        $loadedData['content'] = $this->obj->load->view($this->viewDir.$view,$data,true);

        if($return) {
            $output = $this->obj->load->view($this->layoutDir.$this->layout, $loadedData, true);
            return $output;
        }
        else {
            $this->obj->load->view($this->layoutDir.$this->layout, $loadedData, false);
        }
    }
}
