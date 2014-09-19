<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Ajax extends APP_Controller {

    function __construct() {
        parent::__construct();
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
        $authoritis = $this->authority->get_all();
        $authority = $authoritis[$insert_data['authority_num'] - 1];
        $for_get=array('code'=>$insert_data['code']);
        $property = $this->property->get_by($for_get);

        if ($property['id_service_type'] == 6) {
            $authority_property = $this->authority_property_model->get_by(array('id_authority' => $authority['id_authority'], 'id_property' => $property['id_property']));
            $this->authority_property_model->update_by(array('id_authority' => $authority['id_authority'], 'id_property' => $property['id_property']), array('value' => $insert_data['new_data']));
            $history_log['new'] = $insert_data['new_data'];
            $history_log['old'] = $authority_property['value'];
            $history_log['id_property']=$authority_property['id_property'];
            $this->history_log->insert_log($history_log);
        }
        if ($property['id_service_type'] == 7) {
            $authority_property = $this->authority_property_model->get_by(array('id_authority' => $authority['id_authority'], 'id_property' => $property['id_property']));
            $this->authority_property_model->update_by(array('id_authority' => $authority['id_authority'], 'id_property' => $property['id_property']), array('value' => $insert_data['new_data']));
            $history_log['new'] = $insert_data['new_data'];
            $history_log['old'] = $authority_property['value'];
            $history_log['id_property']=$authority_property['id_property'];
            $this->history_log->insert_log($history_log);
        }
    }

    public function get_history_cell() {
        $result = '';
        $history_log = array();
        $row_id = $this->input->post('rowId');
        $coll_index = $this->input->post('collIndex');
        $cell_name = $this->input->post('cellName');

        if(isset($row_id, $coll_index, $cell_name)) {
            $property = $this->property->get_by('code', $cell_name);
            
            if(isset($property)) {
                $user_id = $this->session->userdata('id');
                $history_log = $this->history_log->order_by('time', 'DESC')->get_many_by(
                    array(
                        //'id_user' => $user_id,
                        'id_property' => $property['id_property'],
                        )
                    );

            }

            $result = $this->layout->view('history_cell', array('history_log' => $history_log), true);
        }
        echo $result;
    }

}
