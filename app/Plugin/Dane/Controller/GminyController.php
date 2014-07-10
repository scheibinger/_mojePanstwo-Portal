<?php

App::uses('DataobjectsController', 'Dane.Controller');

class GminyController extends DataobjectsController
{
	
	public $breadcrumbsMode = 'app';
	
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
        $szef = $this->object->loadLayer('szef');

        $this->API->searchDataset('zamowienia_publiczne', array(
            'limit' => 8,
            'conditions' => array(
                'gmina_id' => $this->object->getId(),
                'status_id' => '0',
            ),
        ));
        $this->set('zamowienia_otwarte', $this->API->getObjects());
        
        $this->API->searchDataset('zamowienia_publiczne', array(
            'limit' => 8,
            'conditions' => array(
                'gmina_id' => $this->object->getId(),
                'status_id' => '2',
            ),
        ));
        $this->set('zamowienia_zamkniete', $this->API->getObjects());
        

       

        $this->API->searchDataset('krs_podmioty', array(
            'limit' => 5,
            'conditions' => array(
                'gmina_id' => $this->object->getId(),
                'forma_prawna_typ_id' => '1',
                'wykreslony' => '0',
            ),
            'order' => 'wartosc_kapital_zakladowy desc'
        ));
        $this->set('organizacje', $this->API->getObjects());
        
        $this->API->searchDataset('krs_podmioty', array(
            'limit' => 0,
            'conditions' => array(
                'gmina_id' => $this->object->getId(),
                'forma_prawna_typ_id' => '2',
                'wykreslony' => '0',
            ),
            'facets' => 1,
        ));
        
        $data = $this->API->getFacets();
        $ngos = array();
        
        foreach( $data as $d ) {
	        if( $d['field'] == 'forma_prawna_id' ) {
		        $ngos = $d['params']['options'];
		        break;
	        }
        }
        unset( $data );
        $this->set('ngos', $ngos);
        



        if ($this->object->getId() == 903) {

            // PRZEJRZYSTY KRAKÓW
			
			/*
            $this->API->searchDataset('rady_druki', array(
                'limit' => 12,
                'conditions' => array(
                    'gmina_id' => $this->object->getId(),
                ),
            ));
            $this->set('rady_druki', $this->API->getObjects());
			*/

            $this->API->searchDataset('rady_posiedzenia', array(
                'limit' => 12,
                'conditions' => array(
                    'gmina_id' => $this->object->getId(),
                ),
            ));
            $this->set('rady_posiedzenia', $this->API->getObjects());


            $this->API->searchDataset('prawo_lokalne', array(
                'limit' => 8,
                'conditions' => array(
                    'gmina_id' => $this->object->getId(),
                ),
            ));
            $this->set('prawo_lokalne', $this->API->getObjects());
            
            /*
            $this->API->searchDataset('dzielnice', array(
                'limit' => 100,
                'conditions' => array(
                    'gmina_id' => $this->object->getId(),
                ),
            ));
            $this->set('dzielnice', $this->API->getObjects());
			*/
			
        }


