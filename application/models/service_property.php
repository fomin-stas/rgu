<?php

class Service_property extends APP_Model {

    public $_table = 'service_property';
    public $primary_key = 'id_service_property';
    protected $return_type = 'array';
    public $_id_service = '';
    public $_agreed=2;

    public function insert_where_code($data, $skip_validation = FALSE) {
        if ($skip_validation === FALSE) {
            $data = $this->validate($data);
        }
        $data['agreed']= !isset($data['agreed'])?$this->_agreed:$data['agreed'];
        if ($data !== FALSE) {
            $sql = 'INSERT INTO ' . $this->_table . '(id_service, id_property, value, agreed) SELECT ?,id_property,?,? FROM property WHERE code=?';
            $query = $this->db->query($sql, array($this->_id_service, $data['value'],$data['agreed'], $data['code']));
            $insert_id = $this->_database->insert_id();
            return $insert_id;
        } else {
            return FALSE;
        }
    }

    public function insert_where_code_many($data, $skip_validation = FALSE) {
        if ($skip_validation === FALSE) {
            $data = $this->validate($data);
        }
        if ($data !== FALSE) {
            foreach ($data as $insert_data['code'] => $insert_data['value']) {
                $this->insert_where_code($insert_data);
            }
        } else {
            return FALSE;
        }
    }
    
     public function update_where_code($data, $skip_validation = FALSE) {
        if ($skip_validation === FALSE) {
            $data = $this->validate($data);
        }
        if ($data !== FALSE) {
            $sql = 'UPDATE ' . $this->_table . 'SET value=? where id_property=? and id_service=?';
            $query = $this->db->query($sql, array($data['value'], $data['code'],$this->_id_service));
            return $query;
        } else {
            return FALSE;
        }
    }
    
    public function update_where_code_many($data, $skip_validation = FALSE) {
        if ($skip_validation === FALSE) {
            $data = $this->validate($data);
        }
        if ($data !== FALSE) {
            foreach ($data as $insert_data['code'] => $insert_data['value']) {
                $this->update_where_code($insert_data);
            }
        } else {
            return FALSE;
        }
    }

}
