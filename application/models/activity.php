<?php

class Activity extends APP_Model { 
	public $_table = 'activity_feed';
	public $primary_key = 'id_activity';
	protected $return_type = 'array';

	public function add_notification($event_name, $id_service_type, $id_organization, $id_object = null, $message = null, $skip_validation = false){
		$event = null;
		$data = array();
		if ($skip_validation === FALSE) {
            $data = $this->validate($data);
        }
        if (isset($event_name, $id_service_type, $id_organization)) {
        	if(is_string($event_name)) {
        		$this->load->model('event_type');
        		$event = $this->event_type->as_array()->get_by('event_type_name', $event_name);
        	}
        	if($event) {
        		$datestring = "%Y-%m-%d %h:%i:%a";
		        $time = time();
		        $data['time'] = mdate($datestring, $time);
        		$data['id_event_type'] = $event['id_event_type'];
        		$data['id_organization'] = $id_organization;
        		$data['id_service_type'] = $id_service_type;
        		$data['id_object'] = $id_object;
	            $insert_id = $this->insert($data);
	            return $insert_id;
        	}
        } else {
            return FALSE;
        }
	}
}