<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');


class Controller extends CI_Controller { 
    function index() {
        $this->load->view('arm_kiss');
    }
}
?>