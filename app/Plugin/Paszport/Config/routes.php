<?php

Router::connect('/paszport', array('plugin' => 'paszport', 'controller' => 'pages', 'action' => 'home'));
Router::connect('/login', array('plugin' => 'paszport', 'controller' => 'users', 'action' => 'login'));
Router::connect('/fblogin', array('plugin' => 'paszport', 'controller' => 'users', 'action' => 'fblogin'));
Router::connect('/logout', array('plugin' => 'paszport', 'controller' => 'users', 'action' => 'logout'));
Router::connect('/authorize', array('plugin' => 'paszport', 'controller' => 'passports', 'action' => 'authorize'));
Router::connect('/forgot', array('plugin' => 'paszport', 'controller' => 'users', 'action' => 'forgot'));
Router::connect('/register', array('plugin' => 'paszport', 'controller' => 'users', 'action' => 'add'));

Router::redirect('/zaloguj', array('plugin' => 'paszport', 'controller' => 'users', 'action' => 'login'));
Router::redirect('/logowanie', array('plugin' => 'paszport', 'controller' => 'users', 'action' => 'login'));
Router::redirect('/paszport/users/failed', array('plugin' => 'paszport', 'controller' => 'users', 'action' => 'login'));
Router::redirect('/pages/fblogin', array('plugin' => 'paszport', 'controller' => 'users', 'action' => 'fblogin'));
