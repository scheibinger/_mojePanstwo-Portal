<?php

Router::connect('/powiadomienia', array('plugin' => 'powiadomienia', 'controller' => 'powiadomienia', 'action' => 'index'));
Router::connect('/powiadomienia/uprawnienia', array('plugin' => 'powiadomienia', 'controller' => 'powiadomienia', 'action' => 'permissions'));
Router::mapResources('dataobjects');
Router::mapResources('phrases');
Router::parseExtensions();