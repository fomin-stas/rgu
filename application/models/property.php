<?php

class Property extends APP_Model {

    public $_table = 'property';
    public $primary_key = 'id_property';
    public $belongs_to = array(
        'format' => array(
            'model' => 'property_format_model',
            'primary_key' => 'id_property_type'),
    );
    protected $return_type = 'array';

    public function get_kis_number() {
        $query = $this->db->query("SELECT code FROM property WHERE code LIKE 'kis_%'");
        $row_count = $query->num_rows();
        $kis = $query->row_array($row_count - 1);
        $kis_num = explode("_", $kis['code']);
        return $kis_num[1] + 1;
    }

    public function serch_values_by_code($text, $code) {
        $result = array();
        $property = $this->get_by(array("code" => $code));
        $from = $property['id_service_type'] != 6 ? "service_property" : 'authority_property ';
        $sql = "SELECT value FROM property pr," . $from . " sr where pr.code='" . $code . "' AND pr.id_property=sr.id_property AND lower(sr.value) LIKE lower('%" . $text . "%') GROUP BY value";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                if ($property['id_service_type'] == 6) {
                    if ($row->value != '') {
                        $result[] = strip_tags($row->value);
                    }
                } else {
                    if ($row->value != '') {
                        $values = explode(";", $row->value);
                        foreach ($values as $value) {
                            $result[] = $value;
                        }
                    }
                }
            }
        }
        return $result;
    }

    public function iogv_property() {
        $return_array = array();
        $sql = "SELECT * FROM property WHERE options NOT LIKE '%\"property_iogv_displayed\":false%'  ORDER BY \"order\"";
        $query = $this->db->query($sql);
        foreach ($query->result_array() as $key => $value) {
            $sql = "SELECT * FROM property_format WHERE id_property_format=" . $value['id_property_type'];
            $format = $this->db->query($sql);
            $value['format'] = $format->row_array();
            $return_array[] = $value;
        }
        return $return_array;
    }

    public function get_all_id_name_property() {
        $return_array = array('' => '');
        $sql = "SELECT id_property,property_name FROM property";
        $query = $this->db->query($sql);
        foreach ($query->result_array() as $row) {
            $return_array[$row['id_property']] = $row['property_name'];
        }
        return $return_array;
    }

    public function get_all_property_with_values() {
        $return_array = array('' => '');
        $sql = "SELECT distinct pr.id_property,pr.property_name FROM property pr, property_values pv where pr.id_property=pv.property_id";
        $query = $this->db->query($sql);
        foreach ($query->result_array() as $row) {
            $return_array[$row['id_property']] = $row['property_name'];
        }
        return $return_array;
    }

}
