<?php

class Pap extends APP_Model {

    public $_table = 'pap';
    public $primary_key = 'id_pap';
    protected $return_type = 'array';

    public function children($pap) {
        $paps = array();
        $paps = $this->get_many_by('add_id_additional_property', $pap['id_additional_property']);
        if (count($paps) > 0) {
            return $paps;
        }
        $additional_property = $this->additional_property->get($pap['id_additional_property']);
        if (($additional_property['id_property_format'] == 3) || ($additional_property['id_property_format'] == 5)) {
            $this->load->model('additional_property_values');
            $values = $this->additional_property_values->get_many_by(array('id_additional_property' => $pap['id_additional_property']));
            foreach ($values as $value) {
                $paps = $this->get_many_by('id_additional_property_values', $value['id_additional_property_values']);
                if (count($paps) > 0) {
                    return $paps;
                }
            }
        }
        return array();
    }

}
