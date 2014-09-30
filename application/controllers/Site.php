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

    function parse_properties() {
        $this->load->library('phpexcel');
        $source_file = APPPATH.'data/excel/info.xlsx';
        $reader = PHPExcel_IOFactory::createReaderForFile($source_file);
        $excel = $reader->load($source_file);
        $excel->setActiveSheetIndex(0);
        $cell_item = 1;
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
            $property['code'] = 'sr_'.$cell_item;
            $property['order'] = $cell_item;
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

    function logout() {
        $this->session->unset_userdata('loggedin');
        redirect('/');
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
}