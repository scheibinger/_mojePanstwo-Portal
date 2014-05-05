<?php

Router::connect('/powiadomienia', array('plugin' => 'powiadomienia', 'controller' => 'powiadomienia', 'action' => 'index'));
Router::connect('/powiadomienia/uprawnienia', array('plugin' => 'powiadomienia', 'controller' => 'powiadomienia', 'action' => 'permissions'));
Router::connect('/powiadomienia/flagObjects', array('plugin' => 'powiadomienia', 'controller' => 'powiadomienia', 'action' => 'flagObjects'));

Router::connect('/powiadomienia/groups/:id', array('plugin' => 'Powiadomienia', 'controller' => 'Groups', 'action' => 'view'));


Router::connect('/powiadomienia/getApps', array('plugin' => 'powiadomienia', 'controller' => 'powiadomienia', 'action' => 'getApps'));
Router::mapResources('dataobjects');
Router::mapResources('phrases');