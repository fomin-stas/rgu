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

    public function generate_tree_structure($id_property) {
        $data = array();
        $paps = $this->pap->get_many_by('id_property', $id_property);
        foreach ($paps as $key => $pap) {
            $children = $this->pap->children($pap);
            $additional_property = $this->get($pap['id_additional_property']);
            if (count($children) > 0) {
                $data['additional_' . $pap['id_additional_property']] = array('name' => '<div id="09">'.$additional_property['additional_property_name'].'</div>', "type" => "folder","additionalParameters" => $this->tree_childrens($children));
            } else {
                $data['additional_' . $pap['id_additional_property']] = array('name' => $additional_property['additional_property_name'], "type" => "item");
            }
        }
        return json_encode($data);
    }

    private function tree_childrens($paps) {
        $data = array();
        foreach ($paps as $key => $pap) {
            $children = $this->pap->children($pap);
            $additional_property = $this->get($pap['id_additional_property']);
            if (count($children) > 0) {
                $data['children']['additional_' . $pap['id_additional_property']] = array('name' => '<div id="09">'.$additional_property['additional_property_name'].'</div>', "type" => "folder","additionalParameters" => $this->tree_childrens($children));
            } else {
                $data['children']['additional_' . $pap['id_additional_property']] = array('name' => $additional_property['additional_property_name'], "type" => "item");
            }
        }
        return $data;
    }

}
