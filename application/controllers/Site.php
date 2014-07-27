<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Site extends APP_Controller {

    function  __construct()  {
        parent::__construct();
        $this->layout->setLayout('site');
    }

    public function index() {
        redirect('/login');
    }

    public function login() {
        
        global $is_kis;
        $login_name = $this->input->post('login_name');
        
        if ($login_name == "КИС") {
            $userdata = array(
                'username' => 'kis',
                'loggedin' => true
            );
            $this->session->set_userdata($userdata);
            

            redirect('/structure/arm_kis');
        } elseif ($login_name == "ИОГВ") {
            $userdata = array(
                'username' => 'iogv',
                'loggedin' => true
            );
            $this->session->set_userdata($userdata);


            redirect('/structure/arm_iogv');
        }
        $this->layout->view('login');
    }

    function logout()
    {
        $this->session->unset_userdata('loggedin');
        redirect('/');
    }
}
