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

    public function there_is($authority_name, $id_organization = 0) {
        $by = $id_organization > 0 ? array('authority_name' => $authority_name, 'id_organization' => $id_organization) : array('authority_name' => $authority_name);
        $count = $this->count_by($by);
        return $count > 0 ? true : false;
    }

    public function get_id_by_name($authority_name) {
        $result = $this->get_by(array('authority_name' => $authority_name));
        return isset($result['id_authority']) ? $result['id_authority'] : $result[0]['id_authority'];
    }

    public function calculate_limits($page, $limits, $authoritis = array()) {
        if (count($authoritis) == 0) {
            $result = $this->get_all();
            foreach ($result as $value) {
                $authoritis[] = $value['id_authority'];
            }
        }
        $num_page = 0;
        $page_limit = 0;
        $authority_start = 0;
        foreach ($authoritis as $key => $id_authority) {
            $count = $this->service->get_count_services_by_authority($id_authority);
            if (($count + $page_limit) > $limits) {
                $num_page++;
                if ($num_page == $page) {
                    $data['start'] = $authority_start;
                    $data['end'] = $key - 1;
                    return $data;
                } else {
                    $page_limit = $count;
                    $authority_start = $key;
                }
            } else {
                $page_limit = $page_limit + $count;
            }
        }
        $data['start'] = $authority_start;
        $data['end'] = $key+1;
        return $data;
    }

    public function total_page($limits, $authoritis = array()) {
        if (count($authoritis) == 0) {
            $result = $this->get_all();
            foreach ($result as $value) {
                $authoritis[] = $value['id_authority'];
            }
        }
        $num_page = 1;
        $page_limit = 0;
        foreach ($authoritis as $id_authority) {
            $count = $this->service->get_count_services_by_authority($id_authority);
            if (($count + $page_limit) > $limits) {
                $num_page++;
                $page_limit = $count;
            } else {
                $page_limit = $page_limit + $count;
            }
        }
        return $num_page;
    }

}
