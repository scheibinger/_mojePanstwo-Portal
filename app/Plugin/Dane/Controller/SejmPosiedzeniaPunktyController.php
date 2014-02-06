<?php

App::uses('DataobjectsController', 'Dane.Controller');

class SejmPosiedzeniaPunktyController extends DataobjectsController
{
    public $uses = array('Dane.Dataobject');
    public $menu = array(
        /*
        array(
            'id' => 'view',
            'label' => 'LC_DANE_INFORMACJE',
        ),
        */
        array(
            'id' => 'view',
            'label' => 'Szukaj w tym punkcie',
        ),
        
    );

    public function view()
    {

        parent::view();
        
    }

    
} 