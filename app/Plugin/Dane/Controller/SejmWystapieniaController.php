<?php

App::uses('DataobjectsController', 'Dane.Controller');

class SejmWystapieniaController extends DataobjectsController
{
    public $menu = array();

    public function view()
    {
        parent::view();
        $html = $this->object->loadLayer('html');
        $this->set('html', $html);
    }
} 