<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Structure extends APP_Controller {

    function  __construct()  {
        parent::__construct();

        $this->is_loggedIn();
    }

    public function index() {
        redirect('login');
    }

    public function arm_kis() {
        $authorities = $this->authority
                            ->with('status')
                            ->with('organization')
                            ->as_array()
                            ->get_all();
        
        // prepare json grid
        $data = array();
        foreach ((array)$authorities as $authority) {
            //{id_poln:"1",name_iogv:"наименование полномочия1",status_poln:"статус полномочия",name_usl:"наименование",id_usl:"1", status_usl:"статус",srok_otveta:"30.04.2014",type:"тип",status_isp:"статус",name_iogvspb:"Наименование ИОГВ СПб"}
            $data[] = array(
                'id_poln' => $authority['id_authority'],
                'name_iogv' => $authority['authority_name'],
                'status_poln' => $authority['status']->name,
                'name_usl' => '',
                'id_usl' => '',
                'status_usl' => '',
                'srok_otveta' => '30.08.2014',
                'status_isp' => '',
                'name_iogvspb' => $authority['organization']->organization_name
                );
        }

        $this->layout->view('arm_kis', array('data' => json_encode($data)));
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
