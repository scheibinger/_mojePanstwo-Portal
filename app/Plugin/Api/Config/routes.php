<?php

Router::connect('/api', array('plugin' => 'api', 'controller' => 'api', 'action' => 'index'));
Router::connect('/api/:slug', array('plugin' => 'api', 'controller' => 'api', 'action' => 'view'), array('pass' => array('slug')));