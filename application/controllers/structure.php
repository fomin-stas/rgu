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

        $properties = $this->property->with('format')->get_many_by('code IS NOT NULL');

        //$properties = array_slice($properties, 0, 1);

        foreach ((array) $properties as $property) {
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

    public function arm_iogv() {

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

        $properties = $this->property->with('format')->get_many_by('code IS NOT NULL');

        //$properties = array_slice($properties, 0, 1);

        foreach ((array) $properties as $property) {
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
