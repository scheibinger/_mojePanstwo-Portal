<?php

class MojaGminaController extends AppController
{
    public $uses = array();
    public $components = array('RequestHandler');

    public function index()
    {

        $application = $this->getApplication();
        $this->set('title_for_layout', $application['Application']['name']);
        
        if(
        	( $q = @$this->request->query['q'] ) &&
	        ( $gminy = $this->MojaGmina->search($q, 1) ) &&
	        ( !empty($gminy) ) && 
	        ( $gmina = $gminy[0] )
	    )
			$this->redirect('/dane/gminy/' . $gmina->getId());

    }
    
    public function search()
    {
    	
    	$output = array();
    	
    	if(
        	( $q = @$this->request->query['q'] ) &&
	        ( $gminy = $this->MojaGmina->search($q, 10) ) &&
	        ( !empty($gminy) ) 
	    )
	    {		    
		    foreach( $gminy as $gmina )
		    	$output[] = array(
		    		'id' => $gmina->getId(),
		    		'nazwa' => $gmina->getData('nazwa'),
		    		'typ' => $gmina->getData('typ_nazwa'),
		    	);
	    }
	    
	    $this->set('output', $output);
	    $this->set('_serialize', 'output');
	    
    }
} 