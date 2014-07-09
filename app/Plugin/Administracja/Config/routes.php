<?php
Router::connect('/administracja', array('plugin' => 'Administracja', 'controller' => 'administracja', 'action' => 'index'));
Router::connect('/administracja/szukaj', array('plugin' => 'Administracja', 'controller' => 'administracja', 'action' => 'search'));
Router::connect('/administracja/:action', array('plugin' => 'Administracja', 'controller' => 'administracja'));