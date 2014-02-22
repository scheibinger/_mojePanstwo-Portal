<?php

App::uses('DataobjectsController', 'Dane.Controller');

class DotacjeUEController extends DataobjectsController
{
    public $menu = array();
	public $objectOptions = array(
		'hlFields' => array('symbol'),
	);
	
    public function view()
    {

        parent::view();

    }
}