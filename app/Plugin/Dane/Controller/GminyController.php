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
        
        
        
        
        
        
        /*
        $wskazniki = $this->object->loadLayer('wskazniki');
        $rada_komitety = $this->object->loadLayer('rada_komitety');
        $wskazniki = array_slice($wskazniki, 0, 5, true);

        if ($this->object->getId() == '903') {


            $this->API->searchDataset('prawo_lokalne', array(
                'limit' => 3,
            ));
            $this->set('prawo_lokalne', $this->API->getObjects());


            $this->API->searchDataset('rady_posiedzenia', array(
                'limit' => 6,
            ));
            $this->set('rady_posiedzenia', $this->API->getObjects());


            $this->API->searchDataset('rady_druki', array(
                'limit' => 6,
            ));
            $this->set('rady_druki', $this->API->getObjects());


        }


        $this->API->searchDataset('zamowienia_publiczne', array(
            'limit' => 16,
            'conditions' => array(
                'gmina_id' => $this->object->getId(),
            ),
        ));
        $this->set('zamowienia_publiczne', $this->API->getObjects());


        $this->API->searchDataset('radni_gmin', array(
            'limit' => 16,
            'conditions' => array(
                'gmina_id' => $this->object->getId(),
            ),
        ));
        $this->set('radni', $this->API->getObjects());


        $this->set(compact('wskazniki', 'rada_komitety'));
        */
        
        
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

    public function prawo_lokalne()
    {
        parent::_prepareView();

        $title_for_layout = 'Prawo lokalne w gminie ' . $this->object->getData('nazwa');
        $this->innerSearch('prawo_lokalne', array('gmina_id' => $this->object->getId()), array(
            'searchTitle' => $title_for_layout,
        ));
        $this->set('title_for_layout', $title_for_layout);
    }

    public function darczyncy()
    {
        parent::_prepareView();

        $title_for_layout = 'Darczyńcy komitetów wyborczych w gminie ' . $this->object->getData('nazwa');
        $this->innerSearch('wybory_darczyncy', array(), array(
            'searchTitle' => $title_for_layout,
        ));
        $this->set('title_for_layout', $title_for_layout);
    }


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
} 