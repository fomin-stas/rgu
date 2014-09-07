<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Comments extends APP_Controller {

    function __construct() {
        parent::__construct();
        $this->is_loggedIn();
    }

    public function view($id_authority) {
        $this->comment->order_by('time', 'DESC');
        $comments = $this->comment->get_many_by('id_authority', $id_authority);
        foreach ($comments as $value) {
            $user = $this->user->get($value['id_user']);
            $date_time = date_parse_from_format("Y.m.d H:i:s", $value['time']);
            $comments_data[$date_time['day'] . '-' . $date_time['month'] . '-' . $date_time['year']] [] = array('time' => $date_time['hour'] . ':' . $date_time['minute'] . ':' . $date_time['second'],
                'message' => $value['message'],
                'user_name' => $user->user_name);
        }
        $data['comments_data'] = $comments_data;
        $this->layout->view('timeline', $data);
    }

    public function view_only_timeline($id_authority) {
        $this->comment->order_by('time', 'DESC');
        $comments = $this->comment->get_many_by('id_authority', $id_authority);
        foreach ($comments as $value) {
            $user = $this->user->get($value['id_user']);
            $date_time = date_parse_from_format("Y.m.d H:i:s", $value['time']);
            $comments_data[$date_time['day'] . '-' . $date_time['month'] . '-' . $date_time['year']] [] = array('time' => $date_time['hour'] . ':' . $date_time['minute'] . ':' . $date_time['second'],
                'message' => $value['message'],
                'user_name' => $user->user_name);
        }
        if (isset($comments_data)) {
            $data['comments_data'] = $comments_data;
            echo $this->load->view('comments/timeline', $data);
        }
        else{
            echo 'Комментариев нет';
        }
    }
}
