<?php

App::uses('DataobjectsController', 'Dane.Controller');

class PoslowieController extends DataobjectsController
{

    public $components = array(
        'RequestHandler',
    );

    public $menu = array();

    public function view()
    {

        parent::view();
				
		$this->API->searchDataset('prawo_projekty', array(
            'limit' => 8,
            'conditions' => array(
                'poslowie_za' => $this->object->getId(),
            ),
            'order' => 'data_status desc',
        ));
        $this->set('projekty_za', $this->API->getObjects());
        
        
        
        $this->API->searchDataset('prawo_projekty', array(
            'limit' => 8,
            'conditions' => array(
                'poslowie_przeciw' => $this->object->getId(),
            ),
            'order' => 'data_status desc',
        ));
        $this->set('projekty_przeciw', $this->API->getObjects());
        
        
        
        $this->API->searchDataset('prawo_projekty', array(
            'limit' => 8,
            'conditions' => array(
                'poslowie_wstrzymali' => $this->object->getId(),
            ),
            'order' => 'data_status desc',
        ));
        $this->set('projekty_wstrzymania', $this->API->getObjects());
        
        
        
        $this->API->searchDataset('prawo_projekty', array(
            'limit' => 8,
            'conditions' => array(
                'poslowie_nieobecni' => $this->object->getId(),
            ),
            'order' => 'data_status desc',
        ));
        $this->set('poslowie_nieobecni', $this->API->getObjects());
		
		
		/*
        $menu = array(
            array(
                'id' => 'wystapienia',
                'label' => 'Wystąpienia w Sejmie',
            ),
            array(
                'id' => 'interpelacje',
                'label' => 'Interpelacje',
            ),
            array(
                'id' => 'wystapienia',
                'label' => 'Projekty ustaw',
            ),
            array(
                'id' => 'glosowania',
                'label' => 'Wyniki głosowań',
            ),
        );

		
        $this->API->searchDataset('sejm_wystapienia', array(
            'limit' => 9,
            'conditions' => array(
                'ludzie.id' => $this->object->getData('ludzie.id'),
            ),
        ));
        $this->set('wystapienia', $this->API->getObjects());

        $this->API->searchDataset('sejm_interpelacje', array(
            'limit' => 9,
            'conditions' => array(
                'posel_id' => $this->object->getId(),
            ),
        ));
        $this->set('interpelacje', $this->API->getObjects());

        $this->API->searchDataset('legislacja_projekty_ustaw', array(
            'limit' => 9,
            'conditions' => array(
                'posel_id' => $this->object->getId(),
            ),
        ));
        $this->set('projekty_ustaw', $this->API->getObjects());

        $this->API->searchDataset('poslowie_glosy', array(
            'limit' => 9,
            'conditions' => array(
                'posel_id' => $this->object->getId(),
            ),
        ));
        $this->set('glosowania', $this->API->getObjects());


        // $this->set('info', $this->object->loadLayer('info'));
        // $this->set('krs', $this->object->loadLayer('krs'));
        // $this->set('stats', $this->object->loadLayer('stat'));

        $this->set('_menu', $menu);
        */
    }
    
    
    public function twitter()
    {

        parent::view();
        
        if(
        	$this->object->getData('twitter_account_id') && 
        	( $twitter_account = $this->API->Dane()->getObject('twitter_accounts', $this->object->getData('twitter_account_id')) ) 
        ) {
	        
	        $this->set('twitter_account', $twitter_account);
	        
	        $twitter_account->loadLayer('followers_chart');
        
	        $this->API->searchDataset('twitter', array(
	            'limit' => 12,
	            'conditions' => array(
	                'twitter_account_id' => $twitter_account->getId(),
	            ),
	        ));
	        $this->set('twitts', $this->API->getObjects());
	        
        } else $this->redirect('/dane/poslowie/' . $this->object->getId());
        				
    }
    

