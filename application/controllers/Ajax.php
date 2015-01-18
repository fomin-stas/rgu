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

    public function get_additional_property($id_additional_property) {
        $this->load->model('additional_property_values');
        $this->load->model('additional_property');
        $property = $this->additional_property->get($id_additional_property);
        $property['values'] = array();
        if ($property['id_property_format'] == 3) {
            $property['values'] = $this->additional_property_values->get_many_by('id_additional_property', $id_additional_property);
        }
        //prepare options
        $result['success'] = true;
        $result['property'] = $property;
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
        $data['property'] = $this->property->get_all();
        if ($type === 'sr') {
            $this->load->view('agreeds/step_2/service', $data);
        } elseif ($type === 'sn') {
            $this->load->view('agreeds/step_2/function', $data);
        } elseif ($type === 'sk') {
            $this->load->view('agreeds/step_2/control', $data);
        }
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

}
