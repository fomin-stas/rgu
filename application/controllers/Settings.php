<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Settings extends APP_Controller {

    function __construct() {
        parent::__construct();
        $this->is_loggedIn();
        $this->layout->setLayout('main');
    }

    
    public function index() {
        $this->load->model('additional_property');
        $this->config->load('pagination', TRUE);
        $page = (int) $this->uri->segment(3, 1);
        $limit = $this->config->config['pagination']['per_page'];
        $properties = $this->property->limit($limit, $page)->order_by('id_property')->with('format')->get_all();
        $additional_property = $this->additional_property->order_by('id_additional_property')->with('format')->get_all();
        $service_types = $this->service_type->as_array()->get_all();
        $buff = array();
        // prepare service types
        foreach ((array) $service_types as $item) {
            $buff[$item['id_service_type']] = $item;
        }
        $service_types = $buff;
        if ($this->input->is_post()) {
            switch ($this->input->post('method')) {
                case 'add':
                    $this->_add_property();
                    break;
                case 'edit':
                    $this->_edit_property();
                    break;
                case 'additional':
                    $this->_add_additional();
                    break;
                case 'edit_additional':
                    $this->_edit_additional();
                    break;
            }
        }
        $property_select = $this->property->get_all_id_name_property();
        $property_values_select = $this->property->get_all_property_with_values();
        $additional_property_select = $this->additional_property->get_all_id_name_additional_property();
        $additional_property_values_select = $this->additional_property->get_all_additional_property_with_values();
        $additional_parent = $this->load->view('settings/parent_additional_property', array(
            'property_select' => $property_select,
            'name' => 'add_additional',
            'property_values_select' => $property_values_select,
            'additional_property_values_select' => $additional_property_values_select,
            'additional_property_select' => $additional_property_select,
            'select' => ''
                ), true);
        $edit_additional_parent = $this->load->view('settings/parent_additional_property', array(
            'property_select' => $property_select,
            'name' => 'edit_additional',
            'property_values_select' => $property_values_select,
            'additional_property_values_select' => $additional_property_values_select,
            'additional_property_select' => $additional_property_select,
            'select' => ''
                ), true);
        $config = array();
        $config['base_url'] = base_url() . 'settings/index/';
        $config['total_rows'] = $this->property->count_all();
        $this->pagination->initialize($config);
        $this->layout->view('index', array(
            'properties' => $properties,
            'service_types' => $service_types,
            'pages' => $this->pagination->create_links(),
            'additional_properties' => $additional_property,
            'additional_parent' => $additional_parent,
            'edit_additional_parent' => $edit_additional_parent
        ));
    }

    private function _add_property() {
        // new property request 
        $data = array();
        if ($this->form_validation->run()) {
            $data['property_name'] = $this->input->post('property_name');
            $data['property_short_name'] = $this->input->post('property_short_name');
            $data['id_property_type'] = (int) $this->input->post('property_type');
            $data['id_service_type'] = (int) $this->input->post('service_type');
            $data['options']['property_align'] = $this->input->post('property_align');
            $data['options']['property_width'] = $this->input->post('property_width');
            $data['options']['property_required'] = ($this->input->post('property_required')) ? true : false;
            $data['options']['property_iogv_displayed'] = ($this->input->post('property_iogv_displayed') == 'on') ? true : false;
            $data['options']['property_other_users_displayed'] = ($this->input->post('property_other_users_displayed') == 'on') ? true : false;
            $data['options']['property_color'] = $this->input->post('property_color');
            $data['options'] = json_encode($data['options']);
            $data['code'] = 'kis_' . $this->property->get_kis_number();
            // insert new property
            $result = $this->property->insert($data);
            if ($result) {
                if ($data['id_property_type'] == 3) {
                    $values = $this->input->post('type_values');
                    if (count($values) > 0) {
                        foreach ($values as $key => $value) {
                            $p = array(
                                'property_id' => $result,
                                'value' => $value
                            );
                            $this->property_values_model->insert($p);
                        }
                    }
                }

                $this->session->set_flashdata('message', 'Новое свойство успешно создано');
                redirect('/settings/index#');
            }
        }
    }

    private function _edit_property() {
        $data = array();
        $id_property = $this->input->post('id_property');
        if ($id_property) {
            $property = $this->property->get($id_property);
            // update property request 
            if ($this->form_validation->run()) {
                $data['id_property'] = (int) $id_property;
                $data['property_name'] = $this->input->post('property_name');
                $data['property_short_name'] = $this->input->post('property_short_name');
                $data['id_property_type'] = (int) $this->input->post('property_type');
                $data['options']['property_align'] = $this->input->post('property_align');
                $data['options']['property_width'] = $this->input->post('property_width');
                $data['options']['property_required'] = $this->input->post('property_required');
                $data['options']['property_color'] = $this->input->post('property_color');
                $data['options']['property_show_other_users'] = $this->input->post('property_show_other_users');
                $data['options'] = json_encode($data['options']);
                //$data['code'] = NULL;
                // update property
                $result = $this->property->update($id_property, $data);
                if ($result) {
                    if ($data['id_property_type'] == 3) {
                        $values = $this->input->post('type_values');
                        if (count($values) > 0 && $values != false) {
                            foreach ($values as $key => $value) {
                                $p = array(
                                    'property_id' => (int) $id_property,
                                    'value' => $value
                                );
                                $this->property_values_model->insert($p);
                            }
                        }
                    }
                    $this->session->set_flashdata('message', 'Cвойство успешно отредактировано');
                    redirect('/settings/index#');
                }
            }
        }
    }

    private function _add_additional() {
        // new property request 
        $this->load->model('additional_property');
        $this->load->model('additional_property_values');
        $this->load->model('pap');
        $data = array();
        $data['additional_property_name'] = $this->input->post('add_additional_property_name');
        $data['id_property_format'] = (int) $this->input->post('property_type');
        $id_additional_property = $this->additional_property->insert($data);
        if ($id_additional_property) {
            if ($data['id_property_format'] == 3) {
                $values = $this->input->post('type_values');
                if (count($values) > 0) {
                    foreach ($values as $key => $value) {
                        $p = array(
                            'id_additional_property' => $id_additional_property,
                            'value' => $value
                        );
                        $this->additional_property_values->insert($p);
                    }
                }
            }
            $insert_data['id_additional_property'] = $id_additional_property;
            switch ($this->input->post('parent_type')) {
                case 'property':
                    $insert_data['id_property'] = $this->input->post('add_additional_parent_property_list');
                    $this->pap->insert($insert_data);
                    break;
                case 'property_values':
                    $insert_data['property_value_id'] = $this->input->post('add_additional_parent_property_value');
                    $this->pap->insert($insert_data);
                    break;
                case 'additional_property':
                    $insert_data['add_id_additional_property'] = $this->input->post('add_additional_parent_additional_property_list');
                    $this->pap->insert($insert_data);
                    break;
                case 'additional_property_values':
                    $insert_data['id_additional_property_values'] = $this->input->post('add_additional_parent_additional_property_value');
                    $this->pap->insert($insert_data);
                    break;
            }
            $this->session->set_flashdata('message', 'Новое доп. свойство успешно создано');
            redirect('/settings/index#');
        }
    }

    private function _edit_additional() {
        // new property request
        $this->load->model('additional_property');
        $this->load->model('additional_property_values');
        $this->load->model('pap');
        $data = array();
        $id_additional_property = $this->input->post('id_additional_property');
        $data['additional_property_name'] = $this->input->post('edit_additional_property_name');
        $data['id_property_format'] = (int) $this->input->post('property_type');
        $this->additional_property->update($id_additional_property, $data);
        if ($data['id_property_format'] == 3) {
            $values = $this->input->post('type_values');
            $this->additional_property_values->update_values($id_additional_property, $values);
        }
        $update_data['id_additional_property'] = $id_additional_property;
        $pap = $this->pap->get_by($update_data);
        $update_data['id_property'] = NULL;
        $update_data['property_value_id'] = NULL;
        $update_data['add_id_additional_property'] = NULL;
        $update_data['id_additional_property_values'] = NULL;
        switch ($this->input->post('parent_type')) {
            case 'property':
                $update_data['id_property'] = $this->input->post('edit_additional_parent_property_list');
                $this->pap->update($pap['id_pap'], $update_data);
                break;
            case 'property_values':
                $update_data['property_value_id'] = $this->input->post('edit_additional_parent_property_value');
                $this->pap->update($pap['id_pap'], $update_data);
                break;
            case 'additional_property':
                $update_data['add_id_additional_property'] = $this->input->post('edit_additional_parent_additional_property_list');
                $this->pap->update($pap['id_pap'], $update_data);
                break;
            case 'additional_property_values':
                $update_data['id_additional_property_values'] = $this->input->post('edit_additional_parent_additional_property_value');
                $this->pap->update($pap['id_pap'], $update_data);
                break;
        }
        $this->session->set_flashdata('message', 'Доп. свойство успешно отредактировано');
        redirect('/settings/index#');
    }

}
