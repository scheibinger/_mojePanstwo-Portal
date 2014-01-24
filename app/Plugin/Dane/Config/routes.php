<?php

//Router::connect('/dane', array('plugin' => 'Dane', 'controller' => 'datasets', 'action' => 'katalog'));

Router::connect('/dane', array('plugin' => 'Dane', 'controller' => 'datachannels', 'action' => 'index'));

Router::connect('/dane/szukaj', array('plugin' => 'Dane', 'controller' => 'dataobjects', 'action' => 'index'));
Router::connect('/dane/katalog', array('plugin' => 'Dane', 'controller' => 'datasets', 'action' => 'katalog'));
Router::connect('/dane/kanal/:alias', array('plugin' => 'Dane', 'controller' => 'datachannels', 'action' => 'view'));

Router::connect('/dane/:controller/:id', array('plugin' => 'Dane', 'action' => 'view'), array('id' => '[0-9]+'));
Router::connect('/dane/:controller/:id/:action/*', array('plugin' => 'Dane'), array('id' => '[0-9]+'));
Router::connect('/dane/:controller/:slug/:id', array('plugin' => 'Dane', 'controller' => 'dataobjects', 'action' => 'view'), array('id' => '[0-9]+'));

Router::connect('/dane/:alias', array('plugin' => 'Dane', 'controller' => 'datasets', 'action' => 'view'));
