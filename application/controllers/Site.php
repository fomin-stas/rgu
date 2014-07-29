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
        
        // login request 
        if($this->input->is_post() AND $this->form_validation->run()) {
            $login_name = $this->input->post('login_name');   
            $login_password = $this->input->post('login_password');   
            $user = $this->user->get_by('user_name', $login_name);
            if($user) {
                // check user password
                if($this->phpass->check($login_password, $user->password)) {
                    // save userdata at session
                    $userdata = array(
                        'id' => $user->id_user,
                        'id_organization' => $user->id_organization,
                        'user_name' => $user->user_name,
                        'loggedin' => true
                    );
                    $this->session->set_userdata($userdata);

                    switch ($user->id_organization) {
                        case 1:
                            redirect('/structure/arm_kis');
                            break;
                        case 2:
                            redirect('/structure/arm_iogv');
                            break;    
                    }
                }
                else{
                     $this->session->set_flashdata('message', 'Не верное имя пользователя или пароль!');
                }
            }
            else{
                $this->session->set_flashdata('message', 'Пользователя с такимименем не существует!');
            } 
        }
        $this->layout->view('login');
    }

    function logout()
    {
        $this->session->unset_userdata('loggedin');
        redirect('/');
    }
}
