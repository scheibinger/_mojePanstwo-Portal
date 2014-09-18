<?php

//Router::connect('/dane', array('plugin' => 'Dane', 'controller' => 'datasets', 'action' => 'katalog'));

Router::connect('/dane', array('plugin' => 'Dane', 'controller' => 'datasets', 'action' => 'index'));
Router::connect('/dane/szukaj', array('plugin' => 'Dane', 'controller' => 'dataobjects', 'action' => 'index'));
Router::connect('/dane/suggest', array('plugin' => 'Dane', 'controller' => 'dataobjects', 'action' => 'suggest'));

Router::connect('/dane/kanal/:alias', array('plugin' => 'Dane', 'controller' => 'datachannels', 'action' => 'view'));

Router::connect('/dane/:controller/:id', array('plugin' => 'Dane', 'action' => 'view'), array('id' => '[0-9]+'));

Router::connect('/dane/bdl_wskazniki/:id/:dim_id', array('plugin' => 'Dane', 'controller' => 'bdl_wskazniki', 'action' => 'view_dimension'), array('id' => '[0-9]+', 'dim_id' => '[0-9]+'));
Router::connect('/dane/bdl_wskazniki/:id/:dim_id/:level', array('plugin' => 'Dane', 'controller' => 'bdl_wskazniki', 'action' => 'view_dimension'), array('id' => '[0-9]+', 'dim_id' => '[0-9]+', 'level'));

Router::connect('/dane/sejm_interpelacje/:id/:t_id', array('plugin' => 'Dane', 'controller' => 'sejm_interpelacje', 'action' => 'view'), array('id' => '[0-9]+', 't_id' => '[0-9]+'));


Router::connect('/dane/:controller/:id/:action/*', array('plugin' => 'Dane'), array('id' => '[0-9]+'));
Router::connect('/dane/:controller/:slug/:id', array('plugin' => 'Dane', 'controller' => 'dataobjects', 'action' => 'view'), array('id' => '[0-9]+'));

Router::connect('/dane/:alias', array('plugin' => 'Dane', 'controller' => 'datasets', 'action' => 'view'));


