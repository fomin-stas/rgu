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
        //$this->reestr(0);
        $this->load->library('zend');
        $this->zend->load('Zend/Json');
        $this->zend->load('Zend/Json/Encoder');
        $this->zend->load('Zend/Json/Decoder');
        $this->zend->load('Zend/Json/Exception');
        $this->zend->load('Zend/Json/Expr');

        $grid_data = array();
        $column_names = array();
        $column_models = array();
        $properties = array();
        $authority_properties_codes = array();
        $authorities = $this->authority
                ->with('status')
                ->with('organization')
                ->with('properties')
                ->get_all();

        $properties = $this->property->with('format')->order_by('order')->get_all();
        //$properties = array_slice($properties, 0, 1);
        foreach ((array) $properties as $property) {
            $property['code'] = (isset($property['code'])) ? $property['code'] : $property['id_property'] . '_code';
            $column_names[] = $property['property_name'];
            $model['name'] = $property['code'];
            $model['index'] = $property['code'];
            switch ($property['format']['property_format_name']) {
                case 'system':
                    $model['editable'] = false;
                    $model['fixed'] = true;
                    $model['width'] = 220;
                    $model['stype'] = 'text';
                    break;
                case 'number':
                    $model['editable'] = false;
                    $model['fixed'] = true;
                    $model['width'] = 220;
                    $model['stype'] = 'text';
                    $model['edittype'] = 'text';
                    break;
                case 'date':
                    $model['editable'] = false;
                    $model['fixed'] = true;
                    $model['width'] = 250;
                    $model['sorttype'] = 'date';
                    $model['stype'] = 'text';
                    break;
                case 'textarea':
                    $model['editable'] = true;
                    $model['fixed'] = true;
                    $model['edittype'] = 'textarea';
                    $model['editoptions']['rows'] = 3;
                    $model['width'] = 270;
                    $model['stype'] = 'text';
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
            if (count($options) > 0) {
                foreach ($options as $key => $option) {
                    switch ($key) {
                        case 'property_align':
                            $model['align'] = $option;
                            break;
                        case 'property_width':
                            $model['width'] = $option;
                            break;
                        case 'property_color':
                            $model['color'] = $option;
                            break;
                    }
                }
            }
            $model['cellattr'] = new Zend_Json_Expr('Structure.cellFormat');
            /* switch ($property['code']) {
              case 'name_iogv':
              $model['formatter'] = new Zend_Json_Expr('App.linkToStep');
              $model['unformat'] = new Zend_Json_Expr('App.unLinkToStep');
              break;
              } */

            // linked to colmn model
            $column_models[] = $model;

            // add property to properties buffer
            $properties_buff[$property['id_property']] = $property;
            // create authority properties buffer
            if ($property['id_service_type'] == 6) {
                $authority_properties_codes[$property['code']] = $property;
            }
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
                        case 'исполняемое':
                            $executable_status = 'in_process';
                            break;
                        case 'общее':
                            $executable_status = 'in_working';
                            break;
                        case 'в разработке':
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
            $values_buff = array();
            $services = $this->service->get_many_by('id_authority', $authority['id_authority']);
            if (isset($services) AND count($services) > 0) {
                foreach ($services as $service) {
                    $service_properties = $this->service_property->get_many_by('id_service', $service['id_service']);
                    if (count($service_properties)) {
                        foreach ((array) $service_properties as $p) {
                            if (array_key_exists($p['id_property'], $properties_buff)) {
                                $values[$properties_buff[$p['id_property']]['code']] = $p['value'];
                            }
                        }
                    }
                    $values_buff[] = $values;
                }
            }

            // check many services
            $size = count($values_buff);
            if ($size > 1) {
                for ($i = 0; $i < $size; $i++) {
                    //for first row we are prepare collspan value
                    // prepare authorities keys to dispaly collspan grids
                    foreach ($values_buff[$i] as $key => $value) {
                        if (array_key_exists($key, $authority_properties_codes)) {
                            if ($i == 0) {
                                $values_buff[$i]['attr'][$key]['rowspan'] = $size;
                            } else {
                                $values_buff[$i]['attr'][$key]['display'] = 'none';
                            }
                        }
                    }

                    $grid_data[$executable_status][] = $values_buff[$i];
                    $grid_data['all'][] = $values_buff[$i];
                }
            } else {
                $grid_data[$executable_status][] = $values;
                $grid_data['all'][] = $values;
            }
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
        $data = array();
        $view = 'uvedoml_kis';
        $notifications = array();

        $user = $this->session->userdata('user_name');
        $notifications = $this->activity->order_by('time', 'DESC')->get_all();

        foreach ($notifications as $key => $notification) {
            $notifications[$key]['message'] = $this->activity->get_notification_message_by_event($notification['id_event_type']);
            $notifications[$key]['authority'] = $this->authority->get($notification['id_object']);
            $notifications[$key]['service'] = $this->service->get_by('id_authority', $notification['id_object']);
        }
        if ($user != 'kis') {
            $view = 'uvedoml_iogv';
        }

        $data['notifications'] = $notifications;
        $this->layout->view($view, $data);
    }

    public function journal() {
        $history_logs = $this->history_log->get_all();
        $logs_num = 0;
        foreach ($history_logs as $history_log) {
            $data['history_logs'][$logs_num]['new'] = $history_log['new'];
            $data['history_logs'][$logs_num]['old'] = $history_log['old'];
            $date_time = date_parse_from_format("Y.m.d H:i:s", $history_log['time']);
            $data['history_logs'][$logs_num]['time'] = $date_time['day'] . '/' . $date_time['month'] . '/' . $date_time['year'] . ' ' . $date_time['hour'] . ':' . $date_time['minute'] . ':' . $date_time['second'];
            $property = $this->property->get($history_log['id_property']);
            $data['history_logs'][$logs_num]['property_name'] = $property['property_name'];
            $data['history_logs'][$logs_num]['id_property'] = $history_log['id_property'];
            $user = $this->user->get($history_log['id_user']);
            $data['history_logs'][$logs_num]['user_name'] = $user->user_name;
            $logs_num++;
        }
        $this->layout->view('journal', $data);
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
        $property['executable_status'] = 'в разработке';
        $authority['id_organization'] = $this->input->post('select_org');
        $authority['id_authority_status'] = 1;
        $this->load->model('authority');
        $id_authority = $this->authority->insert($authority);
        // add notification
        if ($id_authority) {
            $this->activity->add_notification('new_authority', 6, $authority['id_organization'], $id_authority);
        }
        $property['authority_name'] = '<a href=structure/check_status_authority/' . $id_authority . '>' . $authority['authority_name'] . '</a>';
        $property['authority_id'] = '<a href=structure/check_status_authority/' . $id_authority . '>' . $this->input->post('select_org') . ' ' . $this->input->post('punkt_iogv') . '-' . rand(1, 99) . '</a>';
        $this->authority_property_model->_id_authority = $id_authority;
        $this->authority_property_model->insert_where_code_many($property);
        $this->comment->insert_comment($id_authority, $this->input->post('comment_st1'));
        $this->file_insert($id_authority);
        redirect('structure/arm_kis');
    }

    public function step2($id_authority) {
        $this->check_status_authority($id_authority, 2);
        $authority = $this->authority->get($id_authority);
        $data = $authority;
        $authority_property = $this->authority_property_model->get_many_by('id_authority', $id_authority);
        $organization = $this->organization_model->get($authority['id_organization']);
        $data['organization'] = $organization['organization_name'];
        $data['spher'] = $this->spher->dropdown('name', 'name');
        $data['organization_provide_service'] = "[";
        foreach($this->organization_model->get_all() as $value){
            $data['organization_provide_service'] .= "'".$value['organization_name']."',";
        }
        $data['organization_provide_service'] = substr($data['organization_provide_service'], 0, -1).']';
        $files = $this->file->get_many_by('id_authority', $id_authority);
        foreach ($files as $value) {
            $data['files'][] = array('file_name' => $value['file_name'], 'name' => $value['name']);
        }
        foreach ($authority_property as $value) {
            $property = $this->property->get($value['id_property']);
            $data[$property['code']] = $value['value'];
        }
        $data['comments'] = $this->view_only_timeline($id_authority);
        $this->layout->view('razgran_p', $data);
    }

    public function step2_edit($id_authority) {
        $this->check_status_authority($id_authority, 2);
        $authority = $this->authority->get($id_authority);
        $data = $authority;
        $authority_property = $this->authority_property_model->get_many_by('id_authority', $id_authority);
        $organization = $this->organization_model->get($authority['id_organization']);
        $data['organization'] = $organization->organization_name;
        $data['spher'] = $this->spher->dropdown('name', 'name');
        $data['organization_provide_service'] = $this->organization_model->dropdown('organization_name', 'organization_name');
        $files = $this->file->get_many_by('id_authority', $id_authority);
        foreach ($files as $value) {
            $data['files'][] = array('file_name' => $value['file_name'], 'name' => $value['name']);
        }
        foreach ($authority_property as $value) {
            $property = $this->property->get($value['id_property']);
            $data[$property['code']] = $value['value'];
        }
        $data['comments'] = $this->view_only_timeline($id_authority);
        $this->layout->view('razgran_p', $data);
    }

    //всю эту хренотень с шагами - в отдельный класс
    public function step2_submit() {
        $data = $_POST;
        $id_authority = $data['id_authority'];
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
        $update = $this->authority->update($id_authority, $authority_data);
        if ($update) {
            $authority = $this->authority->get($id_authority);
            $this->activity->add_notification('authority_changed', 6, $authority['id_organization'], $id_authority);
        }
        $this->comment->insert_comment($id_authority, $this->input->post('comment_st2'));
        redirect('structure/arm_iogv');
    }

    public function step3($id_authority) {
       // $this->check_status_authority($id_authority, 3);
        $authority = $this->authority->get($id_authority);
        $data = $authority;
        $authority_property = $this->authority_property_model->get_many_by('id_authority', $id_authority);
        $organization = $this->organization_model->get($authority['id_organization']);
        $data['organization'] = $organization->organization_name;
        $files = $this->file->get_many_by('id_authority', $id_authority);
        foreach ($files as $value) {
            $data['files'][] = array('file_name' => $value['file_name'], 'name' => $value['name']);
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
                $data['services'][$service['id_service']]['properties'][$property['id_property']] = array('property_name' => $property['property_name'], 'value' => $value['value']);
            }
        }
        $data['comments'] = $this->view_only_timeline($id_authority);
        $this->layout->view('step3', $data);
    }

    public function agree($id_authority, $agree) {
        if ($agree == 'true') {
            $authority_data['id_authority_status'] = 3;
            $url = 'structure/step4/' . $id_authority;
            $this->comment->insert_comment($id_authority, $this->input->post('comment_st3_agree'));
            $property['executable_status'] = 'в разработке';
            $this->authority_property_model->_id_authority = $id_authority;
            $this->authority_property_model->insert_where_code_many($property);
        } else {
            $data = $_POST;
            //$this->service_property->update_by(array('id_service'));
            foreach ($data as $key => $value) {
                $name = explode("_", $key);
                if ($name[0] == 'ch' && $value == 'on') {
                    $update_data=array('id_service' => $name[1],'id_property' => $name[2]);
                     $update=       array('agreed' => 0);
                    $this->service_property->update_by($update_data,$update);
                }
            }
        
        $authority_data['id_authority_status'] = 4;
        $url = 'structure/arm_kis';
        $this->comment->insert_comment($id_authority, $this->input->post('comment_st3_disagree'));
        }
        $this->authority->update($id_authority, $authority_data);
        $this->comment->insert_comment($id_authority, $this->input->post('comment_st3_agree'));
        redirect($url);
    }

    public function step4($id_authority) {
        $this->check_status_authority($id_authority, 4);
        $authority = $this->authority->get($id_authority);
        $data = $authority;
        $authority_property = $this->authority_property_model->get_many_by('id_authority', $id_authority);
        $organization = $this->organization_model->get($authority['id_organization']);
        $data['organization'] = $organization->organization_name;
        $files = $this->file->get_many_by('id_authority', $id_authority);
        foreach ($files as $value) {
            $data['files'][] = array('file_name' => $value['file_name'], 'name' => $value['name']);
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
        $data['comments'] = $this->view_only_timeline($id_authority);
        $this->layout->view('step4_1', $data);
    }

    public function step4_1($id_authority) {
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
        $files = $this->file->get_many_by('id_authority', $id_authority);
        foreach ($files as $value) {
            $data['files'][] = array('file_name' => $value['file_name'], 'name' => $value['name']);
        }
        $services = $this->service->get_many_by('id_authority', $id_authority);
        foreach ($services as $service) {
            $properties = $this->service_property->get_many_by('id_service', $service['id_service']);
            $service_type = $this->service_type->get($service['id_service_type']);
            $data['services'][$service['id_service']]['type'] = $service_type->service_type_name;
            foreach ($properties as $value) {
                $property = $this->property->get($value['id_property']);
                $data['services'][$service['id_service']]['properties'][$property['code']] =array('value'=> $value['value'],'agreed'=>$value['agreed']);
            }
        }
        $data['comments'] = $this->view_only_timeline($id_authority);
        $this->layout->view('step4', $data);
    }

    public function check_status_authority($id_authority, $step_num = 0) {
        $authority = $this->authority->get($id_authority);
        switch ($authority['id_authority_status']) {
            case 1:
                if ($step_num != 2)
                    redirect('structure/step2/' . $id_authority);
                break;
            case 2:
                if ($step_num != 3)
                    redirect('structure/step3/' . $id_authority);

                break;
            case 3:
                if ($step_num != 4)
                    redirect('structure/step4/' . $id_authority);

                break;

            case 4:
                if ($step_num != 4)
                    redirect('structure/step4_1/' . $id_authority);

                break;
        }
    }
    
    private function reestr($user_type=-1){
        $user_t=$this->session->userdata('user_type');
        if (($user_type == -1) || ($user_type != $this->session->userdata('user_type'))){
        switch ($this->session->userdata('user_type')) {
                    case 1:
                        redirect('/structure/arm_kis');
                        break;
                        default :
                        redirect('/structure/arm_iogv/');
                        break;
                }
        }else{
            return;
        }
    }

    private function file_insert($id_authority) {
        $config['upload_path'] = 'file_storage/authority';
        $config['allowed_types'] = 'gif|jpg|png|doc|docx|zip|rar|xls|xlsx|ppt|pptx|pdf';
        $config['max_size'] = '0';
        $config['max_width'] = '0';
        $config['max_height'] = '0';
        //$config['encrypt_name'] = true;
        $this->load->library('upload', $config);
        if (!$this->upload->do_upload('step_file')) {
            $error = array('error' => $this->upload->display_errors());
        } else {
            $data = array('upload_data' => $this->upload->data());
            $upload_file['name'] = $data['upload_data']['client_name'];
            $upload_file['file_name'] = $data['upload_data']['file_name'];
            $upload_file['id_authority'] = $id_authority;
            $this->file->insert($upload_file);
        }
    }

    public function view_only_timeline($id_authority) {
        $this->comment->order_by('time', 'DESC');
        $comments = $this->comment->get_many_by('id_authority', $id_authority);
        foreach ($comments as $value) {
            $user = $this->user->get($value['id_user']);
            $date_time = date_parse_from_format("Y.m.d H:i:s", $value['time']);
            $comments_data[$date_time['day'] . '-' . $date_time['month'] . '-' . $date_time['year']] [] = array('time' => $date_time['hour'] . ':' . $date_time['minute'] . ':' . $date_time['second'],
                'message' => $value['message'],
                'user_name' => $user->user_name);
        }
        if (isset($comments_data)) {
            $data['comments_data'] = $comments_data;
            return $this->load->view('comments/timeline_only', $data, true);
        } else {
            return 'Комментариев нет';
        }
    }

    public function arm_iogv() {
        // load libs
        //$this->reestr(2);
        $this->load->library('zend');
        $this->zend->load('Zend/Json');
        $this->zend->load('Zend/Json/Encoder');
        $this->zend->load('Zend/Json/Decoder');
        $this->zend->load('Zend/Json/Exception');
        $this->zend->load('Zend/Json/Expr');
        $id_organization=$this->session->userdata('id_organization');
        $grid_data = array();
        $column_names = array();
        $column_models = array();
        
        $authorities = $this->authority
                ->with('status')
                ->with('organization')
                ->with('properties')
                ->get_many_by(array('id_organization'=>$id_organization));

        $properties = $this->property->with('format')->order_by('order')->get_all();
        //$properties = array_slice($properties, 0, 1);
        foreach ((array) $properties as $property) {
            $property['code'] = (isset($property['code'])) ? $property['code'] : $property['id_property'] . '_code';
            $column_names[] = $property['property_name'];
            $model['name'] = $property['code'];
            $model['index'] = $property['code'];
            switch ($property['format']['property_format_name']) {
                case 'system':
                    $model['editable'] = false;
                    $model['fixed'] = true;
                    $model['width'] = 220;
                    $model['stype'] = 'text';
                    break;
                case 'number':
                    $model['editable'] = false;
                    $model['fixed'] = true;
                    $model['width'] = 220;
                    $model['stype'] = 'text';
                    $model['edittype'] = 'text';
                    break;
                case 'date':
                    $model['editable'] = false;
                    $model['fixed'] = true;
                    $model['width'] = 250;
                    $model['sorttype'] = 'date';
                    $model['stype'] = 'text';
                    break;
                case 'textarea':
                    $model['editable'] = true;
                    $model['fixed'] = true;
                    $model['edittype'] = 'textarea';
                    $model['editoptions']['rows'] = 3;
                    $model['width'] = 270;
                    $model['stype'] = 'text';
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
            if (count($options) > 0) {
                foreach ($options as $key => $option) {
                    switch ($key) {
                        case 'property_align':
                            $model['align'] = $option;
                            break;
                        case 'property_width':
                            $model['width'] = $option;
                            break;
                        case 'property_color':
                            $model['color'] = $option;
                            break;
                    }
                }
            }
            $model['cellattr'] = new Zend_Json_Expr('Structure.cellFormat');
            /* switch ($property['code']) {
              case 'name_iogv':
              $model['formatter'] = new Zend_Json_Expr('App.linkToStep');
              $model['unformat'] = new Zend_Json_Expr('App.unLinkToStep');
              break;
              } */

            // linked to colmn model
            $column_models[] = $model;

            // add property to properties buffer
            $properties_buff[$property['id_property']] = $property;
            // create authority properties buffer
            if ($property['id_service_type'] == 6) {
                $authority_properties_codes[$property['code']] = $property;
            }
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
                        case 'исполняемое':
                            $executable_status = 'in_process';
                            break;
                        case 'общее':
                            $executable_status = 'in_working';
                            break;
                        case 'в разработке':
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
            $values_buff = array();
            $services = $this->service->get_many_by('id_authority', $authority['id_authority']);
            if (isset($services) AND count($services) > 0) {
                foreach ($services as $service) {
                    $service_properties = $this->service_property->get_many_by('id_service', $service['id_service']);
                    if (count($service_properties)) {
                        foreach ((array) $service_properties as $p) {
                            if (array_key_exists($p['id_property'], $properties_buff)) {
                                $values[$properties_buff[$p['id_property']]['code']] = $p['value'];
                            }
                        }
                    }
                    $values_buff[] = $values;
                }
            }

            // check many services
            $size = count($values_buff);
            if ($size > 1) {
                for ($i = 0; $i < $size; $i++) {
                    //for first row we are prepare collspan value
                    // prepare authorities keys to dispaly collspan grids
                    foreach ($values_buff[$i] as $key => $value) {
                        if (array_key_exists($key, $authority_properties_codes)) {
                            if ($i == 0) {
                                $values_buff[$i]['attr'][$key]['rowspan'] = $size;
                            } else {
                                $values_buff[$i]['attr'][$key]['display'] = 'none';
                            }
                        }
                    }

                    $grid_data[$executable_status][] = $values_buff[$i];
                    $grid_data['all'][] = $values_buff[$i];
                }
            } else {
                $grid_data[$executable_status][] = $values;
                $grid_data['all'][] = $values;
            }
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

    /**
     * Search Revisions
     * @param string $search_value The value to search for, ie a specific 'Taylor'
     * @param string $key_to_search The associative key to find it in, ie first_name
     * @param string $other_matching_key The associative key to find in the matches for employed
     * @param string $other_matching_value The value to find in that matching associative key, ie true
     * 
     * @return array keys, ie all the people with the first name 'Taylor' that are employed.
     */
    private function _search_revisions($search_value, $key_to_search, $other_matching_value = null, $other_matching_key = null) {
        // This function will search the revisions for a certain value
        // related to the associative key you are looking for.
        $keys = array();
        foreach ($this->revisions as $key => $cur_value) {
            if ($cur_value[$key_to_search] === $search_value) {
                if (isset($other_matching_key) && isset($other_matching_value)) {
                    if ($cur_value[$other_matching_key] === $other_matching_value) {
                        $keys[] = $key;
                    }
                } else {
                    // I must keep in mind that some searches may have multiple
                    // matches and others would not, so leave it open with no continues.
                    $keys[] = $key;
                }
            }
        }
        return $keys;
    }

}
