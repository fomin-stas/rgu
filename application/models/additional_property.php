<?php

class Additional_property extends APP_Model {

    public $_table = 'additional_property';
    public $primary_key = 'id_additional_property';
    public $belongs_to = array(
        'format' => array(
            'model' => 'property_format_model',
            'primary_key' => 'id_property_format'),
    );
    protected $return_type = 'array';

    public function get_all_id_name_additional_property() {
        $return_array = array('' => '');
        $sql = "SELECT id_additional_property,additional_property_name FROM additional_property";
        $query = $this->db->query($sql);
        foreach ($query->result_array() as $row) {
            $return_array[$row['id_additional_property']] = $row['additional_property_name'];
        }
        return $return_array;
    }

    public function get_all_additional_property_with_values() {
        $return_array = array('' => '');
        $sql = "SELECT distinct pr.id_additional_property,pr.additional_property_name FROM additional_property pr, additional_property_values pv where pr.id_additional_property=pv.id_additional_property";
        $query = $this->db->query($sql);
        foreach ($query->result_array() as $row) {
            $return_array[$row['id_additional_property']] = $row['additional_property_name'];
        }
        return $return_array;
    }

}
