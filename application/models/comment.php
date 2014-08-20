<?php

class Comment extends APP_Model {

    public $_table = 'comment';
    public $primary_key = 'id_comment';

    public function set_comment($id_authority) {
        $comment['message'] = $this->input->post('comment');
        if ($comment['message']=='') return;
        $comment['id_authority']=$id_authority;
        $datestring = "%Y-%m-%d %h:%i:%a";
        $time = time();
        $comment['time'] = mdate($datestring, $time);
        $comment['id_organization'] =  $this->session->userdata('id_organization');
        $this->insert($comment);
    }

}
