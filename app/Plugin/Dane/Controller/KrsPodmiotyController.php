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
    
    public function beforeFilter()
    {
    	
    	parent::beforeFilter();
        $this->Auth->deny(array('pobierz_odpis', 'odpis'));        
    }


    public function view()
    {
        parent::view();		
		

		if( $this->Session->read('KRS.odpis')==$this->object->getId() )	{
			
			$odpis = $this->object->loadLayer('odpis');
			if( $odpis['status'] )
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


        $organy = array();
        $menu = array();

        $reprezentacja = $this->object->loadLayer('reprezentacja');
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

        $wspolnicy = $this->object->loadLayer('wspolnicy');
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

        $akcjonariusze = $this->object->loadLayer('jedynyAkcjonariusz');
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

        $prokurenci = $this->object->loadLayer('prokurenci');
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

        $nadzor = $this->object->loadLayer('nadzor');
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

        $komitetZalozycielski = $this->object->loadLayer('komitetZalozycielski');
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


        $dzialalnosc = $this->object->loadLayer('dzialalnosci');
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

            $this->_prepareView();
            $data = $this->object->loadLayer('graph');

            $this->set('data', $data);
            $this->set('_serialize', 'data');

        } else return false;
    }
    
    public function odpis()
    {
	    	    
	    $id = (int) $this->request->params['id'];
	    $this->Session->write('KRS.odpis', $id);
	    $this->redirect('/dane/krs_podmioty/' . $id);
	    
    }
    
}