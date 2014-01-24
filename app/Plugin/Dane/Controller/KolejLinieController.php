<?php

App::uses('DataobjectsController', 'Dane.Controller');

class KolejLinieController extends DataobjectsController
{
    public $menu = array();

    public function view()
    {
        parent::view();
        $this->object->loadLayer('rozklad');
    }
} 