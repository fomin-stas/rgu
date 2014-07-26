<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Structure extends CI_Controller {

    function index() {
        $this->load->view('login');
    }

    function login() {
        global $is_kis;
        $login_name = $this->input->post('login_name');
        if ($login_name == "КИС") {
            $this->load->view('arm_kis');
            $userdata = array(
                'username' => 'kis'
            );
            $this->session->set_userdata($userdata);
        } elseif ($login_name == "ИОГВ") {
            $this->load->view('arm_iogv');
            $userdata = array(
                'username' => 'iogv'
            );
            $this->session->set_userdata($userdata);
        } else {
            $this->load->view('login');
        }
    }

    function arm_kis() {
        $this->load->view('arm_kis');
    }

    function uvedoml() {
        $user = $this->session->userdata('username');
        if ($user == 'kis') {
            $this->load->view('uvedoml_kis');
        } else {
            $this->load->view('uvedoml_iogv');
        }
    }

    function journal() {
        $this->load->view('journal');
    }

    function chernovik() {
        $this->load->view('chernovik');
    }

    function comments() {
        $this->load->view('comments');
    }

    function history_polnomoch() {
        $this->load->view('history_polnomoch');
    }

    function history_usl_func() {
        $this->load->view('history_usl_func');
    }

    function timeline() {
        $this->load->view('timeline');
    }

    function step1() {
        $this->load->view('polnomoch');
    }

    function step2() {
        $this->load->view('razgran_p');
    }

    function step3() {
        $this->load->view('step3');
    }

    function step4() {
        $this->load->view('step4');
    }

    function step4_1() {
        $this->load->view('step4_1');
    }

    function arm_iogv() {
        $this->load->view('arm_iogv');
    }

}

?>