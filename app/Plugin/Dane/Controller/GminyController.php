<?php

App::uses('DataobjectsController', 'Dane.Controller');

class GminyController extends DataobjectsController
{
	
	/*
	 array(
            'label' => 'LC_DANE_START',
            'id' => 'view',
        ),
        array(
            'label' => 'LC_DANE_RADNI_GMINY',
            'id' => 'radni',
        ),
        array(
            'label' => 'LC_DANE_WSKAZNIKI',
            'id' => 'wskazniki',
        ),
        array(
            'label' => 'LC_DANE_ZAMOWIENIA_PUBLICZNE',
            'id' => 'zamowienia_publiczne',
        ),
        array(
            'label' => 'LC_DANE_MAPA',
            'id' => 'map',
        ),
    */
	
    public $menu = array();

    public $helpers = array(
        'Number' => array(
            'className' => 'Dane.NumberPlus',
        ),
    );
    
    public $objectOptions = array(
    	'bigTitle' => true,
    );

    public function view()
    {
		
        parent::view();
        $menu = array(
	    	array(
	    		'id' => 'rada',
	    		'label' => 'Rada gminy',
	    	),
	    	/*
	    	array(
	    		'id' => 'wskazniki',
	    		'label' => 'Wskaźniki',
	    	),
	    	*/
	    	array(
	    		'id' => 'zamowienia_publiczne',
	    		'label' => 'Zamówienia publiczne',
	    	),
	    	array(
	    		'id' => 'dotacje_unijne',
	    		'label' => 'Dotacje unijne',
	    	),
	    	array(
	    		'id' => 'organizacje',
	    		'label' => 'Organizacje w gminie',
	    	),
	    );
	    
        $this->set('_menu', $menu);
        
        $this->object->loadLayer('rada_komitety');
        
        
        $this->API->searchDataset('zamowienia_publiczne', array(
            'limit' => 12,
            'conditions' => array(
                'gmina_id' => $this->object->getId(),
            ),
        ));
        $this->set('zamowienia', $this->API->getObjects());
                
        $this->API->searchDataset('dotacje_ue', array(
            'limit' => 12,
            'conditions' => array(
                'gmina_id' => $this->object->getId(),
            ),
        ));
        $this->set('dotacje_ue', $this->API->getObjects());
        
        $this->API->searchDataset('krs_podmioty', array(
            'limit' => 12,
            'conditions' => array(
                'gmina_id' => $this->object->getId(),
            ),
        ));
        $this->set('organizacje', $this->API->getObjects());
        
        
        
        if( $this->object->getId() == 903 )
        {
	        
	        // PRZEJRZYSTY KRAKÓW
	        
	        $this->API->searchDataset('rady_druki', array(
	            'limit' => 12,
	            'conditions' => array(
	                'gmina_id' => $this->object->getId(),
	            ),
	        ));
	        $this->set('rady_druki', $this->API->getObjects());
	        
	        
	        $this->API->searchDataset('rady_posiedzenia', array(
	            'limit' => 12,
	            'conditions' => array(
	                'gmina_id' => $this->object->getId(),
	            ),
	        ));
	        $this->set('rady_posiedzenia', $this->API->getObjects());
	        
	        
	        
	        $this->API->searchDataset('prawo_lokalne', array(
	            'limit' => 12,
	            'conditions' => array(
	                'gmina_id' => $this->object->getId(),
	            ),
	        ));
	        $this->set('prawo_lokalne', $this->API->getObjects());
	        
        }
        
        
        
        
        
        
        /*
        $wskazniki = $this->object->loadLayer('wskazniki');
        $rada_komitety = $this->object->loadLayer('rada_komitety');
        $wskazniki = array_slice($wskazniki, 0, 5, true);
		*/

        
    }


