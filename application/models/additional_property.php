<?php

class Additional_property extends APP_Model {

    public $_table = 'additional_property';
    public $primary_key = 'id_additional_property';
    public $belongs_to = array(
        'format' => array(
            'model' => 'property_format_model',
            'primary_key' => 'id_property_format'),
    );
    protected $return_type = 'array';

}
