<?php

class Property_values_model extends APP_Model {

    public $_table = 'property_values';
    public $primary_key = 'property_value_id';
    protected $return_type = 'array';

    public function get_property_values($id_property) {
        $return_array=array('' => '');
        $values = $this->get_many_by(array('property_id' => $id_property));
        foreach ($values as $key => $value){
            $return_array[$value['property_value_id']] = $value['value'];
        }
        return $return_array;
    }

}
