<?php
Router::connect('/prawo', array('plugin' => 'Prawo', 'controller' => 'prawo', 'action' => 'index'));
Router::connect('/ustawy/szukaj', array('plugin' => 'ustawy', 'controller' => 'ustawy', 'action' => 'search'));
Router::connect('/ustawy/:action', array('plugin' => 'ustawy', 'controller' => 'ustawy'));