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
    
    public function get_key_id_all(){
        $ret = array();
        $ap=$this->get_all();
        foreach ($ap as $value){
            $ret[$value['id_additional_property']]=array('additional_property_name' => $value['additional_property_name'], 'id_property_format' => $value['id_property_format']);
        }
        return $ret;
    }

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

    public function generate_tree_structure($id_property,$data_additional) {
        $data = array();
        $content = array();
        $paps = $this->pap->get_many_by('id_property', $id_property);
        foreach ($paps as $key => $pap) {
            $children = $this->pap->children($pap);
            $additional_property = $this->get($pap['id_additional_property']);
            if (count($children) > 0) {
                $chiled = $this->tree_childrens($children,$data_additional);
                $content = $content + $chiled['content'];
                $data['additional_' . $pap['id_additional_property']] = array('name' => '<span class="tree_span" data-id="' . $data_additional['type'].'_'.$data_additional['service_num'].'_content_'.$pap['id_additional_property'] . '">' . $additional_property['additional_property_name'] . '</span>', "type" => "folder", "additionalParameters" => $chiled['additionalParameters']);
                $content[$pap['id_additional_property']] = $additional_property['id_property_format'];
            } else {
                $data['additional_' . $pap['id_additional_property']] = array('name' => '<span class="tree_span" data-id="' . $data_additional['type'].'_'.$data_additional['service_num'].'_content_'.$pap['id_additional_property'] . '">' . $additional_property['additional_property_name'] . '</span>', "type" => "item");
                $content[$pap['id_additional_property']] = $additional_property['id_property_format'];
            }
        }
        $ret['tree']=json_encode($data);
        $ret['content']=$content;
        return $ret;
    }

    private function tree_childrens($paps,$data_additional) {
        $data = array();
        $content = array();
        foreach ($paps as $key => $pap) {
            $children = $this->pap->children($pap);
            $additional_property = $this->get($pap['id_additional_property']);
            if (count($children) > 0) {
                $chiled = $this->tree_childrens($children,$data_additional);
                $content = $content + $chiled['content'];
                $data['children']['additional_' . $pap['id_additional_property']] = array('name' => '<span class="tree_span" data-id="' . $data_additional['type'].'_'.$data_additional['service_num'].'_content_'.$pap['id_additional_property'] . '">' . $additional_property['additional_property_name'] . '</span>', "type" => "folder", "additionalParameters" => $chiled['additionalParameters']);
                $content[$pap['id_additional_property']] = $additional_property['id_property_format'];
            } else {
                $data['children']['additional_' . $pap['id_additional_property']] = array('name' => '<span class="tree_span" data-id="' . $data_additional['type'].'_'.$data_additional['service_num'].'_content_'.$pap['id_additional_property'] . '">' . $additional_property['additional_property_name'] . '</span>', "type" => "item");
                $content[$pap['id_additional_property']] = $additional_property['id_property_format'];
            }
        }
        $ret['content'] = $content;
        $ret['additionalParameters'] = $data;
        return $ret;
    }

}