    public function finanse()
    {

        parent::_prepareView();
        
        if(
        	$this->object->getData('krs_osoba_id') && 
        	( $krs_osoba = $this->API->Dane()->getObject('krs_osoby', $this->object->getData('krs_osoba_id')) ) && 
        	$krs_osoba->loadLayer('organizacje') 
        ) {
	        
	        $this->set('krs_osoba', $krs_osoba);
	        
        }
        
        
        $wydatki = $this->object->loadLayer('wydatki');
        $rok = @$this->request->params['pass'][0];
                
        if( $rok && ($roczniki = $wydatki['roczniki']) ) {                
	        			
	        $founded = false;
	        
	        foreach( $roczniki as $rocznik )
	        	if( $rocznik['rok'] == $rok ) {
	        		$founded = true;
	        		break;
	        	}
	        
	        if( !$founded )
	        	$this->redirect('/dane/poslowie/' . $this->object->getId() . '/wydatki');
	        	        
	        $package = 1;
	        $document = $this->API->document($rocznik['dokument_id']);
	        	        
	        if ($this->request->isAjax()) {
	            
	            $this->set('html', $document->loadHtml($package));
	            $this->set('_serialize', 'html');
	        
	        } else {
	            	            
	            $this->set(array(
	                'docs' => array(),
	                'document' => $document,
	                'documentPackage' => $package,
	                'rocznik' => $rocznik,
	                'title_for_layout' => 'Wydatki biura ' . $this->object->getData('dopelniacz') . ' w ' . $rok . ' roku',
	            ));
	            $this->render('wydatki_rok');
	
	        }
	        		        
        } else {
        	
        	$this->set('title_for_layout', $this->object->getData('nazwa') . ' | Informacje finansowe');
        	
        	$this->API->searchDataset('poslowie_oswiadczenia_majatkowe', array(
	            'limit' => 9,
	            'conditions' => array(
	                'posel_id' => $this->object->getId(),
	            ),
	            'order' => 'data_status desc',
	        ));
	        $this->set('oswiadczenia_majatkowe', $this->API->getObjects());
	        
	        
	        
	        $this->API->searchDataset('poslowie_rejestr_korzysci', array(
	            'limit' => 9,
	            'conditions' => array(
	                'posel_id' => $this->object->getId(),
	            ),
	            'order' => 'data_status desc',
	        ));
	        $this->set('rejestr_korzysci', $this->API->getObjects());
	        
	        
	        
	        $this->API->searchDataset('poslowie_wspolpracownicy', array(
	            'limit' => 9,
	            'conditions' => array(
	                'posel_id' => $this->object->getId(),
	            ),
	            'order' => 'data_status desc',
	        ));
	        $this->set('wspolpracownicy', $this->API->getObjects());
	        
	        
        	
        }

    }
    
    public function aktywnosci()
    {

        parent::_prepareView();
        $this->dataobjectsBrowserView(array(
            'source' => 'poslowie.aktywnosci:' . $this->object->getId(),
        ));
    }
		
	public function oswiadczenia_majatkowe()
	{
		
		parent::_prepareView();
        $this->dataobjectsBrowserView(array(
            'source' => 'poslowie.oswiadczenia_majatkowe:' . $this->object->getId(),
            'dataset' => 'poslowie_oswiadczenia_majatkowe',
            'title' => 'Oświadczenia majątkowe',
            'noResultsTitle' => 'Brak oświadczeń',
            'hlFields' => array(),
        ));
        
        $this->set('title_for_layout', 'Oświadczenia majątkowe ' . $this->object->getData('dopelniacz'));
		
	}
	
	public function rejestr_korzysci()
	{
		
		parent::_prepareView();
        $this->dataobjectsBrowserView(array(
            'source' => 'poslowie.rejestr_korzysci:' . $this->object->getId(),
            'dataset' => 'poslowie_rejestr_korzysci',
            'title' => 'Rejestr korzyści',
            'noResultsTitle' => 'Brak pozycji w rejestrze',
            'hlFields' => array(),
        ));
        
        $this->set('title_for_layout', 'Rejestr korzyści ' . $this->object->getData('dopelniacz'));
		
	}
	
	public function wspolpracownicy()
	{
		
		parent::_prepareView();
        $this->dataobjectsBrowserView(array(
            'source' => 'poslowie.wspolpracownicy:' . $this->object->getId(),
            'dataset' => 'poslowie_wspolpracownicy',
            'title' => 'Współpracownicy',
            'noResultsTitle' => 'Brak współpracowników',
            'hlFields' => array(),
        ));
        
        $this->set('title_for_layout', 'Współpracownicy ' . $this->object->getData('dopelniacz'));
		
	}
	
