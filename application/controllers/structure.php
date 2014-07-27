<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Structure extends APP_Controller {

    function  __construct()  {
        parent::__construct();
    }

    public function index() {
        redirect('login');
    }

    public function arm_kis() {
        $this->layout->view('arm_kis');
    }

    public function uvedoml() {
        $user = $this->session->userdata('username');
        if ($user == 'kis') {
            $this->layout->view('uvedoml_kis');
        } else {
            $this->layout->view('uvedoml_iogv');
        }
    }

    public function journal() {
        $this->layout->view('journal');
    }

    public function chernovik() {
        $this->layout->view('chernovik');
    }

    public function comments() {
        $this->layout->view('comments');
    }

    public function history_polnomoch() {
        $this->layout->view('history_polnomoch');
    }

    public function history_usl_func() {
        $this->layout->view('history_usl_func');
    }

    public function timeline() {
        $this->layout->view('timeline');
    }

    public function step1() {
        $this->layout->view('polnomoch');
    }

    public function step2() {
        $this->layout->view('razgran_p');
    }

    public function step3() {
        $this->layout->view('step3');
    }

    public function step4() {
        $this->layout->view('step4');
    }

    public function step4_1() {
        $this->layout->view('step4_1');
    }

    public function arm_iogv() {
        $this->layout->view('arm_iogv');
    }

}
