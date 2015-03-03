<?php

class Property_comments extends APP_Model {

    public $_table = 'property_comments';
    public $primary_key = 'id_property_comment';
    protected $return_type = 'array';

    public function insert_comment($id_service_property, $comment) {
        $comments['comment'] = $comment;
        $comments['id_service_property'] = $id_service_property;
        $comments['user'] = $this->session->userdata('user_name');
        $datestring = "%Y-%m-%d %h:%i:%a";
        $time = time();
        $comments['date_comment'] = mdate($datestring, $time);
        $this->property_comments->insert($comments);
    }

    public function get_count_comments($id_service_property) {
        $user = $this->user->get($this->session->userdata('id'));
        $sql = "SELECT * FROM property_comments where id_service_property=" . $id_service_property . " AND property_comments.\"user\" !='" . $user['user_name'] . "' AND is_read = false";
        $query = $this->db->query($sql);
        $comments['not'] = $query->num_rows();

        $sql = "SELECT * FROM property_comments where id_service_property=" . $id_service_property;
        $query = $this->db->query($sql);
        $comments['all'] = $query->num_rows();
        return $comments;
    }

    public function update_is_read($id_service_property) {
        $user = $this->user->get($this->session->userdata('id'));
        $sql = "UPDATE property_comments SET is_read=true where id_service_property=" . $id_service_property . " AND property_comments.\"user\" !='" . $user['user_name'] . "' AND is_read = false";
        $this->db->query($sql);
    }

}
