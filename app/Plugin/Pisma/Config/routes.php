<?php

$pisma_prefix = '/pisma';

Router::connect("$pisma_prefix", array('plugin' => 'Pisma', 'controller' => 'Pisma', 'action' => 'home', '[method]' => 'GET'));
Router::connect("$pisma_prefix/new", array('plugin' => 'Pisma', 'controller' => 'Pisma', 'action' => 'add', '[method]' => 'POST'));
Router::connect("$pisma_prefix/new", array('plugin' => 'Pisma', 'controller' => 'Pisma', 'action' => 'create', '[method]' => 'GET'));
Router::connect("$pisma_prefix/:id", array('plugin' => 'Pisma', 'controller' => 'Pisma', 'action' => 'edit'), array('id' => '[0-9]+', 'pass' => array('id')));

