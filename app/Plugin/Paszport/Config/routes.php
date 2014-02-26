<?php

Router::connect('/paszport', array('plugin' => 'paszport', 'controller' => 'pages', 'action' => 'home'));

Router::connect('/login', array('plugin' => 'paszport', 'controller' => 'users', 'action' => 'login'));
Router::connect('/authorize', array('plugin' => 'paszport', 'controller' => 'passports', 'action' => 'authorize'));
Router::connect('/forgot', array('plugin' => 'paszport', 'controller' => 'users', 'action' => 'forgot'));
Router::connect('/register', array('plugin' => 'paszport', 'controller' => 'users', 'action' => 'add'));

Router::redirect('/zaloguj', array('plugin' => 'paszport', 'controller' => 'users', 'action' => 'login'));
Router::redirect('/logowanie', array('plugin' => 'paszport', 'controller' => 'users', 'action' => 'login'));
Router::redirect('/paszport/users/failed', array('plugin' => 'paszport', 'controller' => 'users', 'action' => 'login'));
