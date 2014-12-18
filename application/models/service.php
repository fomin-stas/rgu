<?php

class Service extends APP_Model { 
	public $_table = 'service';
	public $primary_key = 'id_service';
	protected $return_type = 'array';
Public function get_services_by_authorities($authorities){
    If(!is_array($authorities)){
        $where='id_authority = '.$authorities;
    }
}
}