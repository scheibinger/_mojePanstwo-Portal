<?php

class UstawyController extends AppController
{
    public $components = array(
        'Session',
        'RequestHandler'
    );

    public function index()
    {

		
		$api = $this->API->Dane();
		$data = array();
		
		
		// NIEDAWNO WESZŁY
		
        $api->searchDataset('ustawy', array(
	        'conditions' => array(
	        	'data_wejscia_w_zycie' => '[* TO NOW/DAY]',
	        ),
	        'limit' => 5,
	        'order' => 'data_wejscia_w_zycie desc',
        ));
        $data['niedawno_weszly'] = $api->getObjects();
        
        
        
        // NIEDŁUGO WEJDĄ
        
        $api->searchDataset('ustawy', array(
	        'conditions' => array(
	        	'data_wejscia_w_zycie' => '[NOW/DAY TO *]',
	        ),
	        'limit' => 5,
	        'order' => 'data_wejscia_w_zycie asc',
        ));
        $data['niedlugo_wejda'] = $api->getObjects();
        
        
        
        // KODEKSY
        
        $api->searchDataset('ustawy', array(
	        'conditions' => array(
	        	'status_id' => '1',
	        	'typ_id' => '3',
	        ),
	        'limit' => 15,
	        'order' => 'tytul_skrocony asc',
        ));
        $data['kodeksy'] = $api->getObjects();
        
        
        
        // KONSTYTUCJE
        
        $api->searchDataset('ustawy', array(
	        'conditions' => array(
	        	'status_id' => '1',
	        	'typ_id' => '2',
	        ),
	        'limit' => 15,
	        'order' => 'tytul_skrocony asc',
        ));
        $data['konstytucje'] = $api->getObjects();
                
        $this->set('data', $data);
        
        

    }

} 