<?php

App::uses('DataobjectsController', 'Dane.Controller');

class CoeSittingsController extends DataobjectsController
{
    public $menu = array();

    public function view()
    {
        parent::view();
        $this->object->loadLayer('text');
    }
}