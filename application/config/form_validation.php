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
                )
           );