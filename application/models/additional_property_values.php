<?php

class Additional_property_values extends APP_Model {

    public $_table = 'additional_property_values';
    public $primary_key = 'id_additional_property_values';
    protected $return_type = 'array';
    
    //******************************************
    // @update_values($id_additional_property, $values)
    // Обновление списка значений дополнительного своества, если его тип "Список"
    public function update_values($id_additional_property, $values){
        $addition = $this->get_many_by(array('id_additional_property'  => $id_additional_property));
        $addition_values = array();
        foreach($addition as $value){
            $addition_values[]=$value['value'];
        }
        $for_deleting = array_diff($addition_values,$values);
        foreach($for_deleting as $key => $value){
            $get_by = array(
              'id_additional_property'  => $id_additional_property,
              'value' => $value
            );
            $result = $this->delete_by($get_by);
        }
        foreach($values as $key => $value){
            $get_by = array(
              'id_additional_property'  => $id_additional_property,
              'value' => $value
            );
            $result = $this->get_by($get_by);
            if (count($result) == 0 || is_null($result)){
                $this->insert($get_by);
            }
        }
    }

}
