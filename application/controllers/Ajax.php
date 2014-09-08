<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Ajax extends APP_Controller {

    function  __construct()  {
        parent::__construct();
         
         $this->is_loggedIn();

        if(!$this->input->is_ajax_request()){
            exit('It\'s not ajax request');
        }
    }

    public function remove_property(){
        $result = array();
        $id = $this->input->post('id');   
        if(isset($id)) {
            $result['success'] = $this->property->delete($id);
        }

        echo json_encode($result);
    }

    public function get_property_by_id(){
        $result = array();
        $id = $this->input->post('id');   
        if(isset($id)) {
            $property = $this->property->get($id);
            if(isset($property)){
                //prepare options
                $property['options'] = json_decode($property['options'], true);

                $result['success'] = true;
                $result['property'] = $property;
            }
        }
        echo json_encode($result);
    }
    
    public function edite_property(){
        $data=$_POST;
    }
    
    
}
