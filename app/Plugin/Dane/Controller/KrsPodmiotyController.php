<?php

App::uses('DataobjectsController', 'Dane.Controller');

class KrsPodmiotyController extends DataobjectsController
{
    public $menu = array();
    public $helpers = array(
        'Time',
    );
    public $components = array('RequestHandler');
    public $objectOptions = array(
        'hlFields' => array(),
        'bigTitle' => true,
    );

    public $initLayers = array('counters');

    public function beforeFilter()
    {
        parent::beforeFilter();
        $this->Auth->deny(array('pobierz_odpis', 'odpis'));
    }

	public function _prepareView(){
		
		parent::_prepareView();
		
		if( defined('PK_DOMAIN') ) {
			
			$pieces = parse_url(Router::url($this->here, true));
			if( ($pieces['host'] == PK_DOMAIN) && ($this->object->getData('gmina_id')!='903') ) {
			
				$this->redirect('http://' . PORTAL_DOMAIN . $_SERVER['REQUEST_URI']);
                die();
			
			}
			
		}
		
	}
	
    public function view()
    {
			
        $this->addInitLayers(array('reprezentacja', 'wspolnicy', 'jedynyAkcjonariusz', 'prokurenci', 'nadzor', 'komitetZalozycielski', 'dzialalnosci'));

        if ($this->Session->read('KRS.odpis') == $this->params->id)
            $this->addInitLayers('odpis');

        $this->_prepareView();

        if ($this->Session->read('KRS.odpis') == $this->object->getId()) {

            $odpis = $this->object->getLayer('odpis');
            if ($odpis['status'])
                $this->set('odpis', $odpis['url']);

        }

        $this->Session->delete('KRS.odpis');


        $indicators = array(
            array(
                'label' => 'Numer KRS',
                'value' => $this->object->getData('krs'),
            ),
        );

        if ($this->object->getData('nip'))
            $indicators[] = array(
                'label' => 'Numer NIP',
                'value' => $this->object->getData('nip'),
            );


        $indicators[] = array(
            'label' => 'Data rejestracji',
            'value' => $this->object->getData('data_rejestracji'),
            'format' => 'date',
        );

        if ($this->object->getData('wartosc_kapital_zakladowy'))
            $indicators[] = array(
                'label' => 'Kapitał zakładowy',
                'value' => $this->object->getData('wartosc_kapital_zakladowy'),
                'format' => 'pln',
            );


        $this->set('indicators', $indicators);


        $zamowienia = $this->API->search(array(
            'limit' => 9,
            'conditions' => array(
                '_source' => 'krs_podmioty.zamowienia:' . $this->object->getId(),
                'dataset' => 'zamowienia_publiczne',
            ),
        ));
        $this->set('zamowienia', $this->API->getObjects());

        /*
        $obszary = new MP\Obszary();
        $this->set('obszar', $obszary->getMiejscowosc(array(
            'conditions' => array(
                'Miejscowosc.id' => $this->object->getData('miejscowosc_id')
            ),
            'fields' => array(
                'Miejscowosc.nazwa',
                'Miejscowosc.id',
                'Powiat.nazwa',
                'Gmina.nazwa',
                'Gmina.id',
                'Wojewodztwo.nazwa'
            ),
        )));
        */

        $organy = array();
        $menu = array();

        $reprezentacja = $this->object->getLayer('reprezentacja');
        if (!empty($reprezentacja)) {
            $organy[] = array(
                'title' => $this->object->getData('nazwa_organu_reprezentacji'),
                'label' => 'Organ reprezentacji',
                'idTag' => 'reprezentacja',
                'content' => $reprezentacja,
            );
            $menu[] = array(
                'id' => 'reprezentacja',
                'label' => $this->object->getData('nazwa_organu_reprezentacji'),
            );
        }

        $wspolnicy = $this->object->getLayer('wspolnicy');
        /*
        if (!empty($wspolnicy)) {
            $organy[] = array(
                'title' => 'Wspólnicy',
                'idTag' => 'wspolnicy',
                'content' => $wspolnicy,
            );
            $menu[] = array(
                'id' => 'wspolnicy',
                'label' => 'Wspólnicy',
            );
        }
        */

        $akcjonariusze = $this->object->getLayer('jedynyAkcjonariusz');
        if (!empty($akcjonariusze)) {
            $organy[] = array(
                'title' => 'Jedyny akcjonariusz',
                'idTag' => 'akcjonariusz',
                'content' => $akcjonariusze,
            );
            $menu[] = array(
                'id' => 'akcjonariusz',
                'label' => 'Jedyny akcjonariusz',
            );
        }

        $prokurenci = $this->object->getLayer('prokurenci');
        if (!empty($prokurenci)) {
            $organy[] = array(
                'title' => 'Prokurenci',
                'idTag' => 'prokurenci',
                'content' => $prokurenci,
            );
            $menu[] = array(
                'id' => 'prokurenci',
                'label' => 'Prokurenci',
            );
        }

        $nadzor = $this->object->getLayer('nadzor');
        if (!empty($nadzor)) {
            $organy[] = array(
                'title' => $this->object->getData('nazwa_organu_nadzoru'),
                'label' => 'Organ nadzoru',
                'idTag' => 'nadzor',
                'content' => $nadzor,
            );
            $menu[] = array(
                'id' => 'nadzor',
                'label' => $this->object->getData('nazwa_organu_nadzoru'),
            );
        }

        $komitetZalozycielski = $this->object->getLayer('komitetZalozycielski');
        if (!empty($komitetZalozycielski)) {
            $organy[] = array(
                'title' => 'Komitet założycielski',
                'idTag' => 'zalozyciele',
                'content' => $komitetZalozycielski,
            );
            $menu[] = array(
                'id' => 'zalozyciele',
                'label' => 'Komitet założycielski',
            );
        }


        $this->set('organy', $organy);


        $dzialalnosc = $this->object->getLayer('dzialalnosci');
        if ($dzialalnosc)
            $dzialalnosci = array(
                'title' => 'Działalność',
                'idTag' => 'dzialalnosc',
                'content' => $dzialalnosc,
            );
        $menu[] = array(
            'id' => 'dzialalnosc',
            'label' => 'Działalność',
        );

        @$this->set('dzialalnosci', $dzialalnosci);


        $this->set('_menu', $menu);


    }

