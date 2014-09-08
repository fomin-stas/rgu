<?php

class History_log extends APP_Model {

    public $_table = 'history_log';
    public $primary_key = 'id_history_log';
    protected $return_type = 'array';

    public function insert_log($history_log) {
        $history_log['id_user'] = $this->session->userdata('id');
        $datestring = "%Y-%m-%d %h:%i:%a";
        $time = time();
        $history_log['time'] = mdate($datestring, $time);
        $this->insert($history_log);
    }

}
