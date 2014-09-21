<?php
Router::connect('/ktoturzadzi', array('plugin' => 'KtoTuRzadzi', 'controller' => 'KtoTuRzadzi', 'action' => 'index'));
Router::connect('/ktoturzadzi/szukaj', array('plugin' => 'KtoTuRzadzi', 'controller' => 'KtoTuRzadzi', 'action' => 'search'));
Router::connect('/ktoturzadzi/:action', array('plugin' => 'KtoTuRzadzi', 'controller' => 'KtoTuRzadzi'));