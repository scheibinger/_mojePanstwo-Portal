<?php

App::uses('DataobjectsController', 'Dane.Controller');

class RadniGminController extends DataobjectsController
{
    public $menu = array();
	
	public $objectOptions = array(
        'hlFields' => array(),
    );
	
    public function view()
    {
        parent::view();
        
        $this->API->searchDataset('rady_gmin_wystapienia', array(
            'limit' => 12,
            'conditions' => array(
                'radny_id' => $this->object->getId(),
            ),
        ));
        $this->set('wystapienia', $this->API->getObjects());
    }
} 