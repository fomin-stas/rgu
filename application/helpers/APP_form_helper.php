<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');


if (!function_exists('load_form_textaea')) {

    function load_form_textaea($id_service, $code, $service, $comments = false, $buttons = false) {
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
        if ($buttons != false) {
            $data['buttons'] = $buttons;
            $data['id_service'] = $id_service;
            $data['id_property'] = $id_property;
            $this->load->view('structure/elements/agreement', $data);
        }
        return $textarea_group . '</div>';
    }

}

if (!function_exists('load_form_file')) {

    function load_form_file($id_service, $code, $service, $comments = false, $buttons = false) {
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
                . '<label for="' . $id_property . '_' . $id_service . '" class="control-label col-md-4">' . $property_name . '</label>';
        $textarea_group .= $disabled != ' disabled' ? '<span class="col-md-6"><input type="file" multiple  id="' . $id_property . '_' . $id_service . '" name="' . $id_property . '_' . $id_service . '" class="col-md-6 files">' . $value . '</span>' : '<span class="col-md-6">' . $value . '</span>';
        if ($comments) {
            $textarea_group = $textarea_group .
                    '<div  class=" col-md-2">
                        <button type="button" class="com_bt btn btn-sm btn-primary col-md-12" id="bt_' . $id_service . '_' . $id_property . '">
                            <i class="ace-icon fa fa-comment icon-only"></i>
                        </button>
                    </div>';
        }
        if ($buttons != false) {
            $data['buttons'] = $buttons;
            $data['id_service'] = $id_service;
            $data['id_property'] = $id_property;
            $this->load->view('structure/elements/agreement', $data);
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
            $selects = to_multy($selects);
            $dropdown_group = ' <div class="form-group ' . $has_essror . '">'
                    . '             <label for = "' . $name . '" class = "control-label col-md-4">' . $property_name . '</label>'
                    . '<div class="multy_tags col-md-6" ' . $disabled . '>'
                    . '             <input class="input-tag" id="' . $name . '" type="text" name="' . $name . '" value="' . $value . '" ' . $disabled . '>'
                    . '</div>'
                    . " <script> 
                            $('#" . $name . "').tag({source:$selects});";

            $dropdown_group .= $disabled == ' disabled' ? "$('#" . $name . "').next().attr('disabled','" . $disabled . "');
                                                        $('#" . $name . "').prev().children('button').attr('disabled','" . $disabled . "');
                                                    </script>" : "</script>";
        } else {
            $dropdown_group = '<div class="form-group ' . $has_essror . '">'
                    . '        <label for = "' . $code . '_' . $id_service . '" class = "control-label col-md-4">' . $property_name . '</label>'
                    . form_dropdown($name, $selects, $value, 'id="' . $name . '" name="' . $name . '" class="col-md-6"' . $disabled);
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

if (!function_exists('load_form_textaea_step2')) {

    function load_form_textaea_step2($num, $code, $propertis, $comments = false, $buttons = false) {
        $property = get_property_by_code($code, $propertis);
        if (isset($service['properties'][$code]['value'])) {
            $value = $service['properties'][$code]['value'];
        } else {
            $value = '';
        }
        $textarea_group = '<div class="form-group">'
                . '<label for="' . $code . '_' . $num . '" class="control-label col-md-4">' . $property['property_name'] . '</label>
                                                            <textarea id="' . $code . '_' . $num . '" name="' . $code . '_' . $num . '" class="col-md-6" style="height:100px"></textarea>
                                                        ';
        if ($comments) {
            $textarea_group = $textarea_group .
                    '<div  class=" col-md-2">
                        <button type="button" class="com_bt btn btn-sm btn-primary col-md-12" id="bt_' . $code . '_' . $num . '">
                            <i class="ace-icon fa fa-comment icon-only"></i>
                        </button>
                    </div>';
        }
        if ($buttons != false) {
            $data['buttons'] = $buttons;
            $data['id_service'] = $num;
            $data['id_property'] = $code;
            $this->load->view('structure/elements/agreement', $data);
        }
        $textarea_group = $textarea_group . '<div class="col-md-1"><label class="btn btn-primary addition_property" data-id="'.$property['id_property'].'"><i class="icon-only ace-icon fa fa-align-justify"></i></label></div><div class="modal fade" id="div_'.$property['id_property'].'" tabindex="-1" role="dialog" aria-labelledby="add_property_label" aria-hidden="true"></div>';
        return $textarea_group . '</div>';
    }

}

if (!function_exists('load_form_dropdown_step2')) {

    function load_form_dropdown_step2($num, $code, $selects, $propertis, $comments = false, $multy = false) {
        $property = get_property_by_code($code, $propertis);
        foreach ($propertis as $property_array) {
            if ($property_array['code'] == $code) {
                $property = $property_array;
            } else {
                continue;
            }
        }
        $id_property = $property['id_property'];
        $property_name = $property['property_name'];

        $name = $code . '_' . $num;
        if ($multy) {
            $selects = to_multy($selects);
            $dropdown_group = ' <div class="form-group">'
                    . '             <label for = "' . $code . '_' . $num . '" class = "control-label col-md-4">' . $property_name . '</label>'
                    . '<div class="multy_tags col-md-6">'
                    . '             <input class="input-tag" id="' . $code . '_' . $num . '" type="text" name="' . $code . '_' . $num . '" >'
                    . '</div>'
                    . " <script> 
                            $('#" . $code . "_" . $num . "').tag({source:$selects});
                        </script>";
        } else {
            $dropdown_group = '<div class="form-group">'
                    . '        <label for = "' . $code . '_' . $num . '" class = "control-label col-md-4">' . $property_name . '</label>'
                    . form_dropdown($name, $selects, '', 'id="' . $name . '" name="' . $name . '" class="col-md-6"');
        }
        if ($comments) {
            $dropdown_group = $dropdown_group .
                    '<div  class=" col-md-2">
                        <button type="button" class="com_bt btn btn-sm btn-primary col-md-12" id="bt_' . $code . '_' . $num . '">
                            <i class="ace-icon fa fa-comment icon-only"></i>
                        </button>
                    </div>';
        }
        $dropdown_group = $dropdown_group . '<div class="col-md-1"><label class="btn btn-primary addition_property" data-id="'.$property['id_property'].'"><i class="icon-only ace-icon fa fa-align-justify"></i></label></div><div class="modal fade" id="div_'.$property['id_property'].'" tabindex="-1" role="dialog" aria-labelledby="add_property_label" aria-hidden="true"></div>';
        return $dropdown_group . '</div>';
    }

}

if (!function_exists('load_form_file_step2')) {

    function load_form_file_step2($num, $code, $propertis, $comments = false, $buttons = false) {
        $property = get_property_by_code($code, $propertis);
        foreach ($propertis as $property_array) {
            if ($property_array['code'] == $code) {
                $property = $property_array;
            } else {
                continue;
            }
        }
        if (isset($service['properties'][$code]['value'])) {
            $value = $service['properties'][$code]['value'];
        } else {
            $value = '';
        }
        $textarea_group = '<div class="form-group">'
                . '<label for="' . $code . '_' . $num . '" class="control-label col-md-4">' . $property['property_name'] . '</label>
                    <span class="col-md-6">
                                                                <input type="file" multiple id="' . $code . '_' . $num . '" name="' . $code . '_' . $num . '" class="col-md-6 files">
</span>                                                        
';
        if ($comments) {
            $textarea_group = $textarea_group .
                    '<div  class=" col-md-2">
                        <button type="button" class="com_bt btn btn-sm btn-primary col-md-12" id="bt_' . $code . '_' . $num . '">
                            <i class="ace-icon fa fa-comment icon-only"></i>
                        </button>
                    </div>';
        }
        if ($buttons != false) {
            $data['buttons'] = $buttons;
            $data['id_service'] = $num;
            $data['id_property'] = $code;
            $this->load->view('structure/elements/agreement', $data);
        }
        $textarea_group = $textarea_group . '<div class="col-md-1"><label class="btn btn-primary addition_property" data-id="'.$property['id_property'].'"><i class="icon-only ace-icon fa fa-align-justify"></i></label></div><div class="modal fade" id="div_'.$property['id_property'].'" tabindex="-1" role="dialog" aria-labelledby="add_property_label" aria-hidden="true"></div>';
        return $textarea_group . '</div>';
    }

}

function to_multy($selects) {
    $data = "[";
    $count = 0;
    foreach ($selects as $value) {
        ($count > 0) ? $data = $data . "," : $data = $data;
        $data = $data . "'" . $value . "'";
        $count++;
    }
    $data = $data . "]";
    return $data;
}

function get_property_by_code($code, $propertis) {
    switch ($code) {
        case 'sn_0':
            $d_code = 'sr_0';
            break;
        case 'sn_1':
            $d_code = 'sr_1';
            break;
        case 'sn_3':
            $d_code = 'sr_3';
            break;
        case 'sn_4':
            $d_code = 'sr_4';
            break;
        case 'sn_27':
            $d_code = 'sr_27';
            break;
        case 'sn_29':
            $d_code = 'sr_29';
            break;
        case 'sk_0':
            $d_code = 'sr_0';
            break;
        case 'sk_1':
            $d_code = 'sr_1';
            break;
        case 'sk_4':
            $d_code = 'sr_4';
            break;
        case 'sk_23':
            $d_code = 'sr_23';
            break;
        case 'sk_27':
            $d_code = 'sr_27';
            break;
        case 'sk_29':
            $d_code = 'sr_29';
            break;
        default :
            $d_code = $code;
            break;
    }
    foreach ($propertis as $property_array) {
        if ($property_array['code'] == $d_code) {
            $property = $property_array;
        } else {
            continue;
        }
    }
    return $property;
}
