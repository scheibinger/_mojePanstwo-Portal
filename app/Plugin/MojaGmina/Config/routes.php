<?php

Router::connect(
    '/moja_gmina/search',
    array(
    	'plugin' => 'MojaGmina',
    	'controller' => 'MojaGmina',
    	'action' => 'search',
    )
);

Router::mapResources('MojaGmina.geo');
Router::parseExtensions();