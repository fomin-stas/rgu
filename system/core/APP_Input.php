<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class APP_Input extends CI_Input
{

    function __construct() {
        parent::__construct();
    }

    // check POST request
    function is_post() {
        return $this->server('REQUEST_METHOD') == 'POST';
    }
    
    // check GET request    
    function is_get() {
        return $this->server('REQUEST_METHOD') == 'GET';
    }    
} 