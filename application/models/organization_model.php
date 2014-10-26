<?php

class Organization_model extends APP_Model { 
	public $_table = 'organization';
	public $primary_key = 'id_organization';
        protected $return_type = 'array';
        protected $return_insert_id=false;
        public function dropdown_ROIV($args){
            $this->_set_where(array('id_organization_rank'=>1));
            return $this->dropdown($args);
        }
}