    public function graph()
    {
        if ($this->request->params['ext'] == 'json') {
			
			$this->addInitLayers('graph');
            $this->_prepareView();
            $data = $this->object->getLayer('graph');

            $this->set('data', $data);
            $this->set('_serialize', 'data');

        } else return false;
    }

    public function odpis()
    {

        $id = (int)$this->request->params['id'];
        $this->Session->write('KRS.odpis', $id);
        $this->redirect('/dane/krs_podmioty/' . $id);

    }

    public function zamowienia()
    {

        $this->_prepareView();
        $this->dataobjectsBrowserView(array(
            'source' => 'krs_podmioty.zamowienia:' . $this->object->getId(),
            'dataset' => 'zamowienia_publiczne',
            'title' => 'Zamówienia publiczne udzielone organizacji',
            'noResultsTitle' => 'Brak zamówień publicznych',
        ));        
        $this->set('title_for_layout', 'Zamówienia publiczne udzielone organizacji ' . $this->object->getTitle());
	    
    }
    
    public function umowy()
    {
	    
	    $this->_prepareView();
        
        
        if( isset($this->request->params['pass'][0]) && is_numeric($this->request->params['pass'][0]) ) {
			
		    $this->helpers[] = 'Document';
			$umowa = $this->API->getObject('umowy', $this->request->params['pass'][0], array(
				'layers' => array('neighbours'),
			));
			
			$document = $this->API->document($umowa->getData('dokument_id'));
	    	$this->set('umowa', $umowa);
			$this->set('document', $document);
	        $this->set('title_for_layout', $umowa->getTitle());
	    	
	    	$this->render('umowa');
			
		} else {
        
	        $this->dataobjectsBrowserView(array(
	            'source' => 'krs_podmioty.umowy:' . $this->object->getId(),
	            'dataset' => 'umowy',
	            'noResultsTitle' => 'Brak umów',
	            'limit' => 50,
	        ));
	
	        $this->set('title_for_layout', 'Umowy cywilnoprawne podpisane przez ' . $this->object->getTitle());
        
        }

    }

    public function emisje_akcji()
    {

        $this->addInitLayers('emisje_akcji');
        $this->_prepareView();
        $this->set('title_for_layout', 'Emisje akcji spółki ' . $this->object->getTitle());

    }

    public function oddzialy()
    {

        $this->addInitLayers('oddzialy');
        $this->_prepareView();
        $this->set('title_for_layout', 'Oddziały ' . $this->object->getTitle());

    }
    
    public function kultura()
    {

        $this->addInitLayers('kultura');
        $this->_prepareView();
        $this->set('title_for_layout', 'Indeksy kultury dla ' . $this->object->getTitle());

    }

    public function zmiany_umow()
    {

        $this->addInitLayers('zmiany_umow');
        $this->_prepareView();
        $this->set('title_for_layout', 'Zmiany umów ' . $this->object->getTitle());

    }

    public function beforeRender()
    {

        $counters = $this->object->getLayers('counters');

        // PREPARE MENU		
        $href_base = '/dane/krs_podmioty/' . $this->request->params['id'];

        $menu = array(
            'items' => array(
	            array(
	            	'id' => '',
	                'href' => $href_base,
	                'label' => 'Informacje i powiązania',
	            ),
	        )
	    );
	    
	    if( $this->request->params['id'] == 481129 ) { // KOMITET KONKURSOWY KRAKÓW 2022 
		    
		    $menu['items'][] = array(
				'id' => 'umowy',
				'href' => $href_base . '/umowy',
				'label' => 'Podpisane umowy',
				'count' => 94,
		    );
	    }
		
		if( $counters['liczba_oddzialow'] )
			$menu['items'][] = array(
				'id' => 'oddzialy',
				'href' => $href_base . '/oddzialy',
				'label' => 'Oddziały',
				'count' => $counters['liczba_oddzialow'],
		    );
	    

		if( $counters['liczba_zmian_umow'] )
		    $menu['items'][] = array(
				'id' => 'zmiany_umow',
				'href' => $href_base . '/zmiany_umow',
				'label' => 'Zmiany umów',
				'count' => $counters['liczba_zmian_umow'],
		    );
		    
		if( $counters['liczba_emisji_akcji'] )
		    $menu['items'][] = array(
				'id' => 'emisje_akcji',
				'href' => $href_base . '/emisje_akcji',
				'label' => 'Emisje akcji',
				'count' => $counters['liczba_emisji_akcji'],
		    );
		
		if( $this->request->params['action'] == 'kultura' ) {
			$menu['items'][] = array(
				'id' => 'kultura',
				'href' => $href_base . '/kultura',
				'label' => 'Indeksy kultury',
		    );
		}
		
        $menu['selected'] = ( $this->request->params['action'] == 'view' ) ? '' : $this->request->params['action'];
        $this->set('_menu', $menu);

    }

}