    public function wystapienia()
    {
        parent::_prepareView();
        $this->dataobjectsBrowserView(array(
            'source' => 'poslowie.wystapienia:' . $this->object->getId(),
            'dataset' => 'sejm_wystapienia',
            'title' => 'Wystąpienia w Sejmie',
            'noResultsTitle' => 'Brak wystąpień',
            'hlFields' => array('sejm_debaty.tytul'),
        ));
        
        $this->set('title_for_layout', 'Wystąpienia sejmowe ' . $this->object->getData('dopelniacz'));
    }

    public function interpelacje()
    {
        parent::_prepareView();
        $this->dataobjectsBrowserView(array(
            'source' => 'poslowie.interpelacje:' . $this->object->getId(),
            'dataset' => 'sejm_interpelacje',
            'title' => 'Interpelacje',
            'noResultsTitle' => 'Brak interpelacji',
        ));
    }

    public function projekty_ustaw()
    {
        parent::_prepareView();
        $this->dataobjectsBrowserView(array(
            'source' => 'poslowie.projekty_ustaw:' . $this->object->getId(),
            'dataset' => 'legislacja_projekty_ustaw',
            'title' => 'Złożone projekty ustaw',
            'noResultsTitle' => 'Brak projektów',
        ));
    }

    public function glosowania()
    {
        parent::_prepareView();
        $this->dataobjectsBrowserView(array(
            'source' => 'poslowie.glosowania:' . $this->object->getId(),
            'dataset' => 'poslowie_glosy',
            'title' => 'Wyniki głosowań',
            'noResultsTitle' => 'Brak wyników głosowań',
        ));
    }
    
    public function prawo_projekty()
    {
        parent::_prepareView();
        $this->dataobjectsBrowserView(array(
            'source' => 'poslowie.prawo_projekty:' . $this->object->getId(),
            'dataset' => 'prawo_projekty',
            'title' => 'Projekty wniesionych aktów prawnych',
            'noResultsTitle' => 'Brak projektów',
        ));

        $this->set('title_for_layout', 'Projekty aktów prawnych, które wniósł do Sejmu ' . $this->object->getData('nazwa'));

    }
    
    public function prawo_projekty_za()
    {
        parent::_prepareView();
        $this->dataobjectsBrowserView(array(
            'source' => 'poslowie.prawo_projekty_za:' . $this->object->getId(),
            'dataset' => 'prawo_projekty',
            'title' => 'Projekty aktów prawnych, za którymi głosował poseł',
            'noResultsTitle' => 'Brak projektów',
        ));

        $this->set('title_for_layout', 'Projekty aktów prawnych, za którymi głosował ' . $this->object->getData('nazwa'));

    }
    
    public function prawo_projekty_przeciw()
    {
        parent::_prepareView();
        $this->dataobjectsBrowserView(array(
            'source' => 'poslowie.prawo_projekty_przeciw:' . $this->object->getId(),
            'dataset' => 'prawo_projekty',
            'title' => 'Projekty aktów prawnych, przeciw którym głosował poseł',
            'noResultsTitle' => 'Brak projektów',
        ));

        $this->set('title_for_layout', 'Projekty aktów prawnych, przeciw którym głosował ' . $this->object->getData('nazwa'));

    }
    
    public function prawo_projekty_wstrzymanie()
    {
        parent::_prepareView();
        $this->dataobjectsBrowserView(array(
            'source' => 'poslowie.prawo_projekty_wstrzymanie:' . $this->object->getId(),
            'dataset' => 'prawo_projekty',
            'title' => 'Projekty aktów prawnych, nad którymi poseł wstrzymał się od głosu',
            'noResultsTitle' => 'Brak projektów',
        ));

        $this->set('title_for_layout', 'Projekty aktów prawnych, nad którymi ' . $this->object->getData('nazwa') . ' wstrzymał się od głosu');

    }
    
