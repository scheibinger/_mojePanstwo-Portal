<?php

Router::connect('/paszport', array('plugin' => 'paszport', 'controller' => 'pages', 'action' => 'home'));

Router::connect('/authorize', array('plugin' => 'paszport', 'controller' => 'passports', 'action' => 'authorize'));
Router::connect('/login', array('plugin' => 'paszport', 'controller' => 'users', 'action' => 'login'));
Router::redirect('/zaloguj', array('plugin' => 'paszport', 'controller' => 'users', 'action' => 'login'));
Router::redirect('/logowanie', array('plugin' => 'paszport', 'controller' => 'users', 'action' => 'login'));