<?php
Router::connect('/krs', array('plugin' => 'Krs', 'controller' => 'organizacje', 'action' => 'index'));
Router::connect('/krs/szukaj', array('plugin' => 'Krs', 'controller' => 'organizacje', 'action' => 'search'));
Router::connect('/krs/:action', array('plugin' => 'Krs', 'controller' => 'organizacje'));