<?php

class Organization_model extends APP_Model { 
	public $_table = 'organization';
	public $primary_key = 'id_organization';
        protected $return_type = 'array';
        protected $return_insert_id=false;
}