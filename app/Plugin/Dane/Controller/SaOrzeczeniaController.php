<?php

App::uses('DataobjectsController', 'Dane.Controller');

class SaOrzeczeniaController extends DataobjectsController
{
    public $menu = array(
        array(
            'id' => 'view',
            'label' => 'LC_DANE_ORZECZENIE',
        ),
    );

    public function view()
    {
        parent::view();
        $this->set('html', $this->object->loadLayer('html'));
    }
} 