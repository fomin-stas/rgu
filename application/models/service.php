<?php

class Service extends APP_Model { 
	public $_table = 'service';
	public $primary_key = 'id_service';
	protected $return_type = 'array';
	public function get_cont_service_by_authorities($authorities){
            $where="";
            $is_first=true;
            if(!is_array($authorities)){
                $where=" id_authority = ".$authorities;
            }else{
                foreach ($authorities as $value){
                	if(!$is_first){
	                    $where=$where . " or  id_authority = " . $value;
	                }else{
	                	$where=$where . " id_authority = " . $value;
	                	$is_first=false;
	                }
                }
            }
            return $this->db->query("SELECT COUNT(*) FROM service where " . $where)->row()->count;
	}
        
        public function get_count_services_by_authority($id_authority){
            return $this->db->query("SELECT COUNT(*) FROM service where id_authority=".$id_authority)->row()->count;
        }
}