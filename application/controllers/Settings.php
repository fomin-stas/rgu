<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Settings extends APP_Controller {

    function  __construct()  {
        parent::__construct();
        $this->is_loggedIn();
        $this->layout->setLayout('main');
    }

    public function index() {
        $this->config->load('pagination', TRUE);
    	$page = (int)$this->uri->segment(3, 1);
        $limit = $this->config->config['pagination']['per_page']; 

        $properties = $this->property->limit($limit, $page)->order_by('id_property')->with('format')->get_all();
        $service_types = $this->service_type->as_array()->get_all();
        $buff = array();
        // prepare service types
        foreach ((array)$service_types as $item) {
            $buff[$item['id_service_type']] = $item;
        }
        $service_types = $buff;

        if($this->input->is_post()) {
            switch ($this->input->post('method')) {
                case 'add':
                    $this->_add_property();
                    break;
                case 'edit':
                    $this->_edit_property();
                    break;    
            }
        }
        $config = array(); 
        $config['base_url'] = base_url().'settings/index/'; 
        $config['total_rows'] = $this->property->count_all();

        $this->pagination->initialize($config);

        $this->layout->view('index', array(
                                    'properties' => $properties,
        							'service_types' => $service_types,
                                    'pages'=> $this->pagination->create_links()
        							));
    }

    private function _add_property() {
        // new property request 
        $data = array();
        if($this->form_validation->run()) {
            $data['property_name'] = $this->input->post('property_name');   
            $data['property_short_name'] = $this->input->post('property_short_name');   
            $data['id_property_type'] = (int)$this->input->post('property_type');   
            $data['id_service_type'] = (int)$this->input->post('service_type');   
            $data['options']['property_align'] = $this->input->post('property_align');   
            $data['options']['property_width'] = $this->input->post('property_width');   
            $data['options']['property_required'] = $this->input->post('property_required');   
            $data['options']['property_color'] = $this->input->post('property_color');   
            $data['options'] = json_encode($data['options']);
            $data['code'] = NULL;

            // insert new property
            $result = $this->property->insert($data);
            if($result){
                if($data['id_property_type'] == 3) {
                    $values = $this->input->post('type_values');
                    if(count($values) > 0) {
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
        if($id_property) {
            $property = $this->property->get($id_property);
            // update property request 
            if($this->form_validation->run()) {
                $data['id_property'] = (int)$id_property;   
                $data['property_name'] = $this->input->post('property_name');   
                $data['property_short_name'] = $this->input->post('property_short_name');   
                $data['id_property_type'] = (int)$this->input->post('property_type');
                $data['options']['property_align'] = $this->input->post('property_align');   
                $data['options']['property_width'] = $this->input->post('property_width');   
                $data['options']['property_required'] = $this->input->post('property_required');   
                $data['options']['property_color'] = $this->input->post('property_color');   
                $data['options']['property_show_other_users'] = $this->input->post('property_show_other_users');   
                $data['options'] = json_encode($data['options']);
                $data['code'] = NULL;
                // update property
                $result = $this->property->update($id_property, $data);
                if($result){
                    if($data['id_property_type'] == 3) {
                        $values = $this->input->post('type_values');
                        if(count($values) > 0) {
                            foreach ($values as $key => $value) {
                                $p = array(
                                    'property_id' => (int)$id_property,
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
}
