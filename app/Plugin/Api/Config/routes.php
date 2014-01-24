<?php

Router::connect('/api', array('plugin' => 'api', 'controller' => 'api_pages', 'action' => 'view', 'start'));
Router::connect('/api/dane/*', array('plugin' => 'api', 'controller' => 'api_pages', 'action' => 'dane'));
Router::connect('/api/*', array('plugin' => 'api', 'controller' => 'api_pages', 'action' => 'view'));