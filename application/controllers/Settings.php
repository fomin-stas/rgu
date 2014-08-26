<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Settings extends APP_Controller {

    function  __construct()  {
        parent::__construct();
        $this->layout->setLayout('main');
    }

    public function index() {
        $this->layout->view('index');
    }
}
