<?php

App::uses('DataobjectsController', 'Dane.Controller');

class SejmDebatyController extends DataobjectsController
{
    public $uses = array('Dane.Dataobject');
    public $menu = array();
	public $breadcrumbsMode = 'app';

    public function view()
    {
        parent::view();
        
        $this->object->loadLayer('nav');
        
        $stenogram = $this->object->loadLayer('stenogram');
        $this->set(compact('stenogram'));
    }
} 