        /*
        $wskazniki = $this->object->loadLayer('wskazniki');
        $rada_komitety = $this->object->loadLayer('rada_komitety');
        $wskazniki = array_slice($wskazniki, 0, 5, true);
		*/


    }


    public function okregi_wyborcze()
    {
    
        parent::_prepareView();
        $this->request->params['action'] = 'wybory';
		
    	if( isset($this->request->params['pass'][0]) && is_numeric($this->request->params['pass'][0]) ) {
	    	
	    	$okreg = $this->API->getObject('gminy_okregi_wyborcze', $this->request->params['pass'][0]);
			$okreg->loadLayer('kandydaci');
			
	    	$this->set('okreg', $okreg);
	        $this->set('title_for_layout', $okreg->getTitle());
	    	$this->render('okreg_wyborczy');
	        
    	
    	} else {
    	
	        $this->dataobjectsBrowserView(array(
	            'source' => 'gminy.okregi_wyborcze:' . $this->object->getId(),
	            'dataset' => 'gminy_okregi_wyborcze',
	            'title' => 'Okręgi wyborcze w wyborach samorządowych 2010 r.',
	            'noResultsTitle' => 'Brak okręgów',
	            'routes' => array(
	            	'label' => false,
	            ),
	        ));
	        $this->set('title_for_layout', 'Okręgi wyborcze w gminie ' . $this->object->getData('nazwa'));
        
        }

    }
    
    public function interpelacje()
    {
    
        parent::_prepareView();
        $this->request->params['action'] = 'interpelacje';
		
    	if( isset($this->request->params['pass'][0]) && is_numeric($this->request->params['pass'][0]) ) {
	    	
	    	$interpelacja = $this->API->getObject('rady_gmin_interpelacje', $this->request->params['pass'][0]);
			$interpelacja->loadLayer('neighbours');
			$document = $this->API->document($interpelacja->getData('dokument_id'));
	    	$this->set('interpelacja', $interpelacja);
			$this->set('document', $document);
			$this->set('documentPackage', 1);
	        $this->set('title_for_layout', 'Interpelacja w sprawie ' . lcfirst( $interpelacja->getData('tytul') ));
	    	
	    	$this->render('interpelacja');
	    	
    	} else {
    	
	        $this->dataobjectsBrowserView(array(
	            'source' => 'gminy.interpelacje:' . $this->object->getId(),
	            'dataset' => 'rady_gmin_interpelacje',
	            'title' => 'Interpelacje',
	            'noResultsTitle' => 'Brak interpelacji',
	        ));
	        
	        $this->set('title_for_layout', 'Interpelacje radnych w gminie ' . $this->object->getData('nazwa'));
        
        }

    }
    
    public function posiedzenia()
    {
        parent::_prepareView();
    	$this->request->params['action'] = 'posiedzenia';
    	
    	if( isset($this->request->params['pass'][0]) && is_numeric($this->request->params['pass'][0]) ) {
    		    		
    		$posiedzenie = $this->API->getObject('rady_posiedzenia', $this->request->params['pass'][0]);    		
			$posiedzenie->loadLayer('neighbours');
	    	$this->set('posiedzenie', $posiedzenie);
			$this->set('title_for_layout', strip_tags($posiedzenie->getData('fullTitle')));
			
			$this->dataobjectsBrowserView(array(
	            'source' => 'rady_gmin_debaty.posiedzenie_id:' . $posiedzenie->getId(),
	            'dataset' => 'rady_gmin_debaty',
	            'title' => 'Debaty na tym posiedzeniu',
	            'noResultsTitle' => 'Brak debat na tym posiedzeniu',
	            /*
	            'excludeFilters' => array(
	                'grupa_id',
	                'kategoria_id',
	            ),
	            */
	            // 'hlFields' => array('numer_punktu', 'opis'),
	            'hlFields' => array(),
	            'routes' => array(
	                'date' => false,
	            ),
	            'limit' => 100,
	        ));
			
	    	$this->render('posiedzenie');
    	
    	} else {
    	
	        $this->dataobjectsBrowserView(array(
	            'dataset' => 'rady_posiedzenia',
	            'title' => 'Posiedzenia',
	            'noResultsTitle' => 'Brak posiedzeń',
	            'hlFields' => array('numer', 'liczba_debat'),
	        ));
	        
	        $this->set('title_for_layout', 'Posiedzenia rady miasta ' . $this->object->getData('nazwa'));
        
        }
    }
    
    public function debaty()
    {
    	$this->request->params['action'] = 'debaty';
        parent::_prepareView();
        
        if( isset($this->request->params['pass'][0]) && is_numeric($this->request->params['pass'][0]) ) {
        	
        	$debata = $this->API->getObject('rady_gmin_debaty', $this->request->params['pass'][0]);    		
			$debata->loadLayer('neighbours');
	    	$this->set('debata', $debata);
	    	
	    	$_wystapienia = $debata->loadLayer('wystapienia');
	        $wystapienia = array();
	        foreach( $_wystapienia as $wystapienie ) {
	            $wystapienia[$wystapienie['rady_posiedzenia_wystapienia']['id']] = array('mowca_str' => $wystapienie['rady_posiedzenia_wystapienia']['mowca_str'], 'video_start' => $wystapienie['rady_posiedzenia_wystapienia']['video_start']);
	        }
	        $this->set('wystapienia', $wystapienia);
	    	
			$this->set('title_for_layout', $debata->getTitle());
        	
        	$this->render('debata');
        	
        } else {
        
	        $this->dataobjectsBrowserView(array(
	            'dataset' => 'rady_gmin_debaty',
	            'title' => 'Debaty podczas posiedzeń',
	            'noResultsTitle' => 'Brak debat',
	            'hlFields' => array(),
	        ));
	        
	        $this->set('title_for_layout', 'Debaty na posiedzeniach rady gminy ' . $this->object->getData('nazwa'));
	        
        }
    }
    
    /*
    public function wystapienia()
    {
    	$this->request->params['action'] = 'rada_wystapienia';
        parent::_prepareView();
        $this->dataobjectsBrowserView(array(
            'dataset' => 'rady_gmin_wystapienia',
            'title' => 'Wystąpienia podczas posiedzeń',
            'noResultsTitle' => 'Brak wystąpień',
            'hlFields' => array(),
        ));
        
        $this->set('title_for_layout', 'Wystąpienia na posiedzeniach rady gminy ' . $this->object->getData('nazwa'));
    }
    */

    public function rada_uchwaly()
    {
        parent::_prepareView();
        $this->request->params['action'] = 'rada_uchwaly';
        
        if( isset($this->request->params['pass'][0]) && is_numeric($this->request->params['pass'][0]) ) {
			
			$uchwala = $this->API->getObject('prawo_lokalne', $this->request->params['pass'][0]);
			$uchwala->loadLayer('neighbours');
			$document = $this->API->document($uchwala->getData('dokument_id'));
	    	$this->set('uchwala', $uchwala);
			$this->set('document', $document);
			$this->set('documentPackage', 1);
	        $this->set('title_for_layout', $uchwala->getTitle());
	    	
	    	$this->render('rada_uchwala');
			
		} else {
        
	        $this->dataobjectsBrowserView(array(
	            'dataset' => 'prawo_lokalne',
	            'title' => 'Uchwały rady miasta',
	            'noResultsTitle' => 'Brak danych',
	            // 'hlFields' => $hl_fields = array('numer', 'liczba_debat'),
	        ));
	        $this->set('title_for_layout', 'Uchwały podjęte przez radę gminy ' . $this->object->getData('nazwa'));
        
        }
    }


    public function druki()
    {
        parent::_prepareView();
        $this->request->params['action'] = 'druki';
		
		if( isset($this->request->params['pass'][0]) && is_numeric($this->request->params['pass'][0]) ) {
			
			$druk = $this->API->getObject('rady_druki', $this->request->params['pass'][0]);
			$druk->loadLayer('neighbours');
			$document = $this->API->document($druk->getData('dokument_id'));
	    	$this->set('druk', $druk);
			$this->set('document', $document);
			$this->set('documentPackage', 1);
	        $this->set('title_for_layout', $druk->getTitle());
	    	
	    	$this->render('druk');
			
		} else {
		
	        $this->dataobjectsBrowserView(array(
	            'dataset' => 'rady_druki',
	            'title' => 'Materiały na posiedzenia rady miasta',
	            'noResultsTitle' => 'Brak danych',
	            // 'hlFields' => $hl_fields = array('numer', 'liczba_debat'),
	        ));
	        
	        $this->set('title_for_layout', 'Materiały na posiedzenia rady gminy ' . $this->object->getData('nazwa'));
        
        }
    }


    public function radni_powiazania()
    {        
        
        parent::_prepareView();
        $this->request->params['action'] = 'radni_powiazania';
        
        $this->object->loadLayer('radni_powiazania');
                
        $this->set('title_for_layout', 'Powiązania radnych gminy  ' . $this->object->getData('nazwa') . ' z organizacjami w Krajowym Rejestrze Sądowym');
    }
    
    public function radni()
    {        
        
        parent::_prepareView();
        $this->request->params['action'] = 'radni';
		
    	if( isset($this->request->params['pass'][0]) && is_numeric($this->request->params['pass'][0]) ) {
	    	
	    	$subaction = (isset( $this->request->params['pass'][1] ) && $this->request->params['pass'][1]) ? $this->request->params['pass'][1] : 'view';
	    	$sub_id = (isset( $this->request->params['pass'][2] ) && $this->request->params['pass'][2]) ? $this->request->params['pass'][2] : false;
							    	
	    	$radny = $this->API->getObject('radni_gmin', $this->request->params['pass'][0]);			
			$dyzur = $radny->loadLayer('najblizszy_dyzur');
			$radny->loadLayer('neighbours');
			// debug( $dyzur ); die();
			$title_for_layout = $radny->getTitle();
			
			switch( $subaction ) {
				case 'view': {
					
					$radny->loadLayer('details');
					
					if( $radny->getData('liczba_wystapien') ) {
						$this->API->searchDataset('rady_gmin_wystapienia', array(
				            'limit' => 8,
				            'conditions' => array(
				                'radny_id' => $radny->getId(),
				            ),
				        ));
				        $this->set('wystapienia', $this->API->getObjects());
			        }
			        
			        if( $radny->getData('liczba_interpelacji') ) {
						$this->API->searchDataset('rady_gmin_interpelacje', array(
				            'limit' => 8,
				            'conditions' => array(
				                'radny_id' => $radny->getId(),
				            ),
				        ));
				        $this->set('interpelacje', $this->API->getObjects());
			        }
			        					
					if( $radny->getData('krs_osoba_id') ) {
						
						$osoba = $this->API->getObject('krs_osoby', $radny->getData('krs_osoba_id'));
				        $osoba->loadLayer('organizacje');
				        $this->set('osoba', $osoba);
						
					}
					
					break;
				}
				case 'wystapienia': {
					
					$this->dataobjectsBrowserView(array(
			            'source' => 'radni_gmin.wystapienia:' . $radny->getId(),
			            'dataset' => 'rady_gmin_wystapienia',
			            'noResultsTitle' => 'Brak wystąpień',
			            // 'hlFields' => array('dzielnice.nazwa', 'liczba_glosow'),
			        ));
					
					break;
				}
				case 'interpelacje': {
					
					$this->dataobjectsBrowserView(array(
			            'source' => 'radni_gmin.interpelacje:' . $radny->getId(),
			            'dataset' => 'rady_gmin_interpelacje',
			            'noResultsTitle' => 'Brak interpelacji',
			            // 'hlFields' => array('dzielnice.nazwa', 'liczba_glosow'),
			        ));
					
					break;
				}
				case 'oswiadczenia': {
					
					if( $sub_id ) {
						
						$oswiadczenie = $this->API->getObject('radni_gmin_oswiadczenia_majatkowe', $sub_id);
						$document = $this->API->document($oswiadczenie->getData('dokument_id'));
						$this->set('oswiadczenie', $oswiadczenie);
						$this->set('document', $document);
						$this->set('documentPackage', 1);
						
					} else {
					
						$this->dataobjectsBrowserView(array(
				            'source' => 'radni_gmin.oswiadczenia_majatkowe:' . $radny->getId(),
				            'dataset' => 'radni_gmin_oswiadczenia_majatkowe',
				            'noResultsTitle' => 'Brak oświadczeń majątkowych',
				            // 'hlFields' => array('dzielnice.nazwa', 'liczba_glosow'),
				        ));
			        
			        }
					
					break;
				}
				case 'dyzury': {
					
					$radny->loadLayer('dyzury');
					break;
					
				}
			}
			

			if( $this->object->getId()==903 ) {
			
				$href_base = '/dane/gminy/' . $this->object->getId() . '/radni/' . $radny->getId();
	        
		        $submenu = array(
		            'items' => array(),
			    );
				
				$submenu['items'][] = array(
					'id' => 'view',
					'href' => $href_base,
					'label' => ( $radny->getData('plec')=='K' ) ? 'Radna' : 'Radny',
			    );
			    
			    if( $dyzur )
				    $submenu['items'][] = array(
						'id' => 'dyzury',
						'href' => $href_base . '/dyzury',
						'label' => 'Dyżury',
				    );
			    
				if( $radny->getData('liczba_wystapien') )
					$submenu['items'][] = array(
						'id' => 'wystapienia',
						'href' => $href_base . '/wystapienia',
						'label' => 'Wystąpienia',
						'count' => $radny->getData('liczba_wystapien'),
				    );

				if( $radny->getData('liczba_interpelacji') )
				    $submenu['items'][] = array(
						'id' => 'interpelacje',
						'href' => $href_base . '/interpelacje',
						'label' => 'Interpelacje',
						'count' => $radny->getData('liczba_interpelacji'),
				    );			    
				    
				if( $radny->getData('liczba_oswiadczen') )
				    $submenu['items'][] = array(
						'id' => 'oswiadczenia',
						'href' => $href_base . '/oswiadczenia',
						'label' => 'Oświadczenia majątkowe',
						'count' => $radny->getData('liczba_oswiadczen'),
				    );		    
			    	    
		        $submenu['selected'] = $subaction;
		        $this->set('_submenu', $submenu);
	        
	        }
	        
	    	$this->set('radny', $radny);
	    	$this->set('sub_id', $sub_id);
	    	$this->set('title_for_layout', $title_for_layout);
	    	$this->render('radny-' . $subaction);
	    	
    	} else {
    		
    		$params = array(
	            'source' => 'gminy.radni:' . $this->object->getId(),
	            'dataset' => 'radni_gmin',
	            'noResultsTitle' => 'Brak radnych dla tej gminy',
	            'excludeFilters' => array(
	                'gmina_id', 'gminy.powiat_id', 'gminy.wojewodztwo_id'
	            ),
	            'hlFields' => array('nazwa', 'liczba_glosow'),
	            'limit' => 100,
	        );
	        
	        if( $this->object->getData('id')=='903' )
	        	$params['title']  = 'Radni miasta';
    		
	        $this->dataobjectsBrowserView($params);
	        $this->set('title_for_layout', 'Radni gminy ' . $this->object->getData('nazwa'));
        
        }
    }
    
    
    public function radni_dzielnic()
    {
        parent::_prepareView();
        $this->dataobjectsBrowserView(array(
            'source' => 'gminy.radni_dzielnic:' . $this->object->getId(),
            'dataset' => 'radni_dzielnic',
            'title' => 'Radni dzielnic',
            'noResultsTitle' => 'Brak radnych dzielnic dla tej gminy',
            'hlFields' => array('dzielnice.nazwa', 'liczba_glosow'),
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
            'noResultsTitle' => 'Brak zamówień dla tej gminy',
            'excludeFilters' => array(
                'gmina_id',
            ),
        ));
        
        $this->set('title_for_layout', 'Zamówienia publiczne w gminie ' . $this->object->getData('nazwa'));
    }

    public function organizacje()
    {
        parent::_prepareView();
        $this->dataobjectsBrowserView(array(
            'source' => 'gminy.organizacje:' . $this->object->getId(),
            'dataset' => 'krs_podmioty',
            'noResultsTitle' => 'Brak organizacji w tej gminie',
            'excludeFilters' => array(
                'gmina_id',
            ),
        ));
        $this->set('title_for_layout', 'Organizacje w gminie ' . $this->object->getData('nazwa'));
    }
    
    public function biznes()
    {
    	$this->request->params['action'] = 'biznes';
        parent::_prepareView();
        $this->dataobjectsBrowserView(array(
            'source' => 'gminy.biznes:' . $this->object->getId(),
            'dataset' => 'krs_podmioty',
            'title' => 'Organizacje biznesowe',
            'noResultsTitle' => 'Brak organizacji biznesowych w tej gminie',
            'excludeFilters' => array(
                'gmina_id', 'forma_prawna_typ_id'
            ),
        ));
        $this->set('title_for_layout', 'Organizacje biznesowe w gminie ' . $this->object->getData('nazwa'));
    }

	public function ngo()
    {
    	$this->request->params['action'] = 'ngo';
        parent::_prepareView();
        $this->dataobjectsBrowserView(array(
            'source' => 'gminy.ngo:' . $this->object->getId(),
            'dataset' => 'krs_podmioty',
            'title' => 'Organizacje pozarządowe',
            'noResultsTitle' => 'Brak organizacji pozarządowych w tej gminie',
            'excludeFilters' => array(
                'gmina_id', 'forma_prawna_typ_id'
            ),
        ));
        $this->set('title_for_layout', 'Organizacje pozarządowe w gminie ' . $this->object->getData('nazwa'));
    }
    
    public function spzoz()
    {
    	$this->request->params['action'] = 'spzoz';
        parent::_prepareView();
        $this->dataobjectsBrowserView(array(
            'source' => 'gminy.spzoz:' . $this->object->getId(),
            'dataset' => 'krs_podmioty',
            'title' => 'Publiczne zakłady opieki zdrowotnej',
            'noResultsTitle' => 'Brak publicznych zakładów opieki zdrowotnej w tej gminie',
            'excludeFilters' => array(
                'gmina_id', 'forma_prawna_typ_id', 'forma_prawna_id'
            ),
        ));
        $this->set('title_for_layout', 'Samodzielne Publiczne Zakłady Opieki Zdrowotnej w gminie ' . $this->object->getData('nazwa'));
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
        
        $this->set('title_for_layout', 'Dotacje Unii Europejskiej w gminie ' . $this->object->getData('nazwa'));

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


    public function zamowienia_publiczne()
    {

        $url = '/dane/gminy/' . $this->request->params['id'] . '/zamowienia';

        if (!empty($this->request->query))
            $url .= '?' . http_build_query($this->request->query);

        $this->redirect($url);

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
    
    public function beforeRender()
	{
        // PREPARE MENU
		$href_base = Router::url(array('action' => 'view', 'id' => $this->request->params['id']));
        if ($href_base == '/') {
            $href_base = '';
        }
        
        $menu = array(
            'items' => array(
	            array(
	            	'id' => '',
	                'href' => $href_base,
	                'label' => 'Gmina',
	            ),
	        )
	    );
		
		if( $this->object->getId() == '903' ) {
			
			$menu['items'][] = array(
				'id' => 'rada',
				'label' => 'Rada Miasta',
				'dropdown' => array(
					'items' => array(
						array(
							'id' => 'radni',
							'label' => 'Radni',
							'href' => $href_base . '/radni',
						),
						array(
							'id' => 'radni_powiazania',
							'label' => 'Powiązania radnych z organizacjami',
							'href' => $href_base . '/radni_powiazania',
						),
						array(
							'topborder' => true,
							'id' => 'posiedzenia',
							'label' => 'Posiedzenia rady miasta',
							'href' => $href_base . '/posiedzenia',
						),
						array(
							'id' => 'debaty',
							'label' => 'Debaty na posiedzeniach',
							'href' => $href_base . '/debaty',
						),
						/*
						array(
							'id' => 'wystapienia',
							'label' => 'Wystąpienia na posiedzeniach',
							'href' => $href_base . '/wystapienia',
						),
						*/
						array(
							'topborder' => true,
							'id' => 'interpelacje',
							'label' => 'Interpelacje radnych',
							'href' => $href_base . '/interpelacje',
						),
						array(
							'id' => 'druki',
							'label' => 'Druki na posiedzenia rady miasta',
							'href' => $href_base . '/druki',
						),
						array(
							'id' => 'rada_uchwaly',
							'label' => 'Uchwały rady miasta',
							'href' => $href_base . '/rada_uchwaly',
						),
					),
				),
		    );
		    

			
		} else {
		
			$menu['items'][] = array(
				'id' => 'radni',
				'href' => $href_base . '/radni',
				'label' => 'Radni',
		    );
	    
	    }
	    
	    $menu['items'][] = array(
			'id' => 'organizacje',
			'label' => 'Organizacje',
			'dropdown' => array(
				'items' => array(
					array(
						'id' => 'organizacje',
						'label' => 'Wszystkie organizacje',
						'href' => $href_base . '/organizacje',
					),
					array(
						'topborder' => true,
						'id' => 'biznes',
						'label' => 'Biznes',
						'href' => $href_base . '/biznes',
					),
					array(
						'id' => 'ngo',
						'label' => 'Organizacje pozarządowe',
						'href' => $href_base . '/ngo',
					),
					array(
						'id' => 'spzoz',
						'label' => 'Publiczne zakłady opieki zdrowotnej',
						'href' => $href_base . '/spzoz',
					),
				),
			),
	    );
	    
	    /*
	    $menu['items'][] = array(
			'id' => 'wskazniki',
			'href' => $href_base . '/wskazniki',
			'label' => 'Wskaźniki GUS',
	    );
	    */
	    
	    $menu['items'][] = array(
			'id' => 'zamowienia',
			'href' => $href_base . '/zamowienia',
			'label' => 'Zamówienia publiczne',
	    );
	    
	    $menu['items'][] = array(
			'id' => 'wybory',
			'label' => 'Wybory',
			'dropdown' => array(
				'items' => array(
					array(
						'id' => 'okregi_wyborcze',
						'label' => 'Okręgi wyborcze w wyborach samorządowych 2010 r.',
						'href' => $href_base . '/okregi_wyborcze',
					)
				),
			),
	    );
	    
	    /*
	    $menu['items'][] = array(
			'id' => 'miejscowosci',
			'href' => $href_base . '/miejscowosci',
			'label' => 'Miejscowości',
	    );
	    
	    $menu['items'][] = array(
			'id' => 'kody',
			'href' => $href_base . '/kody',
			'label' => 'Kody pocztowe',
	    );
	    */
	    
	    
	    
		    
        $menu['selected'] = ( $this->request->params['action'] == 'view' ) ? '' : $this->request->params['action'];
        
        $this->set('_menu', $menu);
		
	}
} 