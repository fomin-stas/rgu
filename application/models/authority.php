<?php

class Authority extends APP_Model { 
	public $_table = 'authority';
        public $primary_key = 'id_authority';
	public $belongs_to = array(
	 'status' => array(
	 	'model' => 'authority_status_model', 
	 	'primary_key' => 'id_authority_status' ),
	 'organization' => array(
	 	'model' => 'organization_model', 
	 	'primary_key' => 'id_organization' ),
	 );
}