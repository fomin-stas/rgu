<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Structure extends APP_Controller {

    public $notifications_size = 0;

    function __construct() {
        parent::__construct();
        $this->is_loggedIn();
        SetCookie("organization_name", $this->session->userdata('organization_name'));
        $user_id = $this->session->userdata('id');
        $user_info = $this->user->get($user_id);
        if ($this->session->userdata('user_type') == 1) {
            $this->notifications_size = $this->activity->count_by(array('status' => 1));
        } else {
            $this->notifications_size = $this->activity->count_by(array('id_organization' => $user_info['id_organization'], 'status' => 1));
        }
    }

    public function index() {
        redirect('login');
    }

    public function arm_kis() {
        $this->reestr(1);
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
        $total_rows = 0;
        $size_rows = 0;
        $limit_rows = $this->input->get('rows', true);
        if (!$limit_rows) {
            $limit_rows = 20;
        }
        $page = $this->input->get('page', true);
        if (!$page) {
            $page = 1;
        }
        $table_index = $this->input->get('type', true);
        if (!$table_index) {
            $table_index = 'all';
        }

        $authorities = $this->authority
                ->with('status')
                ->with('organization')
                ->with('properties')
                ->limit($limit_rows, ($limit_rows * ($page - 1)))
                ->get_all();

        $properties = $this->property->with('format')->order_by('order')->get_all();

        foreach ((array) $properties as $property) {
            $property['code'] = (isset($property['code'])) ? $property['code'] : $property['id_property'] . '_code';
            $column_names[] = $property['property_short_name'] == '' || is_null($property['property_short_name']) ? $property['property_name'] : $property['property_short_name'];
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
        $grid_data['all'] = array();
        $grid_data['in_process'] = array();
        $grid_data['in_working'] = array();
        $grid_data['new_authorities'] = array();
        foreach ((array) $authorities as $authority) {
            $values = array();

// create row values
            foreach ($column_models as $model) {
                $values[$model['name']] = '';
            }

// HACK: Executable status 
            $executable_status = 'new_authorities';
            switch ($authority['id_authority_status']) {
                case 3:
                    $executable_status = 'in_process';
                    break;
                default:
                    $executable_status = 'in_working';
                    break;
            }

// add athority properties to grid
            foreach ((array) $authority['properties'] as $p) {
                if (array_key_exists($p['id_property'], $properties_buff)) {
                    $values[$properties_buff[$p['id_property']]['code']] = $p['value'];
                }
                $values['id_authority'] = $authority['id_authority'];
                $values['id_authority_status'] = $authority['id_authority_status'];
            }
//add service properties to grid
            $this->load->model('service');
            $this->load->model('service_property');
            $values_buff = array();
            $temp_values = $values;
            $services = $this->service->get_many_by('id_authority', $authority['id_authority']);
            if (isset($services) AND count($services) > 0) {
                foreach ($services as $service) {
                    $values = $temp_values;
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
        
        
        if ($authority['is_new']=='t') {
                $executable_status = 'new_authorities';
                // add athority properties to grid
                foreach ((array) $authority['properties'] as $p) {
                    if (array_key_exists($p['id_property'], $properties_buff)) {
                        $values[$properties_buff[$p['id_property']]['code']] = $p['value'];
                    }
                    $values['id_authority'] = $authority['id_authority'];
                    $values['id_authority_status'] = $authority['id_authority_status'];
                }
//add service properties to grid

                $values_buff = array();
                $temp_values = $values;
                $services = $this->service->get_many_by('id_authority', $authority['id_authority']);
                if (isset($services) AND count($services) > 0) {
                    foreach ($services as $service) {
                        $values = $temp_values;
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
                        
                    }
                } else {
                    $grid_data[$executable_status][] = $values;
                    
                }
            }
}
// is ajax 
        if ($this->input->is_ajax_request()) {
            $response = array(
                'Rows' => $grid_data[$table_index],
                'Total' => 300,
                'Records' => 30,
                'Page' => $this->input->get('page', 1),
            );
            echo json_encode($response, true);
            exit(1);
        }

        $this->layout->view('arm_kis', array(
            'grid_data' => $grid_data,
            'column_models' => Zend_Json::encode($column_models, false, array('enableJsonExprFinder' => true)),
            'column_names' => json_encode($column_names),
            'authority_sizes' => $this->authority->get_sizes_by_status(),
                )
        );
    }

    public function uvedoml() {
        $data = array();
        $view = 'uvedoml_kis';
        $notifications = array();
// add to archive
        if ($this->input->is_post()) {
            $items = $this->input->post('selectedItems');
            $this->activity->update_many($items, array('status' => 2));
        }
        $id_organization = $this->session->userdata('id_organization');
        if ($this->session->userdata('user_type') == 2 || $this->session->userdata('user_type') == 3) {
            $notifications = $this->activity
                    ->order_by('time', 'DESC')
                    ->get_many_by(array('id_organization' => $id_organization, 'status' => 1));
            $archived_notifications = $this->activity
                    ->order_by('time', 'DESC')
                    ->get_many_by(array('id_organization' => $id_organization, 'status' => 2));
            $view = 'uvedoml_iogv';
        } else {
            $notifications = $this->activity
                    ->order_by('time', 'DESC')
                    ->get_many_by(array('status' => 1));
            $archived_notifications = $this->activity
                    ->order_by('time', 'DESC')
                    ->get_many_by(array('status' => 2));
        }
        $user = $this->session->userdata('user_name');

        foreach ((array) $notifications as $key => $notification) {
            $notifications[$key]['message'] = $this->activity->get_notification_message_by_event($notification['id_event_type']);
            $notifications[$key]['authority'] = $this->authority->get($notification['id_object']);
            $notifications[$key]['service'] = $this->service->get_by('id_authority', $notification['id_object']);
        }

        foreach ((array) $archived_notifications as $key => $notification) {
            $archived_notifications[$key]['message'] = $this->activity->get_notification_message_by_event($notification['id_event_type']);
            $archived_notifications[$key]['authority'] = $this->authority->get($notification['id_object']);
            $archived_notifications[$key]['service'] = $this->service->get_by('id_authority', $notification['id_object']);
        }

        $data['notifications'] = $notifications;
        $data['archived_notifications'] = $archived_notifications;
        $this->layout->view($view, $data);
    }

    public function journal() {
        $id_organization = $this->session->userdata('id_organization');
        if ($this->session->userdata('user_type') == 2 || $this->session->userdata('user_type') == 3) {
            $history_logs = $this->history_log
                    ->order_by('time', 'DESC')
                    ->get_many_by(array('id_organization' => $id_organization));
        } else {
            $history_logs = $this->history_log
                    ->order_by('time', 'DESC')
                    ->get_all();
        }
        $logs_num = 0;
        foreach ($history_logs as $history_log) {
            $data['history_logs'][$logs_num]['new'] = $history_log['new'];
            $data['history_logs'][$logs_num]['old'] = $history_log['old'];
            $date_time = date_parse_from_format("Y.m.d H:i:s", $history_log['time']);
            $data['history_logs'][$logs_num]['time'] = $date_time['day'] . '/' . $date_time['month'] . '/' . $date_time['year'] . ' ' . $date_time['hour'] . ':' . $date_time['minute'] . ':' . $date_time['second'];
            $property = $this->property->get($history_log['id_property']);
            $data['history_logs'][$logs_num]['property_name'] = (isset($property['property_name'])) ? $property['property_name'] : "Отсутствует";
            $data['history_logs'][$logs_num]['id_property'] = $history_log['id_property'];
            $user = $this->user->get($history_log['id_user']);
            $data['history_logs'][$logs_num]['user_name'] = $user['user_name'];
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

    private function reestr($user_type = 0) {
        if ($this->session->userdata('user_type') == 1 && $user_type == 1) {
            return;
        } elseif ($this->session->userdata('user_type') > 1 && $user_type == 2) {
            return;
        } else {
            switch ($this->session->userdata('user_type')) {
                case 1:
                    redirect('/structure/arm_kis');
                    break;
                default :
                    redirect('/structure/arm_iogv/');
                    break;
            }
        }
    }

    public function arm_iogv() {
        // load libs
        //if($this->input->is_ajax_request())return;
        $this->reestr(2);
        $this->load->library('zend');
        $this->zend->load('Zend/Json');
        $this->zend->load('Zend/Json/Encoder');
        $this->zend->load('Zend/Json/Decoder');
        $this->zend->load('Zend/Json/Exception');
        $this->zend->load('Zend/Json/Expr');
        $this->load->model('service');
        $this->load->model('service_property');

        $id_organization = $this->session->userdata('id_organization');
        $grid_data = array();
        $column_names = array();
        $column_models = array();
        $properties = array();
        $authority_properties_codes = array();
        $total_rows = 0;
        $size_rows = 0;
        $limit_rows = $this->input->get('rows', true);




        if (!$limit_rows) {
            $limit_rows = 20;
        }
        $page = $this->input->get('page', true);
        if (!$page) {
            $page = 1;
        }
        $table_index = $this->input->get('type', true);
        if (!$table_index) {
            $table_index = 'all';
        }
        if ($this->session->userdata('user_type') == 2 || $this->session->userdata('user_type') == 3) {
            $authorities = $this->authority
                    ->with('status')
                    ->with('organization')
                    ->with('properties')
                    ->limit($limit_rows, ($limit_rows * ($page - 1)))
                    ->get_many_by(array('id_organization' => $id_organization));
        } else {
            $authorities = $this->authority
                    ->with('status')
                    ->with('organization')
                    ->with('properties')
                    ->limit($limit_rows, ($limit_rows * ($page - 1)))
                    ->get_all();
        }
        $properties = $this->property->with('format')->order_by('order')->get_all();

        foreach ((array) $properties as $property) {
            $property['code'] = (isset($property['code'])) ? $property['code'] : $property['id_property'] . '_code';
            $column_names[] = $property['property_short_name'] == '' || is_null($property['property_short_name']) ? $property['property_name'] : $property['property_short_name'];
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
        $grid_data['all'] = array();
        $grid_data['in_process'] = array();
        $grid_data['in_working'] = array();
        $grid_data['new_authorities'] = array();
        foreach ((array) $authorities as $authority) {
            $values = array();

// create row values
            foreach ($column_models as $model) {
                $values[$model['name']] = '';
            }

// HACK: Executable status 
            $executable_status = 'new_authorities';
            switch ($authority['id_authority_status']) {
                case 3:
                    $executable_status = 'in_process';
                    break;
                default:
                    $executable_status = 'in_working';
                    break;
            }

// add athority properties to grid
            foreach ((array) $authority['properties'] as $p) {
                if (array_key_exists($p['id_property'], $properties_buff)) {
                    $values[$properties_buff[$p['id_property']]['code']] = $p['value'];
                }
                $values['id_authority'] = $authority['id_authority'];
                $values['id_authority_status'] = $authority['id_authority_status'];
            }
//add service properties to grid

            $values_buff = array();
            $temp_values = $values;
            $services = $this->service->get_many_by('id_authority', $authority['id_authority']);
            if (isset($services) AND count($services) > 0) {
                foreach ($services as $service) {
                    $values = $temp_values;
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

            if ($authority['is_new']=='t') {
                $executable_status = 'new_authorities';
                // add athority properties to grid
                foreach ((array) $authority['properties'] as $p) {
                    if (array_key_exists($p['id_property'], $properties_buff)) {
                        $values[$properties_buff[$p['id_property']]['code']] = $p['value'];
                    }
                    $values['id_authority'] = $authority['id_authority'];
                    $values['id_authority_status'] = $authority['id_authority_status'];
                }
//add service properties to grid

                $values_buff = array();
                $temp_values = $values;
                $services = $this->service->get_many_by('id_authority', $authority['id_authority']);
                if (isset($services) AND count($services) > 0) {
                    foreach ($services as $service) {
                        $values = $temp_values;
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
                        
                    }
                } else {
                    $grid_data[$executable_status][] = $values;
                   
                }
            }
        }

// is ajax 
        if ($this->input->is_ajax_request()) {
            $response = array(
                'Rows' => $grid_data[$table_index],
                'Total' => 300,
                'Records' => 30,
                'Page' => $this->input->get('page', 1),
            );
            echo json_encode($response, true);
            exit(1);
        }

        $this->layout->view('arm_iogv', array(
            'grid_data' => $grid_data,
            'column_models' => Zend_Json::encode($column_models, false, array('enableJsonExprFinder' => true)),
            'column_names' => json_encode($column_names),
            'authority_sizes' => $this->authority->get_sizes_by_status($this->session->userdata('id_organization'))
                )
        );
    }

}
