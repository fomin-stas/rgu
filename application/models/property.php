<?php

class Property extends APP_Model {

    public $_table      = 'property';
    public $primary_key = 'id_property';
    public $belongs_to  = array(
        'format' => array(
            'model'         => 'property_format_model',
            'primary_key'   => 'id_property_type'),
    );
    protected $return_type = 'array';
    public function get_kis_number() {
        $query      = $this->db->query("SELECT code FROM property WHERE code LIKE 'kis_%'");
        $row_count  = $query->num_rows();
        $kis        = $query->row_array($row_count-1);
        $kis_num    = explode("_", $kis['code']);
        return $kis_num[1] + 1;
    }
}
