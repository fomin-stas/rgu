<?php

class Authority extends APP_Model { 
	public $_table = 'authority';
	public $primary_key = 'id_authority';
	protected $return_type = 'array';
	public $belongs_to = array(
	 'status' => array(
	 	'model' => 'authority_status_model', 
	 	'primary_key' => 'id_authority_status' ),
	 'organization' => array(
	 	'model' => 'organization_model', 
	 	'primary_key' => 'id_organization' ),
	 );

	public $has_many = array( 
		'properties' => array(
			'model' => 'authority_property_model',
			'primary_key' => 'id_authority',
                        'order_by' => 'code'), 
		);

	public function get_sizes_by_status() {
		$result['all'] = $this->count_all();
        $result['in_process'] = $this->count_by('id_authority_status', 4);
        $result['in_working'] = $this->count_by('id_authority_status', 1);
        $result['new_authorities'] = $this->count_by('id_authority_status', array(2,3));
        return $result;
	}
}
