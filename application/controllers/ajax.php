<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Ajax extends APP_Controller {

    function __construct() {
        parent::__construct();
        $this->is_loggedIn();
        $this->layout->setLayout('ajax');
    }

    public function remove_property() {
        $result = array();
        $id = $this->input->post('id');
        if (isset($id)) {
            $result['success'] = $this->property->delete($id);
        }
        echo json_encode($result);
    }

    public function get_property_by_id() {
        $result = array();
        $id = $this->input->post('id');
        if (isset($id)) {
            $property = $this->property->get($id);
            if (isset($property)) {
                $property['values'] = array();
                if ($property['id_property_type'] == 3) {
                    $property['values'] = $this->property_values_model->get_many_by('property_id', $property['id_property']);
                }
                //prepare options
                $property['options'] = json_decode($property['options'], true);
                $result['success'] = true;
                $result['property'] = $property;
            }
        }
        echo json_encode($result);
    }

    public function edit_property() {
        $data = $_POST;
        foreach ($data as $key => $value) {
            if ($key == 'id') {
                $insert_data['authority_num'] = $value;
            } elseif ($key == 'oper') {
                $insert_data['operation'] = $value;
            } else {
                $insert_data['code'] = $key;
                $insert_data['new_data'] = $value;
            }
        }
        $authority = $this->authority->get($data['id_authority']);
        $for_get = array('code' => $insert_data['code']);
        $property = $this->property->get_by($for_get);

        if (NULL == $property['id_service_type']) {
            $property['id_service_type'] = 7;
        }

        if ($property['id_service_type'] == 6) {
            $authority_property = $this->authority_property_model->get_by(array('id_authority' => $authority['id_authority'], 'id_property' => $property['id_property']));
            if (empty($authority_property)) {
                $this->authority_property_model->insert(array('id_authority' => $authority['id_authority'], 'id_property' => $property['id_property'], 'value' => $insert_data['new_data']));
                $authority_property = $this->authority_property_model->get_by(array('id_authority' => $authority['id_authority'], 'id_property' => $property['id_property']));
            } else {
                $this->authority_property_model->update_by(array('id_authority' => $authority['id_authority'], 'id_property' => $property['id_property']), array('value' => $insert_data['new_data']));
            }
            $this->save_history($insert_data['new_data'], $service_property['value'], $service_property['id_property']);
            $this->activity->add_notification('authority_changed', 6, $authority['id_organization'], $authority['id_authority']);
        }
        if ($property['id_service_type'] != 6) {
            if ($data['id_service'] == 0) {
                echo '-2';
                return;
            }
            $service = $this->service->get($data['id_service']);
            if (!empty($service)) {
                $service_property = $this->service_property->get_by(array('id_service' => $service['id_service'], 'id_property' => $property['id_property']));
                if (empty($service_property)) {
                    $this->service_property->insert(array('id_service' => $service['id_service'], 'id_property' => $property['id_property'], 'value' => $insert_data['new_data']));
                    $service_property = $this->service_property->get_by(array('id_service' => $service['id_service'], 'id_property' => $property['id_property']));
                    $service_property['value'] = 'Данные отсутствуют';
                } else {
                    $this->service_property->update_by(array('id_service' => $service['id_service'], 'id_property' => $property['id_property']), array('value' => $insert_data['new_data']));
                }
                $this->service_property->update_by(array('id_service' => $service['id_service'], 'id_property' => $property['id_property']), array('value' => $insert_data['new_data']));
                $this->save_history($insert_data['new_data'], $service_property['value'], $service_property['id_property']);
            } else {
                echo '-1';
            }
        }
    }

    private function save_history($new_value, $old_value, $id_property) {
        if ($new_value === $old_value) {
            return;
        }
        $history_log = array('new' => $new_value, 'old' => $old_value, 'id_property' => $id_property);
        $this->history_log->insert_log($history_log);
    }

    public function get_history_cell() {
        $result = '';
        $history_log = array();
        $row_id = $this->input->post('rowId');
        $coll_index = $this->input->post('collIndex');
        $cell_name = $this->input->post('cellName');
        $authority_id = $this->input->post('authority_id');
        if (isset($row_id, $coll_index, $cell_name, $authority_id)) {
            $authority = $this->authority->get($authority_id);
            // User info 
            $user_id = $this->session->userdata('id');
            $id_organization = $this->session->userdata('id_organization');
            if (isset($authority) AND ( $authority['id_organization'] == $id_organization OR $id_organization == 1 OR $id_organization == 31554)) {
                $property = $this->property->get_by('code', $cell_name);
                if (isset($property)) {
                    $history_log = $this->history_log->order_by('time', 'DESC')->get_many_by(
                            array(
                                //'id_user' => $user_id,
                                'id_property' => $property['id_property'],
                            )
                    );
                }
                $result = $this->layout->view('history_cell', array('history_log' => $history_log), true);
            } else {
                $result = $this->layout->view('history_cell_access_denied', array(), true);
            }
        }
        echo $result;
    }

    public function delete_property_by_id() {
        $result['success'] = false;
        $data = $_POST;
        if (isset($data['property_id'])) {
            // remove property
            $result['success'] = $this->property_values_model->delete($data['property_id']);
        }
        echo json_encode($result);
    }

    public function get_property_comments($id, $num = 0) {
        $property_array = explode("_", $id);
        $service_property = $this->service_property->get_by(array('id_service' => $property_array[1], 'id_property' => $property_array[2]));
        $service_property['num'] = $num;
        $service_property['property_comments'] = $this->property_comments->get_many_by(array('id_service_property' => $service_property['id_service_property']));
        $this->load->view('ajax/comments_property', $service_property);
    }

    public function insert_comments() {
        $id = $this->input->post('id');
        $property_array = explode("_", $id);
        $comment = $this->input->post('comment');
        $this->property_comments->insert_comment($property_array[1], $comment);
    }

    public function get_service($type, $service_num) {
        $data['organization_provide_service'] = $this->organization_model->dropdown('organization_name', 'organization_name');
        $data['spher'] = $this->spher->dropdown('name', 'name');
        $data['service_num'] = $service_num;
        $additional_property = $this->additional_property->get_key_id_all();
        $data['property'] = $this->property->get_all();
        foreach ($data['property'] as $key => $property) {
            $data_additional['id_property'] = $property['id_property'];
            $data_additional['title'] = $property['property_name'];
            $data_additional['content'] = '';
            $data_additional['type'] = $type;
            $data_additional['service_num'] = $service_num;
            $additional_data = $this->additional_property->generate_tree_structure($property['id_property'], $data_additional);
            $data_additional['tree'] = $additional_data['tree'];
            foreach ($additional_data['content'] as $id_ap => $id_property_format) {
                if (($id_property_format == 3) || ($id_property_format == 5)) {
                    $options = $this->additional_property_values->get_additional_property_values($id_ap);
                    $data_content = array(
                        'id_property_format' => $id_property_format,
                        'id_additional_property' => $id_ap,
                        'additional_property_name' => $additional_property[$id_ap]['additional_property_name'],
                        'type' => $type,
                        'service_num' => $service_num,
                        'options' => $options
                    );
                } else {
                    $data_content = array(
                        'id_property_format' => $id_property_format,
                        'id_additional_property' => $id_ap,
                        'additional_property_name' => $additional_property[$id_ap]['additional_property_name'],
                        'type' => $type,
                        'service_num' => $service_num
                    );
                }
                $data_additional['content'].=$data_additional['content'] . $this->load->view('settings/modal_dialog/modal_content', $data_content, true);
            }
            if (count(json_decode($data_additional['tree'])) > 0) {
                $data['property'][$key]['additional_property'] = $this->load->view('settings/modal_dialog/modal_dialog', $data_additional, true);
            } else {
                $data['property'][$key]['additional_property'] = $this->load->view('settings/modal_dialog/without_additional', $data_additional, true);
            }
        }
        if ($type === 'sr') {
            $this->load->view('agreeds/step_2/service', $data);
        } elseif ($type === 'sn') {
            $this->load->view('agreeds/step_2/function', $data);
        } elseif ($type === 'sk') {
            $this->load->view('agreeds/step_2/control', $data);
        }
    }

    public function get_service_full_property() {
        $row_id = $this->input->post('rowId');
        $coll_index = $this->input->post('collIndex');
        $code = $this->input->post('cellName');
        $id_authority = $this->input->post('authority_id');
        $additional_property = $this->additional_property->get_key_id_all();
        $property = $this->property->get_by('code', $code);
        $data_additional['id_property'] = $property['id_property'];
        $data_additional['title'] = $property['property_name'];
        $data_additional['content'] = '';
        $data_additional['type'] = 'adiceed_'.$property['id_property'];;
        $data_additional['service_num'] = $id_authority;
        $additional_data = $this->additional_property->generate_tree_structure($property['id_property'], $data_additional);
        $data_additional['tree'] = $additional_data['tree'];
        
        //обработка свойства
        if (($property['id_property_type'] == 3) || ($property['id_property_type'] == 5)) {
                $options = $this->property_values_model->get_property_values($property['id_property']);
                $data_content = array(
                    'id_property_format' => $property['id_property_type'],
                    'id_additional_property' => $property['id_property'],
                    'additional_property_name' => $property['property_name'],
                    'type' => 'adiceed_'.$property['id_property'],
                    'service_num' => $id_authority,
                    'options' => $options
                );
            } else {
                $data_content = array(
                    'id_property_format' => $property['id_property_type'],
                    'id_additional_property' => $property['id_property'],
                    'additional_property_name' => $property['property_name'],
                    'type' => 'adiceed_'.$property['id_property'],
                    'service_num' => $id_authority
                );
            }
        $data_additional['property_content']=$this->load->view('settings/modal_dialog/modal_content', $data_content, true);
        //*********************************
        
        foreach ($additional_data['content'] as $id_ap => $id_property_format) {
            if (($id_property_format == 3) || ($id_property_format == 5)) {
                $options = $this->additional_property_values->get_additional_property_values($id_ap);
                $data_content = array(
                    'id_property_format' => $id_property_format,
                    'id_additional_property' => $id_ap,
                    'additional_property_name' => $additional_property[$id_ap]['additional_property_name'],
                    'type' => 'adiceed_'.$property['id_property'],
                    'service_num' => $id_authority,
                    'options' => $options
                );
            } else {
                $data_content = array(
                    'id_property_format' => $id_property_format,
                    'id_additional_property' => $id_ap,
                    'additional_property_name' => $additional_property[$id_ap]['additional_property_name'],
                    'type' => 'adiceed_'.$property['id_property'],
                    'service_num' => $id_authority
                );
            }
            $data_additional['content'].=$data_additional['content'] . $this->load->view('settings/modal_dialog/modal_content', $data_content, true);
        }
        if (count(json_decode($data_additional['tree'])) > 0) {
            $property['additional_property'] = $this->load->view('structure/property_edit', $data_additional, true);
        }else{
            $property['additional_property'] = $this->load->view('structure/without_additional_property', $data_additional, true);
        }
        echo $property['additional_property'];
    }

    function export_excel() {
        var_dump($_POST);
    }

//    function confirm($type,$id_service){
//        $property=  $this->service_property->update_where_code();
//        echo 0;
//    }

    function confirm($id_authority) {
        echo $this->authority->confirm($id_authority);
    }

    public function disagred($id_authority) {
        echo $this->authority->disagred_status($id_authority);
    }

    public function propertys_array($code) {
        $text = $this->input->post('text');
        $values = $this->property->serch_values_by_code($text, $code);
        echo json_encode($values);
    }

    public function remove_service($id_service) {
        $this->load->model('service_arh');
        $this->service_arh->to_arhive($id_service);
        return 0;
    }

    //*****************************************************
    //Additional property
    public function get_additional_property($id_additional_property) {
        $this->load->model('additional_property_values');
        $this->load->model('additional_property');
        $this->load->model('pap');
        $property = $this->additional_property->get($id_additional_property);
        $property['values'] = array();
        if ($property['id_property_format'] == 3) {
            $property['values'] = $this->additional_property_values->get_many_by('id_additional_property', $id_additional_property);
        }
        $pap = $this->pap->get_by('id_additional_property', $id_additional_property);
        if (count($pap) != 0) {
            if (!is_nan($pap['id_property'])) {
                if (!is_null($pap['id_property'])) {
                    if ($pap['id_property'] != 0) {
                        $result['parent'] = 'property';
                        $result['id_parent'] = $pap['id_property'];
                    }
                }
            }
            if (!is_nan($pap['add_id_additional_property'])) {
                if (!is_null($pap['add_id_additional_property'])) {
                    if ($pap['add_id_additional_property'] != 0) {
                        $result['parent'] = 'additional_property';
                        $result['id_parent'] = $pap['add_id_additional_property'];
                    }
                }
            }
            if (!is_nan($pap['property_value_id'])) {
                if (!is_null($pap['property_value_id'])) {
                    if ($pap['property_value_id'] != 0) {
                        $result['parent'] = 'property_values';
                        $result['id_parent'] = $pap['property_value_id'];
                        $property_value = $this->property_values_model->get($pap['property_value_id']);
                        $data['values'] = $this->property_values_model->get_property_values($property_value['property_id']);
                        $data['select'] = $pap['property_value_id'];
                        $data['name'] = 'edit_additional';
                        $result['inner_html'] = str_replace('"', "'", $this->load->view('settings/property_values', $data, true));
                        $result['parent_values'] = $this->property_values_model->get_many_by(array('property_id' => $property_value['property_id']));
                        $result['id_property'] = $property_value['property_id'];
                    }
                }
            }
            if (!is_nan($pap['id_additional_property_values'])) {
                if (!is_null($pap['id_additional_property_values'])) {
                    if ($pap['id_additional_property_values'] != 0) {
                        $result['parent'] = 'additional_property_values';
                        $result['id_parent'] = $pap['id_additional_property_values'];
                        $property_value = $this->additional_property_values->get($pap['id_additional_property_values']);
                        $data['values'] = $this->additional_property_values->get_additional_property_values($property_value['id_additional_property']);
                        $data['select'] = $pap['id_additional_property_values'];
                        $data['name'] = 'edit_additional';
                        $result['inner_html'] = $this->load->view('settings/property_values', $data, true);
                        $result['id_property'] = $property_value['id_additional_property'];
                    }
                }
            }
        }
        //prepare options
        $result['success'] = true;
        $result['property'] = $property;
        echo json_encode($result);
    }

    public function get_property_values($id_property, $name) {
        $result['values'] = $this->property_values_model->get_property_values($id_property);
        $result['success'] = true;
        $data = array('name' => $name, 'values' => $result['values']);
        $result['inner_html'] = $this->load->view('settings/property_values', $data, true);
        echo json_encode($result);
    }

    public function get_additional_property_values($id_additional_property, $name) {
        $this->load->model('additional_property_values');
        $result['values'] = $this->additional_property_values->get_additional_property_values($id_additional_property);
        $result['success'] = true;
        $data = array('name' => $name, 'values' => $result['values']);
        $result['inner_html'] = $this->load->view('settings/property_values', $data, true);
        echo json_encode($result);
    }

    public function get_addition_property_dialog($id_property) {
        $this->load->model('additional_property_values');
        $this->load->model('additional_property');
        $this->load->model('pap');
        $paps = $this->pap->get_many_by(array('id_property' => $id_property));
        $modal = '';
        if (count($paps) > 0) {
            foreach ($paps as $pap) {
                $modal = $modal . $this->recursiv_rebuild_additional_property($pap);
            }
        } else {
            $data = array('title' => 'У данного свойства нет дополнительных свойств', 'content' => '');
            $modal = $this->load->view('settings/modal_dialog/modal_dialog', $data, true);
        }
        $data = array('title' => 'Дополнительные свойства', 'content' => $modal, 'id_property' => $id_property);
        $modal = $this->load->view('settings/modal_dialog/modal_dialog', $data, true);
        $result['innerHTML'] = $modal;
        $result['id'] = $id_property;
        echo json_encode($result);
    }

    private function recursiv_rebuild_additional_property($pap) {
        $this->load->model('additional_property_values');
        $this->load->model('additional_property');
        $this->load->model('pap');
        $modal = '';
        if (!is_nan($pap['id_property'])) {
            if (!is_null($pap['id_property'])) {
                if ($pap['id_property'] != 0) {
                    $modal = $modal . $this->check_additional_property($pap['id_additional_property'], 'property_' . $pap['id_property']);
                }
            }
        }
        if (!is_nan($pap['add_id_additional_property'])) {
            if (!is_null($pap['add_id_additional_property'])) {
                if ($pap['add_id_additional_property'] != 0) {
                    $result['parent'] = 'additional_property';
                    $result['id_parent'] = $pap['add_id_additional_property'];
                }
            }
        }
        if (!is_nan($pap['property_value_id'])) {
            if (!is_null($pap['property_value_id'])) {
                if ($pap['property_value_id'] != 0) {
                    $result['parent'] = 'property_values';
                    $result['id_parent'] = $pap['property_value_id'];
                    $property_value = $this->property_values_model->get($pap['property_value_id']);
                    $data['values'] = $this->property_values_model->get_property_values($property_value['property_id']);
                    $data['select'] = $pap['property_value_id'];
                    $data['name'] = 'edit_additional';
                    $result['inner_html'] = str_replace('"', "'", $this->load->view('settings/property_values', $data, true));
                    $result['parent_values'] = $this->property_values_model->get_many_by(array('property_id' => $property_value['property_id']));
                    $result['id_property'] = $property_value['property_id'];
                }
            }
        }
        if (!is_nan($pap['id_additional_property_values'])) {
            if (!is_null($pap['id_additional_property_values'])) {
                if ($pap['id_additional_property_values'] != 0) {
                    $result['parent'] = 'additional_property_values';
                    $result['id_parent'] = $pap['id_additional_property_values'];
                    $property_value = $this->additional_property_values->get($pap['id_additional_property_values']);
                    $data['values'] = $this->additional_property_values->get_additional_property_values($property_value['id_additional_property']);
                    $data['select'] = $pap['id_additional_property_values'];
                    $data['name'] = 'edit_additional';
                    $result['inner_html'] = $this->load->view('settings/property_values', $data, true);
                    $result['id_property'] = $property_value['id_additional_property'];
                }
            }
        }
        $paps = $this->pap->get_many_by(array('add_id_additional_property' => $pap['id_additional_property']));
        $modal = $modal . "<div class='row'>";
        foreach ($paps as $pap) {
            $modal = $modal . $this->recursiv_rebuild_additional_property($pap);
        }
        $modal = $modal . "</div>";
        return $modal;
    }

    private function check_additional_property($id_additional_property, $id) {
        $modal = '';
        $this->load->model('additional_property_values');
        $this->load->model('additional_property');
        $this->load->model('pap');
        $ap = $this->additional_property->get($id_additional_property);
        $id = $id . '_' . $ap['id_additional_property'];
        $modal = $modal . "<div class='form-group col-md-12'><label for=" . $id . "> " . $ap['additional_property_name'] . " </label>";
        if ($ap['id_property_format'] == 2) {
            $data = array(
                'name' => $id,
                'id' => $id,
                'value' => '',
                'rows' => 3,
                'class' => 'form-control col-md-8',
            );
            $modal = $modal . form_textarea($data);
        }
        if ($ap['id_property_format'] == 3) {
            $options = $this->additional_property_values->get_additional_property_values($id_additional_property);
            $modal = $modal . form_dropdown($id, $options, '', 'class=\'form-control col-md-8\'');
        }
        if ($ap['id_property_format'] == 7) {
            $data = array(
                'name' => $id,
                'id' => $id,
                'value' => '',
                'class' => 'form-control col-md-8 files',
            );

            $modal = $modal . form_upload($data);
            $modal = $modal . "<script>$('#" . $id . "').ace_file_input({
            no_file: 'Присоединить файл',
            btn_choose: 'Выбрать',
            btn_change: 'Изменить',
            enable_reset: true
        });</script>";
        }
        $modal = $modal . "</div>";
        return $modal;
    }

    //******************************************************
    
    public function upload(){

        $config['upload_path'] = "/static/img/articles";
        $config['allowed_types'] = "jpg|jpeg|png|gif|flv|mp4|wmv|doc|docx|xsl|xslx|ppt|pptx|zip|rar|tar";
        $config['max_size']	= 2048;
        $config['max_width'] = 800;
        $config['max_height'] = 600;
        $config['encrypt_name'] = TRUE;

        $this->load->library('upload', $config);

        if ($this->upload->do_upload() == false) {
            $error = array('error' => $this->upload->display_errors());
            echo json_encode($error);
        }else{
            $data = $this->upload->data();
            echo json_encode($data);
        }
    }
}
