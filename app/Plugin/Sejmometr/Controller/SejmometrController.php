<?php

class SejmometrController extends SejmometrAppController
{
	
	public $helpers = array('Dane.DataobjectsSlider', 'Dane.Dataobject', 'Dane.Filter');
	public $components = array('RequestHandler');

    private function klub_img_src($klub_id) {
        return "http://resources.sejmometr.pl/s_kluby/" . $klub_id . "_a_t.png";
    }
	
    public function index()
    {
		$API = $this->API->Dane();
		
		// LISTA POSLOW 4x7
        $poslowie_base_url =
        $poslowie = array_fill(0, 12, array(
            'imie' => 'Adam',
            'nazwisko' => 'Abramowicz',
            'url' => Router::url(array('plugin' => 'dane', 'controller' => 'poslowie', 'action' => 'view', 1)),
            'klub_img_src' => $this->klub_img_src(2),
            'klub' => 'Prawo i Sprawiedliwość',
        ));
		
		// OSTATNIE POSIEDZENIE
		$posiedzenie = $API->searchDataset('sejm_posiedzenia', array(
			'order' => 'data_stop desc',
			'limit' => 1,
		));
		
		$posiedzenie = $API->getObjects();
		$posiedzenie = $posiedzenie[0];
		$related = $posiedzenie->loadRelated();
				
		$this->set(compact('posiedzenie', 'poslowie'));
		

    }
    
    public function posiedzenia_timeline()
    {
	    
	    $output = array(
            'timeline' => array(
                'headline' => 'Posiedzenia Sejmu RP',
                'type' => 'default',
                'date' => array(),
            ),
        );
        
        
	    $API = $this->API->Dane();
		$API->searchDataset('sejm_posiedzenia', array(
			'order' => 'data_stop desc',
			'limit' => 100,
		));
		
		foreach( $API->getObjects() as $object )
		{
	    		    	
	    	$startDate = $object->getData('data_start');
            $dateParts = explode('-', $startDate);
            $startDate = $dateParts[0] . ',' . $dateParts[1] . ',' . $dateParts[2];
            
            $stopDate = $object->getData('data_stop');
            $dateParts = explode('-', $stopDate);
            $stopDate = $dateParts[0] . ',' . $dateParts[1] . ',' . $dateParts[2];

            if (!$object->getData('komunikat_id')) {
                $asset = array( /*IMAGE DONT EXIST - DEFAULT IMG*/
                    'media' => '/Sejmometr/img/default.jpg',
                    'thumbnail' => '/Sejmometr/img/default-thumbnail.jpg',
                    'credit' => '',
                );
            } else {
                $asset = array( /*PATH TO EXIST IMAGES*/
                    'media' => 'http://resources.sejmometr.pl/sejm_komunikaty/img/' . $object->getData('komunikat_id') . '-0.jpg',
                    'thumbnail' => 'http://resources.sejmometr.pl/sejm_komunikaty/img/' . $object->getData('komunikat_id') . '-1.jpg',
                    'credit' => '® Kancelaria Sejmu',
                );
            }

            $output['timeline']['date'][] = array(
	            'startDate' => $startDate,
	            'endDate' => $stopDate,
	            'headline' => '#' . $object->getData('numer'),
	            'text' => '<p>Statystyki posiedzenia</p>',
	            'classname' => 'klasa',
                'asset' => $asset,
            );
        
        }
        
        $this->set('data', $output);
        $this->set('_serialize', 'data');
	    
    }
    
    public function szukaj()
    {
	    
	    $this->API = $this->API->Dane();
	    $this->dataBrowser = $this->Components->load('Dane.DataobjectsBrowser', array(
            'source' => 'app:3',
            'title' => 'Szukaj w pracach Sejmu',
            'noResultsTitle' => 'Brak wyników',
        ));
	    	    
    }
    
    public function autorzy_projektow()
    {
	    
	    $this->API = $this->API->Sejmometr();
	    $data = $this->API->autorzy_projektow();
	    
	    $this->set('data', $data);
	    $this->set('_serialize', 'data');
	    
    }

}