    public function posiedzenia()
    {
        parent::_prepareView();
        $this->dataobjectsBrowserView(array(
            'dataset' => 'rady_posiedzenia',
            'title' => 'Posiedzenia rady miasta',
            'noResultsTitle' => 'Brak posiedzeń',
            'hlFields' => $hl_fields = array('numer', 'liczba_debat'),
        ));
    }
    
    
    public function prawo()
    {
        parent::_prepareView();
        $this->dataobjectsBrowserView(array(
            'dataset' => 'prawo_lokalne',
            'title' => 'Akty prawa lokalnego',
            'noResultsTitle' => 'Brak danych',
            // 'hlFields' => $hl_fields = array('numer', 'liczba_debat'),
        ));
    }
    
    
    public function druki()
    {
        parent::_prepareView();
        $this->dataobjectsBrowserView(array(
            'dataset' => 'rady_druki',
            'title' => 'Materiały na posiedzenia rady miasta',
            'noResultsTitle' => 'Brak danych',
            // 'hlFields' => $hl_fields = array('numer', 'liczba_debat'),
        ));
    }
    
    
    public function radni()
    {
        parent::_prepareView();
        $this->dataobjectsBrowserView(array(
            'source' => 'gminy.radni:' . $this->object->getId(),
            'dataset' => 'radni_gmin',
            'title' => 'Radni gminy',
            'noResultsTitle' => 'Brak radnych dla tej gminy',
            'excludeFilters' => array(
                'gmina_id', 'gminy.powiat_id', 'gminy.wojewodztwo_id'
            ),
            'hlFields' => array('rady_gmin_komitety.nazwa', 'liczba_glosow', 'procent_glosow_w_okregu', 'oswiadczenie_id'),
        ));
    }
    
    
    public function darczyncy()
    {
        parent::_prepareView();
        $this->dataobjectsBrowserView(array(
            'dataset' => 'wybory_darczyncy',
            'title' => 'Wpłaty na komitety wyborcze',
            'noResultsTitle' => 'Brak danych',            
        ));
    }
      

    public function wskazniki()
    {
        parent::_prepareView();
        $this->innerSearch('bdl_wskazniki', array(
            'fields' => 'id, dataset, object_id, score, _data_*',
            '_multidata_gmina_id' => $this->object->object_id,
        ), array(
            'searchTitle' => sprintf(__d('dane', 'LC_DANE_WSKAZNIKI_W_GMINIE'), $this->object->getData('nazwa')),
        ));
    }

    public function zamowienia()
    {
        parent::_prepareView();
        $this->dataobjectsBrowserView(array(
            'source' => 'gminy.zamowienia_publiczne:' . $this->object->getId(),
            'dataset' => 'zamowienia_publiczne',
            'title' => 'Zamówienia publiczne',
            'noResultsTitle' => 'Brak zamówień dla tej gminy',
            'excludeFilters' => array(
                'gmina_id',
            ),
        ));
    }
    
    public function organizacje()
    {
        parent::_prepareView();
        $this->dataobjectsBrowserView(array(
            'source' => 'gminy.organizacje:' . $this->object->getId(),
            'dataset' => 'krs_podmioty',
            'title' => 'Organizacje',
            'noResultsTitle' => 'Brak organizacji w tej gminie',
            'excludeFilters' => array(
                'gmina_id',
            ),
        ));
    }
    
    public function dotacje_ue()
    {
        parent::_prepareView();
        $this->dataobjectsBrowserView(array(
            'source' => 'gminy.dotacje_ue:' . $this->object->getId(),
            'dataset' => 'dotacje_ue',
            'title' => 'Dotacje unijne',
            'noResultsTitle' => 'Brak dotacji dla tej gminy',
            'excludeFilters' => array(
                'gmina_id',
            ),
        ));
    }

    public function rady_gmin_wystapienia()
    {
        parent::_prepareView();

        $title_for_layout = 'Wystąpienia podczas wszystkich posiedzeń rady gminy ' . $this->object->getData('nazwa');
        $this->innerSearch('rady_gmin_wystapienia', array('rady_gmin_debaty.gmina_id' => $this->object->getId()), array(
            'searchTitle' => $title_for_layout,
        ));
        $this->set('title_for_layout', $title_for_layout);
    }


    public function map()
    {
        parent::_prepareView();
        $this->set('spat', $this->object->loadLayer('enspat'));
    }



	/*
    public function prepareMenu()
    {
        if ($this->object->getId() == '903') {


            $this->menu = array(
                array(
                    'label' => 'LC_DANE_START',
                    'id' => 'view',
                ),
                array(
                    'label' => 'Radni gminy',
                    'id' => 'radni',
                ),
                array(
                    'label' => 'Prawo lokalne',
                    'id' => 'prawo_lokalne',
                ),
                array(
                    'label' => 'Darczyńcy komitetów wyborczych',
                    'id' => 'darczyncy',
                ),
                array(
                    'label' => 'LC_DANE_WSKAZNIKI',
                    'id' => 'wskazniki',
                ),
                array(
                    'label' => 'LC_DANE_ZAMOWIENIA_PUBLICZNE',
                    'id' => 'zamowienia_publiczne',
                ),
                array(
                    'label' => 'LC_DANE_MAPA',
                    'id' => 'map',
                ),
            );


        }
    }
    */
} 