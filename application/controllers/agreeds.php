<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Agreeds extends APP_Controller {

    public $notifications_size = 0;

    function __construct() {
        parent::__construct();
        $this->is_loggedIn();
        $user_id = $this->session->userdata('id');
        $user_info = $this->user->get($user_id);
        $this->notifications_size = $this->activity->count_by(array('id_organization' => $user_info['id_organization'], 'status' => 1));
    }

    public function index() {
        redirect('login');
    }

    public function step1() {
        $db = $this->organization_model->dropdown_ROIV('organization_name');
        $db_iogv = $this->organization_model
                ->order_by('organization_name')
                ->dropdown('organization_name', 'organization_name');
        $data['db'] = $db;
        $data['db_iogv'] = $db_iogv;
        $this->layout->view('polnomoch', $data);
    }

    public function step1_submit() {
        if ($this->input->post('authority_name') != false) {
            $authority['authority_name'] = $this->input->post('authority_name');
        } else {
            show_error('Не введено наименование полномочия!');
            return;
        }
        if ($this->input->post('punkt_iogv') != false) {
            $property['punkt_iogv'] = $this->input->post('punkt_iogv');
        } else {
            show_error('Не введен номер пункта в положении об ИОГВ!');
            return;
        }
        if ($this->input->post('name_iogv') != false) {
            $organization = $this->organization_model->get($this->input->post('name_iogv'));
        } else {
            show_error('Не выбрана организация!');
            return;
        }
        $property['name_iogv'] = $organization['organization_name'];
        $property["information_system_roiv"] = $this->input->post("information_system_roiv") ? $this->input->post('information_system_roiv') : '';
        $property['project_post'] = $this->input->post('project_post') ? $this->input->post('project_post') : '';
        $property['srok_otveta'] = $this->input->post('srok_otveta') ? $this->input->post('srok_otveta') : '';
        $property['executable_status'] = 'в разработке';
        $property['service_subject'] = $this->input->post('service_subject') ? $this->input->post('service_subject') : '';
        $authority['id_organization'] = $this->input->post('name_iogv');
        $authority['id_authority_status'] = 1;
        $authority['is_new'] = 'true';
        $id_authority = $this->authority->insert($authority);
// add notification
        if ($id_authority) {
            $this->activity->add_notification('new_authority', 6, $authority['id_organization'], $id_authority);
        }
        $property['authority_name'] = '<a href=agreeds/check_status_authority/' . $id_authority . '>' . $authority['authority_name'] . '</a>';
        $property['authority_id'] = '<a href=agreeds/check_status_authority/' . $id_authority . '>' . $this->input->post('select_org') . ' ' . $this->input->post('punkt_iogv') . '-' . rand(1, 99) . '</a>';
        $this->authority_property_model->_id_authority = $id_authority;
        $this->authority_property_model->insert_where_code_many($property);
        if ($this->input->post('comment_st1')) {
            $this->comment->insert_comment($id_authority, $this->input->post('comment_st1'));
        }
        $this->step_files_insert($id_authority);
        $this->authority->set_is_new($id_authority);
        redirect('structure/arm_kis');
    }

    public function step2($id_authority) {
        $this->check_status_authority($id_authority, 2);
        $this->authority->rest_is_new($id_authority);
        $authority = $this->authority->get($id_authority);
        $data = $authority;
        $authority_property = $this->authority_property_model->get_many_by('id_authority', $id_authority);
        $organization = $this->organization_model->get($authority['id_organization']);
        $data['organization'] = $organization['organization_name'];
        $data['spher'] = $this->spher->dropdown('name', 'name');
        $data['organization_provide_service_dropdown'] = $this->organization_model->dropdown('organization_name', 'organization_name');
        $data['organization_provide_service'] = "[";
        foreach ($this->organization_model->get_all() as $value) {
            $data['organization_provide_service'] .= "'" . $value['organization_name'] . "',";
        }
        $data['organization_provide_service'] = substr($data['organization_provide_service'], 0, -1) . ']';
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

    public function step2_submit($update = false) {
        $this->load->model('submit_property');
        $submit = new $this->submit_property;
        $submit->insert_new_services();
        $id_authority = $submit->get_id_authority();

        $authority_data['id_authority_status'] = 2;
        $update = $this->authority->update($id_authority, $authority_data);
        if ($update) {
            $authority = $this->authority->get($id_authority);
            $this->activity->add_notification('authority_changed', 6, $authority['id_organization'], $id_authority);
        }
        if ($this->input->post('comment_st2')) {
            $this->comment->insert_comment($id_authority, $this->input->post('comment_st2'));
        }
        $this->authority->set_is_new($id_authority);
        $update_authority['value'] = 'на согласовании';
        $property = $this->property->get_by(array('code' => 'executable_status'));
        $update_data = array('id_authority' => $id_authority, 'id_property' => $property['id_property']);
        $this->authority_property_model->update_by($update_data, $update_authority);
        redirect('structure/arm_iogv');
    }

    public function step3($id_authority) {
        $this->check_status_authority($id_authority, 3);
        $this->authority->rest_is_new($id_authority);
        $authority = $this->authority->get($id_authority);
        $data = $authority;
        $authority_property = $this->authority_property_model->get_many_by('id_authority', $id_authority);
        $organization = $this->organization_model->get($authority['id_organization']);
        $data['organization'] = $organization['organization_name'];
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
            $properties = $this->service_property->order_by('id_service_property')->get_many_by('id_service', $service['id_service']);
            $service_type = $this->service_type->get($service['id_service_type']);
            $data['services'][$service['id_service']]['type'] = $service_type->service_type_name;
            foreach ($properties as $value) {
                $property = $this->property->get($value['id_property']);
                $kis=explode("_", $property['code']);
                if($kis[0] == 'kis'){
                    continue;
                }
                if (($property['id_service_type'] == NULL) || (is_null($property['id_service_type'] == NULL)))
                    continue;
                $data['services'][$service['id_service']]['properties'][$property['id_property']] = array('property_name' => $property['property_name'], 'value' => $value['value'], 'agreed' => $value['agreed']);
            }
        }
        $data['comments'] = $this->view_only_timeline($id_authority);
        $this->layout->view('step3', $data);
    }

    public function in_work($id_authority) {
        $this->step_files_insert($id_authority);
        $data = $_POST;
        $agreeded = 0;
        $count_properties = 0;
        foreach ($data as $key => $value) {
            $name = explode("_", $key);
            if (!(int) $name[0]) {
                continue;
            }
            $update_data = array('id_service' => $name[0], 'id_property' => $name[1]);
            $update = array('agreed' => $value);
            $this->service_property->update_by($update_data, $update);
            if ($value != 1) {
                $agreeded = $agreeded + 1;
            }
            $count_properties = $count_properties + 1;
        }
        if (($agreeded > 0) || ($count_properties == 0)) {
            $update_authority['value'] = 'отправленно на доработку';
        } else {
            $update_authority['value'] = 'согласовано';
        }
        //$this->authority->update($id_authority, $authority_data);
        if ($this->input->post('comment_st3_disagree')) {
            $this->comment->insert_comment($id_authority, $this->input->post('comment_st3_disagree'));
        }
        $property = $this->property->get_by(array('code' => 'executable_status'));
        $update_data = array('id_authority' => $id_authority, 'id_property' => $property['id_property']);
        $update = $this->authority_property_model->update_by($update_data, $update_authority);
        if ($update) {
            $authority = $this->authority->get($id_authority);
            $this->activity->add_notification('authority_changed', 6, $authority['id_organization'], $id_authority);
        }
        $url = 'structure/arm_kis';
        $this->authority->set_is_new($id_authority);
        redirect($url);
    }

    public function step4($id_authority) {
        $this->check_status_authority($id_authority, 4);
        $this->authority->rest_is_new($id_authority);
        $authority = $this->authority->get($id_authority);
        $data = $authority;
        $authority_property = $this->authority_property_model->get_many_by('id_authority', $id_authority);
        $organization = $this->organization_model->get($authority['id_organization']);
        $data['organization'] = $organization['organization_name'];
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
            $properties = $this->service_property->order_by('id_service_property')->get_many_by('id_service', $service['id_service']);
            $service_type = $this->service_type->get($service['id_service_type']);
            $data['services'][$service['id_service']]['type'] = $service_type->service_type_name;
            foreach ($properties as $value) {
                $property = $this->property->get($value['id_property']);
                $data['services'][$service['id_service']]['properties'][$property['property_name']] = array('value' => $value['value'], 'id_property' => $value['id_property']);
            }
        }
        $data['comments'] = $this->view_only_timeline($id_authority);
        if ($this->session->userdata('user_type') == 1) {
            $this->layout->view('step4_1', $data);
        } else {
            $this->layout->view('step4_1', $data);
        }
    }

    public function re_edit($id_authority) {
        $this->step_files_insert($id_authority);
        $data = $_POST;
        $agreeded = 0;
        foreach ($data as $key => $value) {
            $name = explode("_", $key);
            if (!(int) $name[0]) {
                continue;
            }
            $update_data = array('id_service' => $name[0], 'id_property' => $name[1]);

            $update = array('agreed' => $value);
            $this->service_property->update_by($update_data, $update);
            if ($value != 1) {
                $agreeded = $agreeded + 1;
            }
        }
        if ($agreeded > 0) {
            $update_authority['value'] = 'отправленно на доработку';
        } else {
            $update_authority['value'] = 'согласовано';
        }
        $property = $this->property->get_by(array('code' => 'executable_status'));
        $update_data = array('id_authority' => $id_authority, 'id_property' => $property['id_property']);
        $update=$this->authority_property_model->update_by($update_data, $update_authority);
        if ($update) {
            $authority = $this->authority->get($id_authority);
            $this->activity->add_notification('authority_changed', 6, $authority['id_organization'], $id_authority);
        }
        $url = 'structure/arm_kis';
        $this->authority->set_is_new($id_authority);
        redirect($url);
    }

    public function step4_1($id_authority) {
        $this->check_status_authority($id_authority, 3);
        $this->authority->rest_is_new($id_authority);
        $authority = $this->authority->get($id_authority);
        $data = $authority;
        $authority_property = $this->authority_property_model->get_many_by('id_authority', $id_authority);
        $organization = $this->organization_model->get($authority['id_organization']);
        $data['organization'] = $organization['organization_name'];
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
            $properties = $this->service_property->order_by('id_service_property')->get_many_by('id_service', $service['id_service']);
            $service_type = $this->service_type->get($service['id_service_type']);
            $data['services'][$service['id_service']]['type'] = $service_type->service_type_name;
            foreach ($properties as $value) {
                $property = $this->property->get($value['id_property']);
                $data['services'][$service['id_service']]['properties'][$property['code']] = array('value' => $value['value'], 'agreed' => $value['agreed'], 'property_name' => $property['property_name'], 'id_property' => $property['id_property']);
            }
        }
        $data['comments'] = $this->view_only_timeline($id_authority);
        $this->layout->view('step4', $data);
    }

    public function authority_view($id_authority, $id_authority_status) {
        $this->check_status_authority($id_authority, 5);
        $authority = $this->authority->get($id_authority);
        $data = $authority;
        $data['step'] = $id_authority_status;
        $authority_property = $this->authority_property_model->get_many_by('id_authority', $id_authority);
        $organization = $this->organization_model->get($authority['id_organization']);
        $data['organization'] = $organization['organization_name'];
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
            $properties = $this->service_property->order_by('id_service_property')->get_many_by('id_service', $service['id_service']);
            $service_type = $this->service_type->get($service['id_service_type']);
            $data['services'][$service['id_service']]['type'] = $service_type->service_type_name;
            foreach ($properties as $value) {
                $property = $this->property->get($value['id_property']);
                $data['services'][$service['id_service']]['properties'][$property['property_name']] = array('value' => $value['value'], 'id_property' => $value['id_property']);
            }
        }
        $data['comments'] = $this->view_only_timeline($id_authority);
        $this->layout->view('authority_view', $data);
    }

    public function update_properties($id_authority) {
        $this->load->model('submit_property');
        $submit = new $this->submit_property;
        $submit->insert_new_services();
        $submit->update_services();

        if ($this->input->post('comment')) {
            $this->comment->insert_comment($id_authority, $this->input->post('comment'));
        }
        $update_authority['value'] = 'на согласовании';
        $property = $this->property->get_by(array('code' => 'executable_status'));
        $update_data = array('id_authority' => $id_authority, 'id_property' => $property['id_property']);
        $this->authority_property_model->update_by($update_data, $update_authority);
        $authority = $this->authority->get($id_authority);
        $this->activity->add_notification('authority_changed', 6, $authority['id_organization'], $id_authority);
        $url = 'structure/arm_iogv';
        $this->authority->set_is_new($id_authority);
        redirect($url);
    }

    public function check_status_authority($id_authority, $step_num = 0) {
        if (isset($_SERVER['HTTP_REFERER'])) {
            $ref = $_SERVER['HTTP_REFERER'];
            $ref = explode("/", $ref);
            if ($ref[count($ref) - 1] == "uvedoml") {
                $this->activity->update_by(array('id_object' => $id_authority), array('status' => 2));
            }
        }
        $authority = $this->authority->get($id_authority);
        $writer = $this->authority_property_model->get_authority_property_by_code($id_authority, 'service_subject');
        $status = $this->authority_property_model->get_authority_property_by_code($id_authority, 'executable_status');
        $is_writer = (($writer['value'] == "Отраслевой орган" && $this->session->userdata('user_type') == 2) || ($writer['value'] == "КИС" && $this->session->userdata('user_type') == 1)) ? true : false;
        switch ($authority['id_authority_status']) {
            case 1:
                if (($writer['value'] == "Отраслевой орган" && $this->session->userdata('user_type') == 1) || $this->session->userdata('user_type') > 2) {
                    if ($step_num != 5) {
                        redirect('agreeds/authority_view/' . $id_authority . '/' . $authority['id_authority_status']);
                    }
                } elseif ($step_num != 2)
                    redirect('agreeds/step2/' . $id_authority);
                break;
            case 2:
                if (($this->session->userdata('user_type') > 1 && $status['value'] == 'на согласовании') || ($this->session->userdata('user_type') == 1 && $status['value'] == 'отправленно на доработку') && !$is_writer) {
                    if ($step_num != 5) {
                        redirect('agreeds/authority_view/' . $id_authority . '/' . $authority['id_authority_status']);
                    }
                } elseif ($status['value'] == 'отправленно на доработку' && $is_writer) {
                    if ($step_num != 3) {
                        redirect('agreeds/step4_1/' . $id_authority);
                    }
                } elseif ($step_num != 3) {
                    redirect('agreeds/step3/' . $id_authority);
                }
                break;
            case 3:
                if (($this->session->userdata('user_type') == 2 && ($status['value'] == 'согласовано' || $status['value'] == 'на согласовании' || !$is_writer)) || ($this->session->userdata('user_type') > 2) || ($this->session->userdata('user_type') == 1 && !$is_writer && $status['value'] == 'отправленно на доработку')) {
                    if ($step_num != 5) {
                        redirect('agreeds/authority_view/' . $id_authority . '/' . $authority['id_authority_status']);
                    }
                } elseif ($status['value'] == 'отправленно на доработку' && $is_writer) {
                    if ($step_num != 3) {
                        redirect('agreeds/step4_1/' . $id_authority);
                    }
                } elseif (($this->session->userdata('user_type') == 1) && ($status['value'] == 'согласовано') && $step_num != 4) {
                    redirect('agreeds/step4/' . $id_authority);
                } elseif (($this->session->userdata('user_type') == 1) && ($status['value'] == 'на согласовании') && $step_num != 3) {
                    redirect('agreeds/step3/' . $id_authority);
                }
                break;
            case 4:
                if (($writer['value'] == "Отраслевой орган" && $this->session->userdata('user_type') == 1) || $this->session->userdata('user_type') > 2) {
                    if ($step_num != 5) {
                        redirect('agreeds/authority_view/' . $id_authority . '/' . $authority['id_authority_status']);
                    }
                } elseif ($status['value'] == 'отправленно на доработку') {
                    redirect('agreeds/step4_1/' . $id_authority);
                } elseif ($step_num != 4) {
                    redirect('agreeds/step4_1/' . $id_authority);
                }
                break;
        }
    }

    private function step_files_insert($id_authority) {
        $this->file_insert($id_authority, 'step_file');
        for ($i = 1; $i < 20; $i++) {
            $this->file_insert($id_authority, 'step_file' . $i);
        }
    }

    private function file_insert($id, $file_name, $is_property = false) {
        $config['upload_path'] = $is_property ? 'file_storage/property' : 'file_storage/authority';
        $config['allowed_types'] = 'gif|jpg|png|doc|docx|zip|rar|xls|xlsx|ppt|pptx|pdf|jpeg';
        $config['max_size'] = '0';
        $config['max_width'] = '0';
        $config['max_height'] = '0';
        $config['encrypt_name'] = true;
        $this->load->library('upload', $config);
        if (!$this->upload->do_upload($file_name)) {
            return;
            $error = array('error' => $this->upload->display_errors());
            if ($is_property) {
                return $this->upload->display_errors();
            } else {
                echo $this->upload->display_errors();
            }
        } elseif (!$is_property) {
            $data = array('upload_data' => $this->upload->data());
            $upload_file['name'] = $data['upload_data']['client_name'];
            $upload_file['file_name'] = $data['upload_data']['file_name'];
            $upload_file['id_authority'] = $id;
            $this->file->insert($upload_file);
        } else {
            $data = $this->upload->data();
            return '<a href="file_storage/property/' . $data['file_name'] . '">' . $data['client_name'] . '</a>';
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
                'user_name' => $user['user_name']);
        }
        if (isset($comments_data)) {
            $data['comments_data'] = $comments_data;
            return $this->load->view('comments/timeline_only', $data, true);
        } else {
            return 'Комментариев нет';
        }
    }

    public function history_polnomoch($id_authority) {
        $data = array();
        $view = 'history_authority';
        $notifications = array();
// add to archive
        if ($this->input->is_post()) {
            $items = $this->input->post('selectedItems');
            $this->activity->update_many($items, array('status' => 2));
        }
        $id_organization = $this->session->userdata('id_organization');
        $notifications = $this->activity
                ->order_by('time', 'DESC')
                ->get_many_by(array('id_object' => $id_authority));
        $user = $this->session->userdata('user_name');

        foreach ((array) $notifications as $key => $notification) {
            $notifications[$key]['message'] = $this->activity->get_notification_message_by_event($notification['id_event_type']);
            $notifications[$key]['authority'] = $this->authority->get($notification['id_object']);
            $notifications[$key]['service'] = $this->service->get_by('id_authority', $notification['id_object']);
        }
        $data['notifications'] = $notifications;
        $this->layout->view($view, $data);
    }

    public function history_usl_func() {
        $this->layout->view('history_usl_func');
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
