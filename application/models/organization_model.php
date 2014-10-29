<?php

class Organization_model extends APP_Model { 
	public $_table = 'organization';
	public $primary_key = 'id_organization';
        protected $return_type = 'array';
        protected $return_insert_id=false;
        public function dropdown_ROIV($args){
            $result=$this->order_by('organization_name')->get_many_by(array('id_organization_rank'=>1));
            $data[0]='Не выбрано';
            foreach($result as $key => $value){
                $data[$value['id_organization']]=$value['organization_name'];
            }
            return $data;
        }
}