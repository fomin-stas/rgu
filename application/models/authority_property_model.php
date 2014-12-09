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

    public function get_authority_property_by_code($id_authority, $code) {
        $property = $this->property->get_by('code', $code);
        return $this->get_by(array('id_authority' => $id_authority, 'id_property' => $property['id_property']));
    }

    public function add_authority_property($authority_id, $authority_properties,$organization) {
        $authority_property['id_property'] = 18;
        $authority_property['value'] = 'Отраслевой орган';
        $authority_property['id_authority'] = $authority_id;
        $this->insert($authority_property);
        $authority_property['id_property'] = 8;
        $authority_property['value'] = 'на согласовании';
        $authority_property['id_authority'] = $authority_id;
        $this->insert($authority_property);
        foreach ($authority_properties as $key => $value) {
            $authority_property['id_property'] = $value['property_id'];
            $authority_property['id_authority'] = $authority_id;
            if ($authority_property['id_property'] == 13) {
                $authority_property['value'] = '<a href=agreeds/check_status_authority/' . $authority_property['id_authority'] . '/0/1>' . $value['value'] . '</a>';
            } elseif ($authority_property['id_property'] == 7) {

                $authority_property['value'] = $value['value'];
                $this->insert($authority_property);
                $authority_property['id_property'] = 11;
                $authority_property['value'] = '<a href=agreeds/check_status_authority/' . $authority_property['id_authority'] . '/0/1>' . $authority_id . '-' . $value['value'] . ' ' . rand(1, 99) . '</a>';
            } else {
                $authority_property['value'] = $value['value'];
            }
            $this->insert($authority_property);
        }
        $custom_authority_id_property = $this->property->get_by('property_name', 'id полномочия');
        if (NULL != $custom_authority_id_property) {
            $authority_property['id_property'] = $custom_authority_id_property['id_property'];
            $authority_property['id_authority'] = $authority_id;
            $authority_property['value'] = $this->generate_authority_custom_id($authority_id,$authority_properties[7]['value'],$organization['id_organization']);
            $this->insert($authority_property);
        }
    }
    
    private function generate_authority_custom_id($authority_id,$punkt,$id_organization) {
        return $id_organization . '.' . isset($punkt)?$punkt:'' . $authority_id;
    }

}
