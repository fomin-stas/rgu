<?php

class Activity extends APP_Model { 
	public $_table = 'activity_feed';
	public $primary_key = 'id_activity_feed';
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

    public function get_notification_message_by_event($event_id) {
        $result = array('text' => '', 'color' => 'green');
        switch ($event_id) {
            case 7:
                $result['text'] = 'Новое полномочие';
                $result['color'] = 'green';
                break;
            case 8:
                $result['text'] = 'Полномочие изменено';
                $result['color'] = 'gray';
                break;
            case 9:
                $result['text'] = 'Превышено время ответа';
                $result['color'] = 'red';
                break;
            default:
                break;
        }
        return $result;
    }
}