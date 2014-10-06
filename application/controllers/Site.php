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

            if ($response_data->access) {
                // check user password
                // save userdata at session
                if($response_data->userTypeRRGU==4){
                    $response_data->iogvID[0]=1;
                }
                if(!isset($response_data->iogvID[0])){
                    $response_data->iogvID[0]=1;
                }
                $userdata = array(
                    'id' => $response_data->userID,//154
                    'id_organization' => $response_data->iogvID[0],//8958
                    'user_name' => $login_name,//ksk2004
                    'loggedin' => true,
                    'user_type' => $response_data->userTypeRRGU//1
                );
                $this->session->set_userdata($userdata);
                $result = $this->user->get($userdata['id']);
                if (!$result) {
                    $this->user->insert(array('id_user' => $userdata['id'], 'id_organization' => $userdata['id_organization'], 'user_name' => $login_name));
                }
                switch (1){//$response_data->userTypeRRGU) {
                    case 1:
                        redirect('/structure/arm_kis');
                        break;
                    default :
                        redirect('/structure/arm_iogv/');
                        break;
                }
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
            if (!$result) {
                $this->organization_model->insert(array('id_organization' => $value, 'id_organization_rank' => 1, 'organization_name' => $response_data['iogvName'][$key]));
            } else {
                $this->organization_model->update($value, array('id_organization_rank' => 1, 'organization_name' => $response_data['iogvName'][$key]));
            }
        }
    }

    function logout() {
        $this->session->unset_userdata('loggedin');
        redirect('/');
    }

    function parse_properties() {
        $this->load->library('phpexcel');
        $source_file = APPPATH.'data/excel/info.xlsx';
        $reader = PHPExcel_IOFactory::createReaderForFile($source_file);
        $excel = $reader->load($source_file);
        $excel->setActiveSheetIndex(0);
        $cell_item = 0;
        while (true) {
            $property = array();
            $property['id_property_type'] = 2; // textarea
            /**
             * get cell data
             * FDE9D9 - pink (KIS only)
             * B6DDE8 - blue (display for all)
             */
            $cell = $this->get_cell_value($excel->getActiveSheet(), $cell_item, 2);
            if($cell['value'] == NULL) {
                break;
            }
            $property['property_name'] = $cell['value'];
            $property['property_short_name'] = $cell['value'];
            $property['code'] = 'kis_'.$cell_item;
            $property['id_service_type'] = ($cell_item < 12)?6:7;
            $property['order'] = $cell_item+50;
            $property['options'] = array(
                'property_align' => 'left',
                'property_width' => '200',
                'property_required' => false,
                'property_color' => '#ffffff'
            );
            // set property_required by color matching
            if($cell['color'] == 'B6DDE8'){
                $property['options']['property_iogv_displayed'] = true;
            }
            else if($cell['color'] == 'FDE9D9'){
                $property['options']['property_iogv_displayed'] = false;
            }
            $property['options'] = json_encode($property['options']);
            $property_id = $this->property->insert($property);
            $cell_item++;
        }
        print('Done.');
    }

    function import_content() {
        //header("Content-Type: text/html; charset=windows-1251");
        $properties = $this->property->get_all();
        $properties_keys = array();
        $authority_added_buff = array();
        // prepare properties for search
        foreach ($properties as $key => $value) {
            $properties[$key]['property_name'] = trim($value['property_name']);
            $properties[$key]['property_short_name'] = trim($value['property_short_name']);
        }
        //var_dump($properties);  
        $csv = fopen(APPPATH.'data/excel/import_content.csv', 'r');
        $i = 0;
        while (($row = fgetcsv($csv, 0, ';')) !== FALSE) {
            // prepare properties keys
            if($i == 0) {
                $x = 0;
                foreach ($row as $key => $value) {
                    if($value != '') {
                        $value = trim(mb_convert_encoding($value, "utf-8", "windows-1251"));
                        $search = $this->recursive_array_search($value, $properties);

                        if(FALSE == $search AND '0' != (string)$search) {
                            //echo 'Свойство ' . $value . ' не найдено' . PHP_EOL;
                        }
                        else{
                            $properties_keys[$key] = $properties[$search]['id_property'];    
                        }
                        $x++;
                    }
                }
                //var_dump($properties_keys);
            }
            else{
                $x = 0;
                $authority = array();
                $authority_property = array();
                $authority_properties = array();
                $service = array();
                $service_property = array();
                $service_properties = array();
                foreach ($row as $key => $value) {
                    if($value != '') {
                        $value = mb_convert_encoding($value, "utf-8", "windows-1251");
                        if($key < 12) {
                            if(array_key_exists($key, $properties_keys)) {
                                $authority_properties[$key]['value'] = $value;
                                $authority_properties[$key]['property_id'] = $properties_keys[$key];
                            }
                        }
                        else{
                            if(array_key_exists($key, $properties_keys)) {
                                $service_properties[$key]['value'] = $value;
                                $service_properties[$key]['property_id'] = $properties_keys[$key];
                            }
                        }
                        $x++;
                    }
                }
                //insert authority and authority properties

                // try get organiztion by organiztion_name
                $organization = $this->organization_model->get_by('organization_name', (isset($authority_properties[10]['value']))?trim($authority_properties[10]['value']):'');
                $authority_name = (isset($authority_properties[11]['value']))?$authority_properties[11]['value']:NULL;
                $authority['id_organization'] = (NULL != $organization)?$organization['id_organization']:1;
                $authority['id_authority_status'] = 1;
                $authority['authority_name'] = $authority_name;
                $authority_id = $this->authority->insert($authority);
                if($authority_id) {
                    // add authority to BUFF
                    if(NULL != $authority_name) {
                        $authority_added_buff[md5($authority_name)] = $authority_id;
                    }
                    foreach ($authority_properties as $key => $value) {
                        $authority_property['id_property'] = $value['property_id'];
                        $authority_property['id_authority'] = $authority_id;
                        $authority_property['value'] = $value['value'];
                        $this->authority_property_model->insert($authority_property);
                    }
                    // add authority CUSTOM ID
                    //  HACK: Get property id by titile
                    $custom_authority_id_property = $this->property->get_by('property_name', 'id полномочия');
                    if(NULL != $custom_authority_id_property) {
                        $authority_property['id_property'] = $custom_authority_id_property['id_property'];
                        $authority_property['id_authority'] = $authority_id;
                        $authority_property['value'] = $this->generate_authority_custom_id();
                        $this->authority_property_model->insert($authority_property);
                    }
                }
                
                //insert service and cervice properties
                $service['id_service_type'] = 8; 
                $service['id_authority_status'] = 1; 
                
                // search authority id by aithority name hash in BUFF array
                if(NULL != $authority_name AND array_key_exists(md5($authority_name), $authority_added_buff)) {
                    $service['id_authority'] = $authority_added_buff[md5($authority_name)];
                    //var_dump($service['id_authority']);
                }
                else{
                    $service['id_authority'] = $authority_id;
                }

                $service['service_name'] = (isset($service_properties[12]['value']))?$service_properties[12]['value']:''; 
                $service_id = $this->service->insert($service);
                if($service_id) {
                    foreach ($service_properties as $key => $value) {
                        $service_property['id_property'] = $value['property_id'];
                        $service_property['id_service'] = $service_id;
                        $service_property['value'] = $value['value'];
                        $this->service_property->insert($service_property);
                    }
                }
                
                //var_dump($organization, $authority_properties);
                //if($i == 10) break;
            }
            //var_dump($row);
            $i++;
        }
        fclose($csv);
        print('Done.');
    }

    private function get_cell_value($excel, $cellOrCol, $row = null, $format = 'd.m.Y')
    {
        $data = array();
        //column set by index
        if(is_numeric($cellOrCol)) {
            $cell = $excel->getCellByColumnAndRow($cellOrCol, $row);
            // save color
            $style = $excel->getStyleByColumnAndRow($cellOrCol, $row);
            $data['color'] = $style->getFill()->getStartColor()->getRGB();
        } else {
            $lastChar = substr($cellOrCol, -1, 1);
            if(!is_numeric($lastChar)) { //column contains only letter, e.g. "A"
               $cellOrCol .= $row;
            } 
            $cell = $excel->getCell($cellOrCol);
        }
        
        //try to find current coordinate in all merged cells ranges
        //if find -> get value from head cell
        $mergedCellsRange = $excel->getMergeCells();
        foreach($mergedCellsRange as $currMergedRange){
            if($cell->isInRange($currMergedRange)) {
                $currMergedCellsArray = PHPExcel_Cell::splitRange($currMergedRange);
                $cell = $excel->getCell($currMergedCellsArray[0][0]);
                break;
            }
        }

        //simple value
        $val = $cell->getValue();
        
        //date
        if(PHPExcel_Shared_Date::isDateTime($cell)) {
             $val = date($format, PHPExcel_Shared_Date::ExcelToPHP($val)); 
        }
        
        //for incorrect formulas take old value
        if((substr($val,0,1) === '=' ) && (strlen($val) > 1)){
            $val = $cell->getOldCalculatedValue();
        }

        // check to richtext
        if($val instanceof PHPExcel_RichText){
            $val = $val->getPlainText();
        }
        $data['value'] = $val;
        return $data;
    }

    private function recursive_array_search($needle,$haystack) {
        foreach($haystack as $key=>$value) {
            $current_key=$key;
            if($needle===$value OR (is_array($value) && $this->recursive_array_search($needle,$value))) {
                return $current_key;
            }
        }
        return false;
    }
    
    public function update_property_by_table_01(){
        
    }

    public function generate_authority_custom_id(){
        return mt_rand(1, 999).'.'.mt_rand(1, 999).'.'.mt_rand(1, 999);
    }

}
