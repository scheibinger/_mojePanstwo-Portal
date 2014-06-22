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
        $powiazania = $this->object->loadLayer('powiazania');
        
        if(
        	isset( $powiazania['posel_id'] ) && 
        	$powiazania['posel_id'] 
        ) {
	        
	        return $this->redirect('/dane/poslowie/' . $powiazania['posel_id'] . '/finanse');
	        
        }
        
        $this->object->loadLayer('organizacje');
    }
}