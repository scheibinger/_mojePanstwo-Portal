<?php

App::uses('DataobjectsController', 'Dane.Controller');

class BdlWskaznikiController extends DataobjectsController
{
	
	public $menu = array();
	public $components = array('RequestHandler');
	
    public function view()
    {

        parent::_prepareView();
        
        $expand_dimmension = isset( $this->request['i'] ) ? (int) $this->request['i'] : $this->object->getData('i');
		$dims = $this->object->loadLayer('dimennsions');
		
		
		
		
		// building dimmensions array (it will be usefull as a parameter for future API calls
		
		$dimmensions_array = array();
		for( $d=0; $d<5; $d++ )
		{
			
			$dvalue = 0;
			
			if( $d==$expand_dimmension )
			{
				/*
				if( $kombinacja )
				{
		  		
		  			$v = $d + 1;
		  		
		  			foreach( $dims[$d]['options'] as $o )
		  				if( $o['id']==$kombinacja['wymiar']['w' . $v] )
		  					$kombinacja['value'] = $o['value'];
		  		
				}
				*/
			}
			else
			{
			
		  		$dvalue = isset( $this->request['d' . $d] ) ? 
		  			(int) $this->request['d' . $d] : 
		  			(int) @$dims[ $d ]['options'][0]['id'];
				
			}
			
			$dimmensions_array[] = $dvalue;
		}
		
		
		
		
		
		
		// Setting selected dimmension
		
		$i = 0;
		foreach( $dims as &$dim ) {
		
			foreach( $dim['options'] as &$option )			
				$option['selected'] = ( $option['id'] == $dimmensions_array[$i] );
				
			$i++;
		}
				
		
			
		$this->set('dims', $dims);
		$this->set('expanded_dim', $expand_dimmension);
		$this->set('dimmensions_array', $dimmensions_array);

    }
    
    public function data_for_dimmensions()
    {
	    
	    $data = array();
	    
	    $this->set('data', $data);
	    $this->set('_serialize', array('data'));
	    
    }
} 