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

        $result['all'] = $id_organization == 0 ? $this->count_all() : $this->count_by('id_organization', $id_organization);
        $result['in_process'] = $id_organization == 0 ? $this->count_by(array('id_authority_status' => 3)) : $this->count_by(array('id_authority_status' => 3, 'id_organization' => $id_organization));
        $result['in_working'] = $id_organization == 0 ? $this->count_by(array('id_authority_status' => array(1, 2, 4))) : $this->count_by(array('id_authority_status' => array(1, 2, 4), 'id_organization' => $id_organization));
        $result['new_authorities'] = $id_organization == 0 ? $this->count_by(array('is_new' => 'true')) : $this->count_by(array('is_new' => 'true', 'id_organization' => $id_organization));
        return $result;
    }

    public function rest_is_new($id_authority) {
        $this->update($id_authority, array('is_new' => 'false'));
    }

    public function set_is_new($id_authority) {
        $this->update($id_authority, array('is_new' => 'true'));
    }

    public function serch($request) {
        $after = json_decode($request);
        $is_first = true;
        foreach ($after->rules as $rule) {
            $query = '';
            $from = '';
            $at_array = array();
            $property = $this->property->get_by('code', $rule->field);
            if (!isset($property['id_service_type']) || ($property['id_service_type'] != 6)) {
                $from = $from . ",service  sr,  service_property sep";
                $query = $query . " where ath.id_authority=sr.id_authority and sep.id_service=sr.id_service ";
                $query = $query . " AND (sep.id_property=" . $property['id_property'] . " AND sep.value LIKE '%" . $rule->data . "%') ";
            } else {
                $from = $from . ",authority_property ap";
                $query = $query . " where ap.id_authority=ath.id_authority ";
                $query = $query . " AND (ap.id_property=" . $property['id_property'] . " AND ap.value LIKE '%" . $rule->data . "%') ";
            }
            $sql = "SELECT ath.id_authority FROM  authority ath " . $from . $query . ' GROUP BY ath.id_authority';
            $res = $this->db->query($sql);
            foreach ($res->result_array() as $row) {
                $at_array[] = $row['id_authority'];
            }
            if ($is_first) {
                $return_array = $at_array;
                $is_first = false;
            } else {
                $return_array = array_intersect($return_array, $at_array);
            }
        }
        return $return_array;
    }

}
