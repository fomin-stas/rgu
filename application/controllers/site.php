<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Site extends APP_Controller {

    function __construct() {
        parent::__construct();
        $this->layout->setLayout('site');
    }

    public function index() {
        redirect('/login');
    }

    
    public function login() {
        global $is_kis;
        // login request
        if ($this->input->is_post() AND $this->form_validation->run()) {
            $login_name = $this->input->post('login_name');
            $login_password = $this->input->post('login_password');
            $myCurl = curl_init();
            curl_setopt_array($myCurl, array(
                CURLOPT_URL => 'http://reestrgu.iac.spb.ru/auth/',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_POST => true,
                CURLOPT_POSTFIELDS => http_build_query(array('login' => $login_name, 'password' => $login_password))
            ));
            $response_statistic = curl_exec($myCurl);
            curl_close($myCurl);
            $response_data = json_decode($response_statistic);
            /* $response_data->userTypeRRGU=1;
              $response_data->groupIogvID=31554;
              $response_data->access=true;
              $response_data->userID=5; */

            if (!isset($response_data)) {
                show_error('Нет соединения с сервером авторизации.');
                return;
            }

            if ($response_data->access) {
                // check user password
                // save userdata at session
                if ($response_data->userTypeRRGU == 4) {
                    $response_data->groupIogvID = 1;
                }
                if (!isset($response_data->groupIogvID)) {
                    show_error('Пользователь не привязан ни к одной организации.');
                    return;
                }
                $userdata = array(
                    'id' => $response_data->userID, //154
                    'id_organization' => $response_data->groupIogvID, //8958
                    'user_name' => $login_name, //ksk2004
                    'loggedin' => true,
                    'organization_name' => $response_data->groupIogvNAME,
                    'user_type' => $response_data->userTypeRRGU//1
                );
                $this->session->set_userdata($userdata);
                $result = $this->user->get($userdata['id']);
                if (!$result) {
                    $this->user->insert(array('id_user' => $userdata['id'], 'id_organization' => $userdata['id_organization'], 'user_name' => $login_name));
                }
                switch ($response_data->userTypeRRGU) {
                    case 1:
                        redirect('/structure/arm_kis');
                        break;
                    default :
                        redirect('/structure/arm_iogv/');
                        break;
                }
                return;
            } else {
                $this->session->set_flashdata('message', 'Не верное имя пользователя или пароль!');
            }
        }
        $this->layout->view('login');
    }

    function sync_organization() {
        $myCurl = curl_init();
        curl_setopt_array($myCurl, array(
            CURLOPT_URL => 'http://reestrgu.iac.spb.ru/auth/iogv/',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => http_build_query(array('password' => 'listIOGV4981'))
        ));
        $response_list_iogv = curl_exec($myCurl);
        curl_close($myCurl);
        $response_data = json_decode($response_list_iogv, true);
        foreach ($response_data['iogvID'] as $key => $value) {
            $result = $this->organization_model->get($value);
            $organazation_type = $response_data['iogvTYPE'][$key] == 'РОИВ' ? 1 : 2;
            !$result ? $this->organization_model->insert(array('id_organization' => $value, 'id_organization_rank' => $organazation_type, 'organization_name' => $response_data['iogvName'][$key])) : $this->organization_model->update($value, array('id_organization_rank' => $organazation_type, 'organization_name' => $response_data['iogvName'][$key]));
        }
    }

    function logout() {
        $this->session->unset_userdata('loggedin');
        redirect('/');
    }

    function parse_properties() {
        $this->load->library('PHPExcel/PHPExcel');
        $source_file = APPPATH . 'data/excel/info.xlsx';
        $reader = PHPExcel_IOFactory::createReaderForFile($source_file);
        $excel = $reader->load($source_file);
        $excel->setActiveSheetIndex(0);
        $cell_item = 0;
        while (true) {
            echo $cell_item;
            $property = array();
            $property['id_property_type'] = 2; // textarea
            $cell = $this->get_cell_value($excel->getActiveSheet(), $cell_item, 1);
            if ($cell['value'] == NULL) {
                break;
            }
            $property['property_name'] = $this->str_normalize($cell['value']);
            $property['property_short_name'] = $property['property_name'];
            $property['code'] = 'kis_' . $cell_item;
            $property['id_service_type'] = ($cell_item < 12) ? 6 : 7;
            $property['order'] = $cell_item + 350;
            $property['options'] = array(
                'property_align' => 'left',
                'property_width' => '200',
                'property_required' => false,
                'property_color' => '#ffffff'
            );
            // set property_required by color matching
            $property['options']['property_iogv_displayed'] = false;
            $property['options'] = json_encode($property['options']);
            $property_id = $this->property->insert($property);
            $cell_item++;
        }
        print('Done.');
    }

    private function str_normalize($text) {
        $text = trim($text);
        $text = str_replace("\n", " ", trim($text));
        $text = str_replace("\t", " ", trim($text));
        $text = str_replace("                   ", " ", trim($text));
        $text = str_replace("                  ", " ", trim($text));
        $text = str_replace("                 ", " ", trim($text));
        $text = str_replace("                ", " ", trim($text));
        $text = str_replace("               ", " ", trim($text));
        $text = str_replace("              ", " ", trim($text));
        $text = str_replace("             ", " ", trim($text));
        $text = str_replace("            ", " ", trim($text));
        $text = str_replace("           ", " ", trim($text));
        $text = str_replace("          ", " ", trim($text));
        $text = str_replace("         ", " ", trim($text));
        $text = str_replace("        ", " ", trim($text));
        $text = str_replace("       ", " ", trim($text));
        $text = str_replace("      ", " ", trim($text));
        $text = str_replace("     ", " ", trim($text));
        $text = str_replace("    ", " ", trim($text));
        $text = str_replace("   ", " ", trim($text));
        $text = str_replace("  ", " ", trim($text));
        $text = str_replace("^", ";", trim($text));
        return str_replace("\r", "", trim($text));
    }

    public function import_content_colse($import_limit = 4000, $start = 0) {
        $properties = $this->property->get_all();
        $properties_keys = array();
        $authority_added_buff = array();
        // prepare properties for search
        foreach ($properties as $key => $value) {
            $properties[$key]['property_name'] = $this->str_normalize($value['property_name']);
            $properties[$key]['property_short_name'] = $properties[$key]['property_name'];
        }
        //@@@@($properties);  
        $csv = fopen(APPPATH . 'data/excel/import_content.csv', 'r');
        $i = 0;
        $impo = 0;
        $import_limit = $import_limit + $start;
        while (($row = fgetcsv($csv, 0, ';')) !== FALSE) {
            // prepare properties keys
            /* limits of import */
            $impo = $impo + 1;
            if ($impo == $import_limit) {
                break;
            }
            if ($i == 0) {
                $x = 0;
                foreach ($row as $key => $value) {
                    if ($value != '') {
                        $value = $this->str_normalize(mb_convert_encoding($value, "utf-8", "windows-1251"));
                        $search = $this->recursive_array_search($value, $properties);
                        if (FALSE == $search AND '0' != (string) $search) {
                            //echo 'Свойство ' . $value . ' не найдено' . PHP_EOL;
                        } else {
                            $properties_keys[$key] = $properties[$search]['id_property'];
                        }
                        $x++;
                    }
                }
                //@@@@($properties_keys);
            } else {
                if ($start > $impo) {
                    continue;
                }
                $x = 0;
                $authority = array();
                $authority_property = array();
                $authority_properties = array();
                $service = array();
                $service_property = array();
                $service_properties = array();
                foreach ($row as $key => $value) {
                    if ($value != '') {
                        $value = $this->str_normalize(mb_convert_encoding($value, "utf-8", "windows-1251"));
                        if ($key < 12) {
                            if (array_key_exists($key, $properties_keys)) {
                                $authority_properties[$key]['value'] = $value;
                                $authority_properties[$key]['property_id'] = $properties_keys[$key];
                            }
                        } else {
                            if (array_key_exists($key, $properties_keys)) {
                                $service_properties[$key]['value'] = $value;
                                $service_properties[$key]['property_id'] = $properties_keys[$key];
                            }
                        }
                        $x++;
                    }
                }
                //insert authority and authority properties
                // try get organiztion by organiztion_name
                $organization = $this->organization_model->get_by('organization_name', (isset($authority_properties[10]['value'])) ? trim($authority_properties[10]['value']) : '');
                if (is_null($organization)) {
                    //show_error($authority_properties[10]['value'] . ' - не существует');
                    echo $authority_properties[10]['value'] . ' - не существует';
                    continue;
                }
                $authority_name = (isset($authority_properties[11]['value'])) ? $authority_properties[11]['value'] : NULL;
                if (NULL != $organization) {
                    $authority['id_organization'] = $organization['id_organization'];
                } else {
                    echo $authority_properties[10]['value'] . ' - не соответствует организация. Строка - ' . $impo;
                    continue;
                }
                if ($this->authority->there_is($authority_name, $organization['id_organization'])) {
                    $authority_id = $this->authority->get_id_by_name($authority_name);
                } else {
                    $authority['id_authority_status'] = 2;
                    $authority['authority_name'] = $authority_name;
                    $authority['is_new'] = 'true';
                    $authority_id = $this->authority->insert($authority);
                    if (!$authority_id) {
                        echo 'Полномочие не добавлено. Строка - ' . $impo;
                        continue;
                    }
                    $this->authority_property_model->add_authority_property($authority_id, $authority_properties, $organization);
                }
                //insert service and cervice properties
                $service_properties[15]['value'] = mb_strtolower($service_properties[15]['value']);
                switch ($service_properties[15]['value']) {
                    case 'функция':
                        $service['id_service_type'] = 8;
                        break;
                    case 'услуга':
                        $service['id_service_type'] = 7;
                        break;
                    case 'функция контроля и надзора':
                        $service['id_service_type'] = 9;
                        break;
                    default:
                        break;
                }
                $service['id_authority_status'] = 2;
                $service['id_authority'] = $authority_id;
                if (!isset($service_properties[15]['value'])) {
                    echo $authority_properties[11]['value'] . ' - не определен статус полномочия. Строка - ' . $impo;
                    continue;
                }
                $service['service_name'] = (isset($service_properties[12]['value'])) ? $service_properties[12]['value'] : '';
                $service_id = $this->service->insert($service);
                if (!isset($service_id)) {
                    echo $service_properties[15]['value'] . " " . $service_properties[12]['value'] . " не может быть записана в БД.Строка - " . $impo;
                    continue;
                }
                if (!isset($service['id_service_type'])) {
                    echo $service_properties[15]['value'] . ' не определена. Строка - ' . $impo;
                    continue;
                }
                $this->preinstall_property($service_id, $service['id_service_type']);
                $service_property['id_property'] = 73;
                $service_property['id_service'] = $service_id;
                $service_property['value'] = $service_properties[12]['value'];
                $service_property['agreed'] = 0;
                $this->service_property->insert($service_property);
                if ($service_id) {
                    foreach ($service_properties as $key => $value) {
                        $service_property['id_property'] = $value['property_id'];
                        $service_property['id_service'] = $service_id;
                        $service_property['value'] = $value['value'];
                        $service_property['agreed'] = 0;
                        $this->service_property->insert($service_property);
                    }
                }
            }
            $i++;
        }
        fclose($csv);
        print('Done.');
    }

    private function preinstall_property($service_id, $id_service_type) {
        $service_property['id_service'] = $service_id;
        $service_property['agreed'] = 0;
        switch ($id_service_type) {
            case 7:
                $service_property['id_property'] = 74;
                $service_property['value'] = '';
                $this->service_property->insert($service_property);
                $service_property['id_property'] = 173;
                $service_property['value'] = '';
                $this->service_property->insert($service_property);
                $service_property['id_property'] = 75;
                $service_property['value'] = '';
                $this->service_property->insert($service_property);
                $service_property['id_property'] = 174;
                $service_property['value'] = '';
                $this->service_property->insert($service_property);
                $service_property['id_property'] = 176;
                $service_property['value'] = '';
                $this->service_property->insert($service_property);
                $service_property['id_property'] = 178;
                $service_property['value'] = '';
                $this->service_property->insert($service_property);
                $service_property['id_property'] = 187;
                $service_property['value'] = '';
                $this->service_property->insert($service_property);
                $service_property['id_property'] = 1076;
                $service_property['value'] = '';
                $this->service_property->insert($service_property);
                $service_property['id_property'] = 1077;
                $service_property['value'] = '';
                $this->service_property->insert($service_property);
                $service_property['id_property'] = 1079;
                $service_property['value'] = '';
                $this->service_property->insert($service_property);
                $service_property['id_property'] = 193;
                $service_property['value'] = '';
                $this->service_property->insert($service_property);
                $service_property['id_property'] = 1078;
                $service_property['value'] = '';
                $this->service_property->insert($service_property);
                $service_property['id_property'] = 1080;
                $service_property['value'] = '';
                $this->service_property->insert($service_property);
                break;
            case 8:
                $service_property['id_property'] = 74;
                $service_property['value'] = '';
                $this->service_property->insert($service_property);
                $service_property['id_property'] = 75;
                $service_property['value'] = '';
                $this->service_property->insert($service_property);
                $service_property['id_property'] = 174;
                $service_property['value'] = '';
                $this->service_property->insert($service_property);

                $service_property['id_property'] = 1037;
                $service_property['value'] = '';
                $this->service_property->insert($service_property);
                $service_property['id_property'] = 1049;
                $service_property['value'] = '';
                $this->service_property->insert($service_property);

                $service_property['id_property'] = 1078;
                $service_property['value'] = '';
                $this->service_property->insert($service_property);
                $service_property['id_property'] = 1080;
                $service_property['value'] = '';
                $this->service_property->insert($service_property);
                break;
            case 9:
                $service_property['id_property'] = 74;
                $service_property['value'] = '';
                $this->service_property->insert($service_property);
                $service_property['id_property'] = 173;
                $service_property['value'] = '';
                $this->service_property->insert($service_property);
                $service_property['id_property'] = 75;
                $service_property['value'] = '';
                $this->service_property->insert($service_property);
                $service_property['id_property'] = 174;
                $service_property['value'] = '';
                $this->service_property->insert($service_property);

                $service_property['id_property'] = 1037;
                $service_property['value'] = '';
                $this->service_property->insert($service_property);
                $service_property['id_property'] = 1049;
                $service_property['value'] = '';
                $this->service_property->insert($service_property);

                $service_property['id_property'] = 193;
                $service_property['value'] = '';
                $this->service_property->insert($service_property);
                $service_property['id_property'] = 1078;
                $service_property['value'] = '';
                $this->service_property->insert($service_property);
                $service_property['id_property'] = 1080;
                $service_property['value'] = '';
                $this->service_property->insert($service_property);
                break;
            default:
                break;
        }
    }

    private function get_cell_value($excel, $cellOrCol, $row = null, $format = 'd.m.Y') {
        $data = array();
        //column set by index
        if (is_numeric($cellOrCol)) {
            $cell = $excel->getCellByColumnAndRow($cellOrCol, $row);
            // save color
            $style = $excel->getStyleByColumnAndRow($cellOrCol, $row);
            $data['color'] = $style->getFill()->getStartColor()->getRGB();
        } else {
            $lastChar = substr($cellOrCol, -1, 1);
            if (!is_numeric($lastChar)) { //column contains only letter, e.g. "A"
                $cellOrCol .= $row;
            }
            $cell = $excel->getCell($cellOrCol);
        }

        //try to find current coordinate in all merged cells ranges
        //if find -> get value from head cell
        $mergedCellsRange = $excel->getMergeCells();
        foreach ($mergedCellsRange as $currMergedRange) {
            if ($cell->isInRange($currMergedRange)) {
                $currMergedCellsArray = PHPExcel_Cell::splitRange($currMergedRange);
                $cell = $excel->getCell($currMergedCellsArray[0][0]);
                break;
            }
        }

        //simple value
        $val = $cell->getValue();

        //date
        if (PHPExcel_Shared_Date::isDateTime($cell)) {
            $val = date($format, PHPExcel_Shared_Date::ExcelToPHP($val));
        }

        //for incorrect formulas take old value
        if ((substr($val, 0, 1) === '=' ) && (strlen($val) > 1)) {
            $val = $cell->getOldCalculatedValue();
        }

        // check to richtext
        if ($val instanceof PHPExcel_RichText) {
            $val = $val->getPlainText();
        }
        $data['value'] = $val;
        return $data;
    }

    private function recursive_array_search($needle, $haystack) {
        foreach ($haystack as $key => $value) {
            $current_key = $key;
            if ($needle === $value OR ( is_array($value) && $this->recursive_array_search($needle, $value))) {
                return $current_key;
            }
        }
        return false;
    }

    public function update_property_by_table_01() {
        
    }

    public function property_color_to_defult() {
        $properties = $this->property->get_all();
        foreach ($properties as $key => $property) {
            $data['options'] = str_replace('6e5858', 'ffffff', $property['options']);
            $this->property->update($property['id_property'], $data);
        }
    }
    
//    public function property_color_to_defult(){
//        $properties=$this->property->get_all();
//        foreach ($properties as $key => $property) {
//           $data['options']=str_replace('6e5858', 'ffffff', $property['options']);
//           $this->property->update($property['id_property'],$data);
//        }
//    }

}
