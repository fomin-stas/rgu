<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Structure extends APP_Controller {

    function  __construct()  {
        parent::__construct();

        $this->is_loggedIn();
    }

    public function index() {
        redirect('login');
    }

    public function arm_kis() {
        $grid_data = array();
        $column_names = array();
        $column_models = array();

        $authorities = $this->authority
                            ->with('status')
                            ->with('organization')
                            ->with('properties')
                            ->get_all();
        
        $properties = $this->property->with('format')->get_many_by('code IS NOT NULL');

        //$properties = array_slice($properties, 0, 1);
        
        foreach ((array)$properties as $property) {
            $column_names[] = $property['property_name'];
            $model['name'] = $property['code'];
            $model['index'] = $property['code'];
            switch ($property['format']['property_format_name']) {
                case 'system':
                    $model['editable'] = false;
                    $model['fixed'] = true;
                    $model['width'] = 100;
                    break;
                case 'number':
                    $model['editable'] = false;
                    $model['fixed'] = true;
                    $model['width'] = 100;
                    break;
                case 'date':
                    $model['editable'] = false;
                    $model['fixed'] = true;
                    $model['width'] = 120;
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

            // linked to colmn model
            $column_models[] = $model;

            // add property to properties buffer
            $properties_buff[$property['id_property']] = $property;
        }
        // prepare json grid
        foreach ((array)$authorities as $authority) {
            $values = array();

            // create row values
            foreach ($column_models as $model) {
                $values[$model['name']] = '';
            }
            
            // add athority properties to grid
            foreach ((array)$authority['properties'] as $p) {
                if(array_key_exists($p['id_property'], $properties_buff)) {
                    $values[$properties_buff[$p['id_property']]['code']] = $p['value']; 
                }
            }
            //add service properties to grid
            $this->load->model('service');
            $this->load->model('service_property');
            $service = $this->service->get_by('id_authority', $authority['id_authority']);
            if(isset($service) AND !empty($service)) {
                $service_properties = $this->service_property->get_many_by('id_service', $service['id_service']);
                if(count($service_properties)) {
                    foreach ((array)$service_properties as $p) {
                        if(array_key_exists($p['id_property'], $properties_buff)) {
                            $values[$properties_buff[$p['id_property']]['code']] = $p['value']; 
                        }
                    }
                }
            }

            $grid_data[] = $values;
        }
        $grid_data[] = $values;
        $this->layout->view('arm_kis', array(
            'grid_data' => json_encode($grid_data),
            'column_models' => json_encode($column_models),
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
        $db=$this->organization_model->dropdown('organization_name');
        $db_iogv=$this->organization_model->dropdown('organization_name','organization_name');
        $data['db']=$db;
        $data['db_iogv']=$db_iogv;
        $this->layout->view('polnomoch',$data);
    }
    
    public function step1_submit() {
        $authority['authority_name']=$this->input->post('name_authority');
        $property['punkt_iogv']=$this->input->post('punkt_iogv');
        $property['name_iogv']=$this->input->post('name_iogv');
        $property['rekvisit_npa']=$this->input->post('rekvisit_npa');
        $property['project_post']=$this->input->post('project_post');
        $property['srok_otveta']=$this->input->post('srok_otveta');
        $authority['id_organization']=$this->input->post('select_org');
        $authority['id_authority_status']=1;
         //обработка добавления комментария - позже
        $comments['comment_st1']=$this->input->get('comment_st1');
        $this->load->model('authority');
        $id_authority=$this->authority->insert($authority);
        $this->authority_property->_id_authority=$id_authority;
        $this->authority_property->insert_where_code_many($property);
        redirect('structure/arm_kis');
    }

    public function step2($id_authority) {
        $authority=$this->authority->get($id_authority);
        $data['authority_name']=$authority->authority_name;
        $authority_property=$this->authority_property->get_many_by('id_authority',$id_authority);
        $organization=$this->organization_model->get($authority->id_organization);
        $data['organization']=$organization->organization_name;
        $data['spher']=$this->spher->dropdown('name','name');
        $data['organization_provide_service']=$this->organization_model->dropdown('organization_name','organization_name');
        foreach($authority_property as $value){
            $property=$this->property->get($value->id_property);
            $data[$property['code']]=$value->value;
        }
        $this->layout->view('razgran_p', $data);
    }
    
    public function step2_submit() {
        $data=$this->input->post();
        $i++;
    }

    public function step3() {
        $this->layout->view('step3');
    }

    public function step4() {
        $this->layout->view('step4');
    }

    public function step4_1() {
        $this->layout->view('step4_1');
    }

    public function arm_iogv() {
        $grid_data = array();
        $column_names = array();
        $column_models = array();

        $authorities = $this->authority
                            ->with('status')
                            ->with('organization')
                            ->with('properties')
                            ->get_all();
        
        $properties = $this->property->with('format')->get_many_by('code IS NOT NULL');

        //$properties = array_slice($properties, 0, 1);
        
        foreach ((array)$properties as $property) {
            $column_names[] = $property['property_name'];
            $model['name'] = $property['code'];
            $model['index'] = $property['code'];
            switch ($property['format']['property_format_name']) {
                case 'system':
                    $model['editable'] = false;
                    $model['fixed'] = true;
                    $model['width'] = 100;
                    break;
                case 'number':
                    $model['editable'] = false;
                    $model['fixed'] = true;
                    $model['width'] = 100;
                    break;
                case 'date':
                    $model['editable'] = false;
                    $model['fixed'] = true;
                    $model['width'] = 120;
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
                    $model['editoptions'] = array();
                    $model['width'] = 250;
                    break;
                case 'multiselect':
                    $model['editable'] = false;
                    $model['fixed'] = true;
                    $model['stype'] = 'select';
                    $model['edittype'] = 'select';
                    $model['editoptions'] = [];
                    $model['width'] = 250;
                    break;
            }

            // linked to colmn model
            $column_models[] = $model;

            // add property to properties buffer
            $properties_buff[$property['id_property']] = $property;
        }
        // prepare json grid
        foreach ((array)$authorities as $authority) {
            $values = array();

            // create row values
            foreach ($column_models as $model) {
                $values[$model['name']] = '';
            }
            
            // add athority properties to grid
            foreach ((array)$authority['properties'] as $p) {
                if(array_key_exists($p['id_property'], $properties_buff)) {
                    $values[$properties_buff[$p['id_property']]['code']] = $p['value']; 
                }
            }
            //add service properties to grid
            $this->load->model('service');
            $this->load->model('service_property');
            $service = $this->service->get_by('id_authority', $authority['id_authority']);
            if(isset($service) AND !empty($service)) {
                $service_properties = $this->service_property->get_many_by('id_service', $service['id_service']);
                if(count($service_properties)) {
                    foreach ((array)$service_properties as $p) {
                        if(array_key_exists($p['id_property'], $properties_buff)) {
                            $values[$properties_buff[$p['id_property']]['code']] = $p['value']; 
                        }
                    }
                }
            }

            $grid_data[] = $values;
        }
        $grid_data[] = $values;
        $this->layout->view('arm_iogv', array(
            'grid_data' => json_encode($grid_data),
            'column_models' => json_encode($column_models),
            'column_names' => json_encode($column_names),
            )
        );
    }

}
