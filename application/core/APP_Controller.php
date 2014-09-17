<?php

class  APP_Controller  extends  CI_Controller  {

    function __construct ()  {
        parent::__construct();

        // set layout dir by current controller
        $this->layout->setViewDir($this->router->fetch_class());
        $this->notifications_size = $this->activity->count_all();
    }

    public function is_loggedIn()
    {
    	if(FALSE == $this->session->userdata('loggedin')) {
            $this->session->set_flashdata('message', 'Вам необходимо авторизоваться!');
            redirect('site/login');
        }
    }
}