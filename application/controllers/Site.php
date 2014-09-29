<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Site extends APP_Controller {

    function __construct() {
        parent::__construct();
        $this->layout->setLayout('site');
    }

    public function index() {
        redirect('/login');
    }

    public function login() {

        global $is_kis;

        // login request 
        if ($this->input->is_post() AND $this->form_validation->run()) {
            $login_name = $this->input->post('login_name');
            $login_password = $this->input->post('login_password');
            /*
            $myCurl = curl_init();
            curl_setopt_array($myCurl, array(
                CURLOPT_URL => 'http://reestrgu.iac.spb.ru/auth/',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_POST => true,
                CURLOPT_POSTFIELDS => http_build_query(array('login' => $login_name, 'password' => $login_password))
            ));
            $response_statistic = curl_exec($myCurl);
            curl_close($myCurl);
            $response_data = json_decode($response_statistic);*/

            if (true){//$response_data->access) {
                // check user password
                // save userdata at session
                $userdata = array(
                    'id' => 154, // $response_data->userID,//154
                    'id_organization' => 8958, // $response_data->iogvID[0],//8958
                    'user_name' => 'ksk2004', // $login_name,//ksk2004
                    'loggedin' => true,
                    'user_type' => 1//$response_data->userTypeRRGU//1
                );
                $this->session->set_userdata($userdata);
                $result = $this->user->get($userdata['id']);
                if (!$result) {
                    $this->user->insert(array('id_user' => $userdata['id'], 'id_organization' => $userdata['id_organization'], 'user_name' => $login_name));
                }
                switch (1){//$response_data->userTypeRRGU) {
                    case 1:
                        redirect('/structure/arm_kis');
                        break;
                    default :
                        redirect('/structure/arm_iogv/');
                        break;
                }
            } else {
                $this->session->set_flashdata('message', 'Не верное имя пользователя или пароль!');
            }
        }
        $this->layout->view('login');
    }

    function sync_organization() {
        $myCurl = curl_init();
        curl_setopt_array($myCurl, array(
            CURLOPT_URL => 'http://reestrgu.iac.spb.ru/auth/iogv/',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => http_build_query(array('password' => 'listIOGV4981'))
        ));
        $response_list_iogv = curl_exec($myCurl);
        curl_close($myCurl);
        $response_data = json_decode($response_list_iogv, true);
        foreach ($response_data['iogvID'] as $key => $value) {
            $result = $this->organization_model->get($value);
            if (!$result) {
                $this->organization_model->insert(array('id_organization' => $value, 'id_organization_rank' => 1, 'organization_name' => $response_data['iogvName'][$key]));
            } else {
                $this->organization_model->update($value, array('id_organization_rank' => 1, 'organization_name' => $response_data['iogvName'][$key]));
            }
        }
    }

    function logout() {
        $this->session->unset_userdata('loggedin');
        redirect('/');
    }

}
