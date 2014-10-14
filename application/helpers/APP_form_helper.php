<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');


if (!function_exists('load_form_textaea')) {

    function load_form_textaea($id_service, $code, $service, $comments = false, $buttons=false) {
        if ($service['properties'][$code]['agreed'] == 1) {
            $disabled = ' disabled';
            $has_essror = "";
        } else {
            $disabled = ' ';
            $has_essror = "has-error";
        }
        $id_property = $service['properties'][$code]['id_property'];
        $property_name = $service['properties'][$code]['property_name'];
        if (isset($service['properties'][$code]['value'])) {
            $value = $service['properties'][$code]['value'];
        } else {
            $value = '';
        }
        $textarea_group = '<div class="form-group ' . $has_essror . '">'
                . '<label for="' . $id_property . '_' . $id_service . '" class="control-label col-md-4">' . $property_name . '</label>
                                                            <textarea id="' . $id_property . '_' . $id_service . '" name="' . $id_property . '_' . $id_service . '" class="col-md-6" ' . $disabled . '>' . $value . '</textarea>
                                                        ';
        if ($comments) {
            $textarea_group = $textarea_group .
                    '<div  class=" col-md-2">
                        <button type="button" class="com_bt btn btn-sm btn-primary col-md-12" id="bt_' . $id_service . '_' . $id_property . '">
                            <i class="ace-icon fa fa-comment icon-only"></i>
                        </button>
                    </div>';
        }
        if($buttons != false){
            $data['buttons']=$buttons;
            $data['id_service']=$id_service;
            $data['id_property']=$id_property;
            $this->load->view('structure/elements/agreement',$data);
        }
        return $textarea_group . '</div>';
    }
}

if (!function_exists('load_form_dropdown')) {
    function load_form_dropdown($id_service, $code, $selects, $service, $comments = false, $multy = false) {
        if ($service['properties'][$code]['agreed'] == 1) {
            $disabled = ' disabled';
            $has_essror = "";
        } else {
            $disabled = ' ';
            $has_essror = "has-error";
        }
        $id_property = $service['properties'][$code]['id_property'];
        $property_name = $service['properties'][$code]['property_name'];
        if (isset($service['properties'][$code]['value'])) {
            $value = $service['properties'][$code]['value'];
        } else {
            $value = '';
        }
        $name = $id_property . '_' . $id_service;
        if ($multy) {
            $dropdown_group = '<div class="form-group ' . $has_essror . '">'
                    . '        <label for = "' . $code . '_' . $id_service . '" class = "control-label col-md-4">'.$property_name.'</label>'
                    . form_multiselect($name.'[]', $selects, $value, 'id="' . $name . '" name="' . $name . '" class="col-md-6"'. $disabled);
        } else {
            $dropdown_group = '<div class="form-group ' . $has_essror . '">'
                    . '        <label for = "' . $code . '_' . $id_service . '" class = "control-label col-md-4">'.$property_name.'</label>'
                    . form_dropdown($name, $selects, $value, 'id="' . $name . '" name="' . $name . '" class="col-md-6"'.$disabled);
        }
        if ($comments) {
            $dropdown_group = $dropdown_group .
                    '<div  class=" col-md-2">
                        <button type="button" class="com_bt btn btn-sm btn-primary col-md-12" id="bt_' . $id_service . '_' . $id_property . '">
                            <i class="ace-icon fa fa-comment icon-only"></i>
                        </button>
                    </div>';
        }
        return $dropdown_group . '</div>';
    }

}