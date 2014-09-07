<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Structure extends APP_Controller {

    function __construct() {
        parent::__construct();

        $this->is_loggedIn();
    }

    public function index() {
        redirect('login');
    }

    public function arm_kis() {
        // load libs
        $this->load->library('zend');
        $this->zend->load('Zend/Json');
        $this->zend->load('Zend/Json/Encoder');
        $this->zend->load('Zend/Json/Decoder');
        $this->zend->load('Zend/Json/Exception');
        $this->zend->load('Zend/Json/Expr');

        $grid_data = array();
        $column_names = array();
        $column_models = array();
        $authorities = $this->authority
                ->with('status')
                ->with('organization')
                ->with('properties') 
                ->get_all();

        $properties = $this->property->with('format')->get_all();

        //$properties = array_slice($properties, 0, 1);
        foreach ((array) $properties as $property) {
            $property['code'] = $property['id_property'].'_code';
            $column_names[] = $property['property_name'];
            $model['name'] = $property['code'];
            $model['index'] = $property['code'];
            switch ($property['format']['property_format_name']) {
                case 'system':
                    $model['editable'] = false;
                    $model['fixed'] = true;
                    $model['width'] = 220;
                    break;
                case 'number':
                    $model['editable'] = false;
                    $model['fixed'] = true;
                    $model['width'] = 220;
                    break;
                case 'date':
                    $model['editable'] = false;
                    $model['fixed'] = true;
                    $model['width'] = 250;
                    $model['sorttype'] = 'date';
                    break;
                case 'textarea':
                    $model['editable'] = true;
                    $model['fixed'] = true;
                    $model['edittype'] = 'textarea';
                    $model['editoptions']['rows'] = 3;
                    $model['width'] = 270;
                    break;
                case 'select':
                    $model['editable'] = false;
                    $model['fixed'] = true;
                    $model['stype'] = 'select';
                    $model['edittype'] = 'select';
                    //$model['editoptions'] = [];
                    $model['width'] = 270;
                    break;
                case 'multiselect':
                    $model['editable'] = false;
                    $model['fixed'] = true;
                    $model['stype'] = 'select';
                    $model['edittype'] = 'select';
                    //$model['editoptions'] = [];
                    $model['width'] = 270;
                    break;
            }
            $options = json_decode($property['options'], true);
            if(count($options) > 0) {
                switch ($options) {
                    case 'property_align':
                        $model['align'] = $options['property_align'];
                        break;
                    case 'property_width':
                        $model['width'] = $options['property_width'];
                        break;
                }
            }
            /*switch ($property['code']) {
                case 'name_iogv':
                    $model['formatter'] = new Zend_Json_Expr('App.linkToStep');
                    $model['unformat'] = new Zend_Json_Expr('App.unLinkToStep');
                    break;
            }*/

            // linked to colmn model
            $column_models[] = $model;

            // add property to properties buffer
            $properties_buff[$property['id_property']] = $property;
        }
        // prepare json grid
        foreach ((array) $authorities as $authority) {
            $values = array();

            // create row values
            foreach ($column_models as $model) {
                $values[$model['name']] = '';
            }

            // add athority properties to grid
            foreach ((array) $authority['properties'] as $p) {
                if (array_key_exists($p['id_property'], $properties_buff)) {
                    $values[$properties_buff[$p['id_property']]['code']] = $p['value'];
                }
                $values['id_authority'] = $authority['id_authority'];
                $values['id_authority_status'] = $authority['id_authority_status'];

                // HACK: Executable status 
                $executable_status = 'new_authorities';
                if ($p['id_property'] == 8) {
                    switch (mb_convert_case($p['value'], MB_CASE_LOWER, "UTF-8")) {
                        case 'исполняемая':
                            $executable_status = 'in_process';
                            break;
                        case 'общее':
                            $executable_status = 'in_working';
                            break;
                        default:
                            $executable_status = 'new_authorities';
                            break;
                    }
                }
            }
            //add service properties to grid
            $this->load->model('service');
            $this->load->model('service_property');
            $service = $this->service->get_by('id_authority', $authority['id_authority']);
            if (isset($service) AND ! empty($service)) {
                $service_properties = $this->service_property->get_many_by('id_service', $service['id_service']);
                if (count($service_properties)) {
                    foreach ((array) $service_properties as $p) {
                        if (array_key_exists($p['id_property'], $properties_buff)) {
                            $values[$properties_buff[$p['id_property']]['code']] = $p['value'];
                        }
                    }
                }
            }

            $grid_data[$executable_status][] = $values;
            $grid_data['all'][] = $values;
        }
        $grid_data['all'][] = array();
        $grid_data['in_process'][] = array();
        $grid_data['in_working'][] = array();
        $grid_data['new_authorities'][] = array();
        $this->layout->view('arm_kis', array(
            'grid_data' => $grid_data,
            //'column_models' => json_encode($column_models),
            'column_models' => Zend_Json::encode($column_models, false, array('enableJsonExprFinder' => true)),
            'column_names' => json_encode($column_names),
            )
        );
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
        $db = $this->organization_model->dropdown('organization_name');
        $db_iogv = $this->organization_model->dropdown('organization_name', 'organization_name');
        $data['db'] = $db;
        $data['db_iogv'] = $db_iogv;
        $this->layout->view('polnomoch', $data);
    }

    public function step1_submit() {
        $authority['authority_name'] = $this->input->post('authority_name');
        
        $property['punkt_iogv'] = $this->input->post('punkt_iogv');
        $property['name_iogv'] = $this->input->post('name_iogv');
        $property['rekvisit_npa'] = $this->input->post('rekvisit_npa');
        $property['project_post'] = $this->input->post('project_post');
        $property['srok_otveta'] = $this->input->post('srok_otveta');
        $property['executable_status'] = 'исполняемое';
        $authority['id_organization'] = $this->input->post('select_org');
        $authority['id_authority_status'] = 1;
        $this->load->model('authority');
        $id_authority = $this->authority->insert($authority);
        $property['authority_name'] = '<a href=structure/check_status_authority/'.$id_authority.'>'.$authority['authority_name'].'</a>';
        $this->authority_property_model->_id_authority = $id_authority;
        $this->authority_property_model->insert_where_code_many($property);
        
        $this->comment->insert_comment($id_authority, $this->input->post('comment_st1'));
        $this->file_insert($id_authority);
        
        redirect('structure/arm_kis');
    }

    public function step2($id_authority) {
        $this->check_status_authority($id_authority,2);
        $authority = $this->authority->get($id_authority);
        $data = $authority;
        $authority_property = $this->authority_property_model->get_many_by('id_authority', $id_authority);
        $organization = $this->organization_model->get($authority['id_organization']);
        $data['organization'] = $organization->organization_name;
        $data['spher'] = $this->spher->dropdown('name', 'name');
        $data['organization_provide_service'] = $this->organization_model->dropdown('organization_name', 'organization_name');
        $files = $this->file->get_many_by('id_authority', $id_authority);
        foreach ($files as $value) {
            $data['files'][]=array('file_name'=>$value['file_name'],'name'=>$value['name']);
        }
            
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
        $this->comment->insert_comment($id_authority, $this->input->post('comment_st2'));
        redirect('structure/arm_iogv');
    }

    public function step3($id_authority) {
        $this->check_status_authority($id_authority,3);
        $authority = $this->authority->get($id_authority);
        $data = $authority;
        $authority_property = $this->authority_property_model->get_many_by('id_authority', $id_authority);
        $organization = $this->organization_model->get($authority['id_organization']);
        $data['organization'] = $organization->organization_name;
        $files = $this->file->get_many_by('id_authority', $id_authority);
        foreach ($files as $value) {
            $data['files'][]=array('file_name'=>$value['file_name'],'name'=>$value['name']);
        }
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
        $this->check_status_authority($id_authority,4);
        $authority = $this->authority->get($id_authority);
        $data = $authority;
        $authority_property = $this->authority_property_model->get_many_by('id_authority', $id_authority);
        $organization = $this->organization_model->get($authority['id_organization']);
        $data['organization'] = $organization->organization_name;
        $files = $this->file->get_many_by('id_authority', $id_authority);
        foreach ($files as $value) {
            $data['files'][]=array('file_name'=>$value['file_name'],'name'=>$value['name']);
        }
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
        $files = $this->file->get_many_by('id_authority', $id_authority);
        foreach ($files as $value) {
            $data['files'][]=array('file_name'=>$value['file_name'],'name'=>$value['name']);
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
    
    public function check_status_authority($id_authority,$step_num=0){
        $authority=$this->authority->get($id_authority);
        switch ($authority['id_authority_status']) {
            case 1:
                if ($step_num!=2) redirect('structure/step2/'.$id_authority);
                break;
            case 2:
                if ($step_num!=3) redirect('structure/step3/'.$id_authority);

                break;
            case 3:
                if ($step_num!=4) redirect('structure/step4/'.$id_authority);

                break;
        }
    }
    
    private function file_insert($id_authority){
        $config['upload_path'] = 'file_storage/authority';
        $config['allowed_types'] = 'gif|jpg|png|doc|docx|zip|rar|xls|xlsx|ppt|pptx';
        $config['max_size'] = '0';
        $config['max_width'] = '0';
        $config['max_height'] = '0';
        $this->load->library('upload', $config);
        if (!$this->upload->do_upload('step_file')) {
            $error = array('error' => $this->upload->display_errors());
        } else {
            $data = array('upload_data' => $this->upload->data());
            $upload_file['name']=$data['upload_data']['client_name'];
            $upload_file['file_name']=$data['upload_data']['file_name'];
            $upload_file['id_authority']=$id_authority;
            $this->file->insert($upload_file);
        }
    }

    public function arm_iogv(){
        // load libs
        $this->load->library('zend');
        $this->zend->load('Zend/Json');
        $this->zend->load('Zend/Json/Encoder');
        $this->zend->load('Zend/Json/Decoder');
        $this->zend->load('Zend/Json/Exception');
        $this->zend->load('Zend/Json/Expr');

        $grid_data = array();
        $column_names = array();
        $column_models = array();

        $authorities = $this->authority
                ->with('status')
                ->with('organization')
                ->with('properties')
                ->get_all();

        $properties = $this->property->with('format')->get_all();

        //$properties = array_slice($properties, 0, 1);

        foreach ((array) $properties as $property) {
            $property['code'] = $property['id_property'].'_code';
            $column_names[] = $property['property_name'];
            $model['name'] = $property['code'];
            $model['index'] = $property['code'];
            switch ($property['format']['property_format_name']) {
                case 'system':
                    $model['editable'] = false;
                    $model['fixed'] = true;
                    $model['width'] = 200;
                    break;
                case 'number':
                    $model['editable'] = false;
                    $model['fixed'] = true;
                    $model['width'] = 200;
                    break;
                case 'date':
                    $model['editable'] = false;
                    $model['fixed'] = true;
                    $model['width'] = 220;
                    $model['sorttype'] = 'date';
                    break;
                case 'textarea':
                    $model['editable'] = true;
                    $model['fixed'] = true;
                    $model['edittype'] = 'textarea';
                    $model['editoptions']['rows'] = 3;
                    $model['width'] = 250;
                    break;
                case 'select':
                    $model['editable'] = false;
                    $model['fixed'] = true;
                    $model['stype'] = 'select';
                    $model['edittype'] = 'select';
                    //$model['editoptions'] = [];
                    $model['width'] = 250;
                    break;
                case 'multiselect':
                    $model['editable'] = false;
                    $model['fixed'] = true;
                    $model['stype'] = 'select';
                    $model['edittype'] = 'select';
                    //$model['editoptions'] = [];
                    $model['width'] = 250;
                    break;
            }

            switch ($property['code']) {
                case 'name_iogv':
                    $model['formatter'] = new Zend_Json_Expr('App.linkToStep');
                    $model['unformat'] = new Zend_Json_Expr('App.unLinkToStep');
                    break;
            }

            // linked to colmn model
            $column_models[] = $model;

            // add property to properties buffer
            $properties_buff[$property['id_property']] = $property;
        }
        // prepare json grid
        foreach ((array) $authorities as $authority) {
            $values = array();

            // create row values
            foreach ($column_models as $model) {
                $values[$model['name']] = '';
            }

            // add athority properties to grid
            foreach ((array) $authority['properties'] as $p) {
                if (array_key_exists($p['id_property'], $properties_buff)) {
                    $values[$properties_buff[$p['id_property']]['code']] = $p['value'];
                }
                $values['id_authority'] = $authority['id_authority'];
                $values['id_authority_status'] = $authority['id_authority_status'];

                // HACK: Executable status 
                if ($p['id_property'] == 8) {
                    switch (mb_convert_case($p['value'], MB_CASE_LOWER, "UTF-8")) {
                        case 'исполняемая':
                            $executable_status = 'in_process';
                            break;
                        case 'исполняемое':
                            $executable_status = 'in_process';
                            break;
                        case 'общее':
                            $executable_status = 'in_working';
                            break;
                        default:
                            $executable_status = 'new_authorities';
                            break;
                    }
                }
            }
            //add service properties to grid
            $this->load->model('service');
            $this->load->model('service_property');
            $service = $this->service->get_by('id_authority', $authority['id_authority']);
            if (isset($service) AND ! empty($service)) {
                $service_properties = $this->service_property->get_many_by('id_service', $service['id_service']);
                if (count($service_properties)) {
                    foreach ((array) $service_properties as $p) {
                        if (array_key_exists($p['id_property'], $properties_buff)) {
                            $values[$properties_buff[$p['id_property']]['code']] = $p['value'];
                        }
                    }
                }
            }

            $grid_data[$executable_status][] = $values;
            $grid_data['all'][] = $values;
        }
        $grid_data['all'][] = array();
        $grid_data['in_process'][] = array();
        $grid_data['in_working'][] = array();
        $grid_data['new_authorities'][] = array();
        $this->layout->view('arm_iogv', array(
            'grid_data' => $grid_data,
            //'column_models' => json_encode($column_models),
            'column_models' => Zend_Json::encode($column_models, false, array('enableJsonExprFinder' => true)),
            'column_names' => json_encode($column_names),
                )
        );
    }

}
