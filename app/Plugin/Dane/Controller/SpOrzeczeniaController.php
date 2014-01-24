<?php

App::uses('DataobjectsController', 'Dane.Controller');

class SpOrzeczeniaController extends DataobjectsController
{
    public $menu = array(
        array(
            'id' => 'view',
            'label' => 'LC_DANE_TRESC',
        )
    );

    public function view()
    {
        parent::view();
        $this->set('bloki', $this->object->loadLayer('bloki'));
    }
} 