<?php

$config = array(
            'site/login' => array(
                array(
                        'field' => 'login_name',
                        'label' => 'Имя пользователя',
                        'rules' => 'required'
                     ),
                array(
                        'field' => 'login_password',
                        'label' => 'Пароль',
                        'rules' => 'required'
                     )
                ),
            'settings/index' => array(
                array(
                        'field' => 'property_name',
                        'label' => 'Название свойства',
                        'rules' => 'required'
                     ),
                array(
                        'field' => 'property_type',
                        'label' => 'Тип свойства',
                        'rules' => 'required'
                     ),
                array(
                        'field' => 'property_align',
                        'label' => 'Выравнивание свойства',
                        'rules' => 'required'
                     ),
                array(
                        'field' => 'property_width',
                        'label' => 'Ширина поля',
                        'rules' => 'required|numeric'
                     ),
                array(
                        'field' => 'property_color',
                        'label' => 'Цвет свойства',
                        'rules' => 'required'
                     ),
                array(
                        'field' => 'service_type',
                        'label' => 'Тип',
                        'rules' => 'required'
                     ),
                ),
           );