<?php

App::uses('DataobjectsController', 'Dane.Controller');

class KrsOsobyController extends DataobjectsController
{
    public $menu = array();
    public $helpers = array(
        'Time',
    );
	
	public $objectOptions = array(
		'hlFields' => array(),
	);
	
    public function view()
    {
        parent::view();
        $this->object->loadLayer('organizacje');
    }
}