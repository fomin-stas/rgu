<?php

class Authority_property_model extends APP_Model {

    public $_table = 'authority_property';
    public $primary_key = 'id_authority_property';
    protected $return_type = 'array';
    public $_id_authority = 0;
    public function insert_where_code($data, $skip_validation = FALSE) {
        if ($skip_validation === FALSE) {
            $data = $this->validate($data);
        }
        if ($data !== FALSE) {
            $sql = "INSERT INTO " . $this->_table . "(id_authority, id_property, value) SELECT ?,id_property,? FROM property WHERE code=?";
            $query = $this->db->query($sql, array($this->_id_authority, $data['value'], $data['code']));
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
    
    public function get_authority_property_by_code($id_authority,$code){
        $property=$this->property->get_by('code',$code);
        return $this->authority_property_model->get_by(array('id_authority'=>$id_authority,'id_property'=>$property['id_property']));        
    }
}
