<?php

App::uses('DataobjectsController', 'Dane.Controller');

class SejmPosiedzeniaPunktyController extends DataobjectsController
{
    public $uses = array('Dane.Dataobject');
    public $helpers = array('Dane.Dataobject');
    public $menu = array();
    public $autoRelated = false;
    
    public $objectOptions = array(
    	'hlFields' => array('sejm_posiedzenia.tytul', 'numer'),
    );

    public function view()
    {

        parent::view();
        $this->object->loadRelated();
        $debaty = $this->object->getRelatedGroup('debaty');
        
        if( $debaty && isset($debaty['objects']) && !empty($debaty['objects']) ) {
	        
	        $debata = $debaty['objects'][0];
	        $this->redirect('/dane/sejm_debaty/' . $debata->getId());
	        
        } return false;

    }

} 