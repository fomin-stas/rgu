<?php

class Property extends APP_Model { 
	public $_table = 'property';
	public $primary_key = 'id_property';
	public $belongs_to = array(
	 'format' => array(
	 	'model' => 'property_format_model', 
	 	'primary_key' => 'id_property_type' ),
	 );
	protected $return_type = 'array';
}