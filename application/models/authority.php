<?php

class Authority extends APP_Model {

    public $_table = 'authority';
    public $primary_key = 'id_authority';
    protected $return_type = 'array';
    public $belongs_to = array(
        'status' => array(
            'model' => 'authority_status_model',
            'primary_key' => 'id_authority_status'),
        'organization' => array(
            'model' => 'organization_model',
            'primary_key' => 'id_organization'),
    );
    public $has_many = array(
        'properties' => array(
            'model' => 'authority_property_model',
            'primary_key' => 'id_authority',
            'order_by' => 'code'),
    );

    public function get_sizes_by_status($id_organization = 0) {

            $result['all'] = $id_organization==0?$this->count_all():$this->count_by('id_organization',$id_organization);
            $result['in_process'] = $id_organization==0?$this->count_by(array('id_authority_status'=> 3)):$this->count_by(array('id_authority_status'=> 3,'id_organization'=>$id_organization));
            $result['in_working'] = $id_organization==0?$this->count_by(array('id_authority_status'=> array(1,2,4))):$this->count_by(array('id_authority_status'=> array(1,2,4),'id_organization'=>$id_organization));
            $result['new_authorities'] = $id_organization==0?$this->count_by(array('is_new'=> 'true')):$this->count_by(array('is_new'=> 'true','id_organization'=>$id_organization));
        return $result;
    }
    
    public function rest_is_new($id_authority){
        $this->update($id_authority, array('is_new'=> 'false'));
    }
    
    public function set_is_new($id_authority){
        $this->update($id_authority, array('is_new'=> 'true'));
    }

}
