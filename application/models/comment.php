<?php

class Comment extends APP_Model {
    public $_table = 'comment';
    public $primary_key = 'id_comment';
    protected $return_type = 'array';

    public function insert_comment($id_authority, $message) {
        $comments['message'] = $message;
        $comments['id_authority'] = $id_authority;
        $comments['id_user'] = $this->session->userdata('id');
        $datestring = "%Y-%m-%d %h:%i:%a";
        $time = time();
        $comments['time'] = mdate($datestring, $time);
        $this->comment->insert($comments);
    }
}
