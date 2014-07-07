<?php

App::uses('DataobjectsController', 'Dane.Controller');

class AdministracjaPublicznaController extends DataobjectsController
{
    public $menu = array();

    public function view()
    {
        parent::view();
        $this->object->loadLayer('tree');
    }

} 