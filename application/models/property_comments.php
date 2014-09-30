<?php

class Property_comments extends APP_Model {
    public $_table = 'property_comments';
    public $primary_key = 'id_property_comment';
    protected $return_type = 'array';

    public function insert_comment($id_service_property, $comment) {
        $comments['comment'] = $comment;
        $comments['id_service_property'] = $id_service_property;
        $comments['id_user'] = $this->session->userdata('id');
        $datestring = "%Y-%m-%d %h:%i:%a";
        $time = time();
        $comments['date_comment'] = mdate($datestring, $time);
        $this->property_comments->insert($comments);
    }
}
