<?php

class User extends APP_Model { 
	public $_table = 'users';
        public $primary_key = 'id_user';
        protected $return_insert_id=false;
        protected $return_type = 'array';
}