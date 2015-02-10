<?php

class Submit_property extends CI_Model {

    protected $services = array();
    protected $id_authority;
    protected $data = array();
    protected $submit_files = array();

    function __construct() {
        parent::__construct();

        $this->data = $_POST;
        if(count($this->data)== 0) {
            return;
        }
        $this->id_authority = $this->data['id_authority'];
        $this->step_files_insert($this->id_authority);

        $this->services = $this->parsing_new_services($this->data);
        $this->submit_files = $_FILES;
        $files = $this->parsing_new_services($this->submit_files, true);
        if ($files != 0) {
            foreach ($files as $key => $value) {
                $this->services[$key] = $this->services[$key] + $value;
            }
        }
    }

    public function get_services() {
        return $this->services;
    }

    public function get_id_authority() {
        return $this->id_authority;
    }

    public function get_submit_data() {
        return $this->data;
    }

    public function get_submit_files() {
        return $this->submit_files;
    }

    public function insert_new_services() {
        foreach ($this->services as $name => $property) {
            $property['agreed'] = 2;
            $service['id_authority'] = $this->id_authority;
            $propertis_name = explode("_", $name);
            $service['service_name'] = $property[$propertis_name[0] . '_0'];
            $service["service_status"] = "на согласовании";
            switch (substr($name, 0, 2)) {
                case 'sr':
                    $service['id_service_type'] = 7;
                    $property['service_type'] = "услуга";
                    break;
                case 'sn':
                    $service['id_service_type'] = 8;
                    $property['service_type'] = "функция";

                    break;
                case 'sk':
                    $service['id_service_type'] = 9;
                    $property['service_type'] = "функция контроля и надзора";
                    break;
            }
            /*$this->load->model('service');
            $this->load->model('service_property');*/
            $id_service = $this->service->insert($service);
            $this->service_property->_id_service = $id_service;
            $this->service_property->insert_where_code_many($property);
        }
        
    }

    public function update_services() {
        foreach ($this->data as $key => $value) {
            $name = explode("_", $key);
            if (!(int) $name[0]) {
                continue;
            }
            $update_data = array('id_service' => $name[1], 'id_property' => $name[0]);
            $service_property = $this->service_property->get_by($update_data);
            if ($service_property['value'] != $value) {
                $update = array('value' => $value);
                $this->service_property->update_by($update_data, $update);
                $history_log['new'] = $value;
                $history_log['old'] = $service_property['value'];
                $history_log['id_property'] = $service_property['id_property'];
                $this->history_log->insert_log($history_log);
            }
        }

        foreach ($this->submit_files as $key => $value) {
            $name = explode("_", $key);
            if (!(int) $name[1] || !(int) $name[0])
                continue;
            $value = $this->file_insert(0, $key, true);
            $update_data = array('id_service' => $name[1], 'id_property' => $name[0]);
            $service_property = $this->service_property->get_by($update_data);
            if ($service_property['value'] != $value) {
                $update = array('value' => $value);
                $this->service_property->update_by($update_data, $update);
                $history_log['new'] = $value;
                $history_log['old'] = $service_property['value'];
                $history_log['id_property'] = $service_property['id_property'];
                $this->history_log->insert_log($history_log);
            }
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

    public function parsing_new_services($data, $is_file = false) {
        foreach ($data as $name => $value) {
            $is_new = explode("_", $name);
            if ((int) $is_new[0]) {
                continue;
            }
            if ($name{3} == '_') {
                $service_num = $name{2};
                if (strlen($name) == 5)
                    $property_num = $name{4};
                else
                    $property_num = substr($name, 4, 2);
            }
            else {
                if (strlen($name) == 6) {
                    $service_num = $name{5};
                    $property_num = $name{3};
                } else {
                    $service_num = $name{6};
                    $property_num = substr($name, 3, 2);
                }
            }
            switch (substr($name, 0, 2)) {
                case 'sr':
                    $services['sr_' . $service_num]['sr_' . $property_num] = $is_file ? $this->file_insert(0, $name, true) : $value;
                    break;
                case 'sn':
                    $services['sn_' . $service_num]['sn_' . $property_num] = $is_file ? $this->file_insert(0, $name, true) : $value;
                    break;
                case 'sk':
                    $services['sk_' . $service_num]['sk_' . $property_num] = $is_file ? $this->file_insert(0, $name, true) : $value;
                    break;
            }
        }
        return isset($services) ? $services : 0;
    }

}

