<?php

App::uses('DataobjectsController', 'Dane.Controller');

class CoeSittingsController extends DataobjectsController
{
    public $menu = array();

    public $objectOptions = array(
        'buttons' => array('shoutIt', 'careIt'),
    );

    public function view()
    {
        parent::view();
        $this->object->loadLayer('text');
    }
}