    public function prawo_projekty_nieobecnosc()
    {
        parent::_prepareView();
        $this->dataobjectsBrowserView(array(
            'source' => 'poslowie.prawo_projekty_nieobecnosc:' . $this->object->getId(),
            'dataset' => 'prawo_projekty',
            'title' => 'Projekty aktów prawnych, dla których poseł nie przyszedł na głosowanie',
            'noResultsTitle' => 'Brak projektów',
        ));

        $this->set('title_for_layout', 'Projekty aktów prawnych, dla których ' . $this->object->getData('nazwa') . ' nie przyszedł na głosowanie');

    }
	
	public function komisja_etyki_uchwaly()
	{
		parent::_prepareView();
        $this->dataobjectsBrowserView(array(
            'source' => 'poslowie.komisja_etyki_uchwaly:' . $this->object->getId(),
            'dataset' => 'sejm_komisje_uchwaly',
            'title' => 'Uchwały Komisji Etyki wobec posła',
            'noResultsTitle' => 'Brak uchwał',
        ));

        $this->set('title_for_layout', 'Uchwały Komisji Etyki wobec ' . $this->object->getData('dopelniacz'));
	}
	
    public function timeline()
    {

        parent::_prepareView();

        $this->API->search(array(
            'conditions' => array(
                '_source' => 'poslowie.aktywnosci:' . $this->object->getId(),
            ),
            'q' => 'test',
            'limit' => '100',
            'order' => 'date desc'
        ));

        $objects = $this->API->getObjects();


        $output = array(
            'timeline' => array(
                'headline' => 'Ostatnie aktywności posła Jana Kowalskiego',
                'type' => 'default',
                'text' => "<p>Ta linia czasu pokazuje ostatnie aktywności w Sejmie posła Jana Kowalskiego.</p>",
                'font' => 'NewsCycle-Merriweather',
                'date' => array(),
            ),
        );


        foreach ($objects as $object) {

            $dataset = $object->getDataset();

            $date = $object->getDate();
            $dateParts = explode('-', $date);
            $date = $dateParts[0] . ',' . $dateParts[1] . ',' . $dateParts[2];

            switch ($dataset) {

                case 'sejm_wystapienia':
                {


                    $output['timeline']['date'][] = array(
                        'startDate' => $date,
                        'headline' => 'Wystąpienie w Sejmie',
                        'text' => '<p>Poseł wziął udział w debacie Sejmowej</p>',
                        'tag' => 'Wystąpienie w Sejmie',
                        'classname' => 'klasa',
                        'asset' => array(
                            'media' => 'http://mojepanstwo/dane/poslowie/123',
                            'thumbnail' => 'optional-32x32px.jpg',
                            'credit' => 'Credit Name Goes Here',
                            'caption' => 'Caption text goes here',
                        ),
                    );

                    break;

                }

                case 'sejm_interpelacje':
                {

                    $output['timeline']['date'][] = array(
                        'startDate' => $date,
                        'headline' => $object->getData('tytul'),
                        'text' => '<p>Poseł złożył interpelację</p>',
                        'tag' => 'Interpelacja',
                        'classname' => 'klasa',
                        'asset' => array(
                            'media' => 'http://mojepanstwo/dane/poslowie/123',
                            'thumbnail' => 'optional-32x32px.jpg',
                            'credit' => 'Credit Name Goes Here',
                            'caption' => 'Caption text goes here',
                        ),
                    );

                    break;

                }

            }

        }


        $this->set('data', $output);
        $this->set('_serialize', 'data');

    }
    
    public function beforeRender()
	{
		
		// debug( $this->object->getData() ); die();
		
        // PREPARE MENU		
		$href_base = '/dane/poslowie/' . $this->request->params['id'];
        
        $menu = array(
            'items' => array(
	            array(
	            	'id' => '',
	                'href' => $href_base,
	                'label' => 'Prace w Sejmie',
	            ),
	        )
	    );
		
		$menu['items'][] = array(
			'id' => 'finanse',
			'href' => $href_base . '/finanse',
			'label' => 'Informacje finansowe',
	    );
		
		if( $this->object->getData('twitter_account_id') ) 
		    $menu['items'][] = array(
            	'id' => 'twitter',
                'href' => $href_base . '/twitter',
                'label' => 'Twitter',
		    );	    
	    
        $menu['selected'] = ( $this->request->params['action'] == 'view' ) ? '' : $this->request->params['action'];
        
        $this->set('_menu', $menu);
		
	}

}