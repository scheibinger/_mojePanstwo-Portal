<?php

App::uses('DataobjectsController', 'Dane.Controller');

class SpTezyController extends DataobjectsController
{
    public $menu = array(
        array(
            'id' => 'view',
            'label' => 'LC_DANE_DOKUMENT'
        ),
    );

    public function view()
    {
        parent::_prepareView();
    }
} 