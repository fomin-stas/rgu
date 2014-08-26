<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Conformance extends APP_Controller {

    function __construct() {
        parent::__construct();

    }
    
    public function index(){
        echo '1';
    }
    
     public function step1() {
        $db = $this->organization_model->dropdown('organization_name');
        $db_iogv = $this->organization_model->dropdown('organization_name', 'organization_name');
        $data['db'] = $db;
        $data['db_iogv'] = $db_iogv;
        $this->layout->view('polnomoch', $data);
    }

    public function step1_submit() {
        $authority['authority_name'] = $this->input->post('name_authority');
        $property['punkt_iogv'] = $this->input->post('punkt_iogv');
        $property['name_iogv'] = $this->input->post('name_iogv');
        $property['rekvisit_npa'] = $this->input->post('rekvisit_npa');
        $property['project_post'] = $this->input->post('project_post');
        $property['srok_otveta'] = $this->input->post('srok_otveta');
        $authority['id_organization'] = $this->input->post('select_org');
        $authority['id_authority_status'] = 1;
        //обработка добавления комментария - позже
        $comments['comment_st1'] = $this->input->post('comment_st1');
        $this->load->model('authority');
        $id_authority = $this->authority->insert($authority);
        $this->authority_property_model->_id_authority = $id_authority;
        $this->authority_property_model->insert_where_code_many($property);
        redirect('structure/arm_kis');
    }

    public function step2($id_authority) {
        $authority = $this->authority->get($id_authority);
        $data = $authority;
        $authority_property = $this->authority_property_model->get_many_by('id_authority', $id_authority);
        $organization = $this->organization_model->get($authority['id_organization']);
        $data['organization'] = $organization->organization_name;
        $data['spher'] = $this->spher->dropdown('name', 'name');
        $data['organization_provide_service'] = $this->organization_model->dropdown('organization_name', 'organization_name');
        foreach ($authority_property as $value) {
            $property = $this->property->get($value['id_property']);
            $data[$property['code']] = $value['value'];
        }
        $this->layout->view('razgran_p', $data);
    }

    //всю эту хренотень с шагами - в отдельный класс
    public function step2_submit() {
        $data = $_POST;
        $id_authority = $this->input->post('id_authority');
        foreach ($data as $name => $value) {
            if ($name{3} == '_') {
                $service_num = $name{2};
                if (strlen($name) == 5)
                    $property_num = $name{4};
                else
                    $property_num = substr($name, 4, 2);
            }
            else {
                $service_num = substr($name, 3, 2);
                if (strlen($name) == 5)
                    $property_num = $name{5};
                else
                    $property_num = substr($name, 5, 2);
            }
            switch (substr($name, 0, 2)) {
                case 'sr':
                    $services['sr_' . $service_num]['sr_' . $property_num] = $value;
                    break;
                case 'sn':
                    $services['sn_' . $service_num]['sn_' . $property_num] = $value;
                    break;
                case 'sk':
                    $services['sk_' . $service_num]['sk_' . $property_num] = $value;
                    break;
            }
        }
        $comments['comment_st2'] = $this->input->post('comment_st2');
        foreach ($services as $name => $property) {
            $service['id_authority'] = $id_authority;
            switch (substr($name, 0, 2)) {
                case 'sr':
                    $service['id_service_type'] = 7;
                    $service['service_name'] = $property['sr_0'];
                    break;
                case 'sn':
                    $service['id_service_type'] = 8;
                    $service['service_name'] = $property['sn_0'];
                    break;
                case 'sk':
                    $service['id_service_type'] = 9;
                    $service['service_name'] = $property['sk_0'];
                    break;
            }
            $id_service = $this->service->insert($service);
            $this->service_property->_id_service = $id_service;
            $this->service_property->insert_where_code_many($property);
        }
        $authority_data['id_authority_status'] = 2;
        $this->authority->update($id_authority, $authority_data);
        redirect('structure/arm_iogv');
    }

    public function step3($id_authority) {
        $authority = $this->authority->get($id_authority);
        $data = $authority;
        $authority_property = $this->authority_property_model->get_many_by('id_authority', $id_authority);
        $organization = $this->organization_model->get($authority['id_organization']);
        $data['organization'] = $organization->organization_name;

        foreach ($authority_property as $value) {
            $property = $this->property->get($value['id_property']);
            $data[$property['code']] = $value['value'];
        }

        $services = $this->service->get_many_by('id_authority', $id_authority);
        foreach ($services as $service) {
            $properties = $this->service_property->get_many_by('id_service', $service['id_service']);
            $service_type = $this->service_type->get($service['id_service_type']);
            $data['services'][$service['id_service']]['type'] = $service_type->service_type_name;
            foreach ($properties as $value) {
                $property = $this->property->get($value['id_property']);
                $data['services'][$service['id_service']]['properties'][$property['property_name']] = $value['value'];
            }
        }
        $this->layout->view('step3', $data);
    }

    public function agree($id_authority, $agree) {
        if ($agree) {
            $authority_data['id_authority_status'] = 3;
            $url = 'structure/step4/' . $id_authority;
        } else {
            $authority_data['id_authority_status'] = 1;
            $url = 'structure/arm_kis';
        }
        $this->authority->update($id_authority, $authority_data);
        redirect($url);
    }

    public function step4($id_authority) {
        $authority = $this->authority->get($id_authority);
        $data = $authority;
        $authority_property = $this->authority_property_model->get_many_by('id_authority', $id_authority);
        $organization = $this->organization_model->get($authority['id_organization']);
        $data['organization'] = $organization->organization_name;
        foreach ($authority_property as $value) {
            $property = $this->property->get($value['id_property']);
            $data[$property['code']] = $value['value'];
        }
        $services = $this->service->get_many_by('id_authority', $id_authority);
        foreach ($services as $service) {
            $properties = $this->service_property->get_many_by('id_service', $service['id_service']);
            $service_type = $this->service_type->get($service['id_service_type']);
            $data['services'][$service['id_service']]['type'] = $service_type->service_type_name;
            foreach ($properties as $value) {
                $property = $this->property->get($value['id_property']);
                $data['services'][$service['id_service']]['properties'][$property['property_name']] = $value['value'];
            }
        }
        $this->layout->view('step4_1', $data);
    }

    public function step4_1($id_authority) {
        $authority = $this->authority->get($id_authority);
        $data = $authority;
        $authority_property = $this->authority_property_model->get_many_by('id_authority', $id_authority);
        $organization = $this->organization_model->get($authority['id_organization']);
        $data['organization'] = $organization->organization_name;

        foreach ($authority_property as $value) {
            $property = $this->property->get($value['id_property']);
            $data[$property['code']] = $value['value'];
        }

        $services = $this->service->get_many_by('id_authority', $id_authority);
        foreach ($services as $service) {
            $properties = $this->service_property->get_many_by('id_service', $service['id_service']);
            $service_type = $this->service_type->get($service['id_service_type']);
            $data['services'][$service['id_service']]['type'] = $service_type->service_type_name;
            foreach ($properties as $value) {
                $property = $this->property->get($value['id_property']);
                $data['services'][$service['id_service']]['properties'][$property['property_name']] = $value['value'];
            }
        }
        $this->layout->view('step4', $data);
    }
}