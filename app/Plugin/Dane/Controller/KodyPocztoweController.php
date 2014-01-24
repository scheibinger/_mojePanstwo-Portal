<?php

App::uses('DataobjectsController', 'Dane.Controller');

class KodyPocztoweController extends DataobjectsController
{
    public $menu = array();

    public function view()
    {
        parent::view();
        $this->set('obszary', $this->object->loadLayer('obszary'));
    }
} 