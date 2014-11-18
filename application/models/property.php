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
    
    public function serch_values_by_code($text, $code){
        $result=array();
        $property=$this->get_by(array("code"=>$code));
        $from= $property['id_service_type']!=6?"service_property":'authority_property ';
        $sql="SELECT value FROM property pr,".$from." sr where pr.code='".$code."' AND pr.id_property=sr.id_property AND sr.value LIKE '%".$text."%' GROUP BY value";
        $query = $this->db->query($sql);
        if ($query->num_rows()>0){
            foreach ($query->result() as $row){
                $result[]=$row->value;
            }
        }
        return $result;
    }
}
