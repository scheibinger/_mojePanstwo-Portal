<?php

class SejmometrController extends SejmometrAppController
{
	
	public $helpers = array('Dane.dataobjectsSlider', 'Dane.Dataobject');
	
    public function index()
    {
		
		$API = $this->API->Dane();
		
		
		
		// OSTATNIE POSIEDZENIE
		
		$posiedzenie = $API->searchDataset('sejm_posiedzenia', array(
			'order' => 'data_stop desc',
			'limit' => 1,
		));
		
		$posiedzenie = $API->getObjects();
		$posiedzenie = $posiedzenie[0];
		$related = $posiedzenie->loadRelated();
				
		$this->set('posiedzenie', $posiedzenie);
		

    }

}