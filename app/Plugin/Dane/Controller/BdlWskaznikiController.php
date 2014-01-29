<?php

App::uses('DataobjectsController', 'Dane.Controller');

class BdlWskaznikiController extends DataobjectsController
{
	
	public $menu = array();
	public $components = array('RequestHandler');
	
    public function view()
    {

        parent::_prepareView();
        
        $expand_dimension = isset( $this->request->query['i'] ) ? (int) $this->request->query['i'] : $this->object->getData('i');
		$dims = $this->object->loadLayer('dimennsions');
		$expanded_dimension = array();
		
		
		
		// building dimmensions array (it will be usefull as a parameter for future API calls
		
		$dimmensions_array = array();
		for( $d=0; $d<5; $d++ )
		{
			
			$dvalue = 0;
			
			if( $d != $expand_dimension )			
		  		$dvalue = isset( $this->request->query['d' . $d] ) ? 
		  			(int) $this->request->query['d' . $d] : 
		  			(int) @$dims[ $d ]['options'][0]['id'];
							
			$dimmensions_array[] = $dvalue;
			
		}
		
		
		
		
		
		
		// Setting selected dimmension
		
		$i = 0;
		foreach( $dims as &$dim ) {
		
			foreach( $dim['options'] as &$option )			
				$option['selected'] = ( $option['id'] == $dimmensions_array[$i] );
			
			if( $expand_dimension == $i )
			{
				
				$expanded_dimension = $dim;
				$params_dimmensions = array();
				
				foreach( $expanded_dimension['options'] as &$option )
		    	{
		    		
		    		$temp_dimmensions_array = $dimmensions_array;
		    		$temp_dimmensions_array[ $i ] = (int) $option['id'];	    		
		    		$params_dimmensions[] = $temp_dimmensions_array;
		    		$option['dim_str'] = implode(',', $temp_dimmensions_array);

		    	}
				
				$data_for_dimmensions = $this->API->BDL()->getDataForDimmesions( $params_dimmensions );
				if( !empty($data_for_dimmensions) )
					foreach( $data_for_dimmensions as $data )
						foreach( $expanded_dimension['options'] as &$option )
							if( $data['dim_str'] == $option['dim_str'] )
							{
								
								$option['data'] = $data;
								break;
								
							}
								
			}
			
			$i++;
		}
				
			
		$this->set('dims', $dims);
		$this->set('expand_dimension', $expand_dimension);
		$this->set('expanded_dimension', $expanded_dimension);
		$this->set('dimmensions_array', $dimmensions_array);

    }
    
    public function data_for_dimmensions()
    {
				
	    $dims = isset($this->request->query['dims']) ? explode(';', $this->request->query['dims']) : array();
	    
	    $data = $this->API->BDL()->getDataForDimmesions( $dims );
	    
	    $this->set('data', $data);
	    $this->set('_serialize', array('data'));
	    
    }
} 