<?php

class Search_table extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function searche($request) {
        if (is_array($request)) {
            return 0;
        }
        $after = json_decode($request);
        if (is_null($after)) {
            return 0;
        }
        return $this->groups_search($after);
    }

    private function groups_search($after) {
        $is_first = true;
        $return_array = array();
        if (count($after->rules) == 0 && (!isset($after->groups))) {
            return array();
        }
        if (count($after->rules) > 0) {
            foreach ($after->rules as $rule) {
                $at_array = $this->recursiv_search($rule);
                $return_array = $this->operation($return_array, $at_array, $after->groupOp, $is_first);
            }
        }
        if (isset($after->groups)) {
            if (count($after->groups) > 0) {
                foreach ($after->groups as $group) {
                    $at_array = $this->groups_search($group);
                    $return_array = $this->operation($return_array, $at_array, $after->groupOp, $is_first);
                }
            }
        }
        return $return_array;
    }

    private function recursiv_search($rule) {
        $property = $this->property->get_by('code', $rule->field);
        $at_array = array();
        if (!isset($property['id_service_type']) || ($property['id_service_type'] != 6)) {
            $from = ",service  sr,  service_property sep";
            $query = " where ath.id_authority=sr.id_authority and sep.id_service=sr.id_service AND (sep.id_property=" . $property['id_property'] . " AND lower(sep.value)" . $this->operators($rule->data, $rule->op) . ")";
        } else {
            $from = ",authority_property ap";
            $query = " where ap.id_authority=ath.id_authority AND (ap.id_property=" . $property['id_property'] . " AND lower(ap.value)" . $this->operators($rule->data, $rule->op) . ")";
        }
        $sql = "SELECT ath.id_authority FROM  authority ath " . $from . $query . ' GROUP BY ath.id_authority';
        $res = $this->db->query($sql);
        foreach ($res->result_array() as $row) {
            $at_array[] = $row['id_authority'];
        }
        return $at_array;
    }

    private function operators($data, $operator) {
        $data = trim($data);
        switch ($operator) {
            case 'cn':
                return "LIKE lower('%" . $data . "%')";
                break;
            case 'nc':
                return "NOT LIKE lower('%" . $data . "%')";
                break;
            case 'eq':
                return "=lower('" . $data . "')";
                break;
            case 'ne':
                return "!=lower('" . $data . "')";
                break;
            case 'bw':
                return "LIKE lower('" . $data . "%')";
                break;
            case 'bn':
                return "NOT LIKE lower('" . $data . "%')";
                break;
            case 'ew':
                return "LIKE lower('%" . $data . "')";
                break;
            case 'en':
                return "NOT LIKE lower('%" . $data . "')";
                break;
            default:
                return "LIKE lower('%" . $data . "%')";
                break;
        }
    }

    private function operation($array1, $array2, $operation, &$is_first) {
        if ($is_first) {
            $is_first = false;
            return $array2;
        } else {
            switch ($operation) {
                case "AND":
                    return array_intersect($array1, $array2);
                    break;
                default:
                    return array_merge($array1, $array2);
                    break;
            }
        }
    }

}
