<?php

App::uses('DataobjectsController', 'Dane.Controller');

class KrsPodmiotyController extends DataobjectsController
{
    public $menu = array();
    public $helpers = array(
        'Time',
    );
    public $components = array('RequestHandler');

    /*
    public $menuMode = 'vertical';
    protected function prepareMenu()
    {

        $liczba_reprezentantow = (int)$this->object->getData('liczba_reprezentantow');
        if ($liczba_reprezentantow)
            $this->menu[] = array(
                'id' => 'reprezentacja',
                'label' => _ucfirst($this->object->getData('nazwa_organu_reprezentacji')),
            );


        $liczba_nadzorcow = (int)$this->object->getData('liczba_nadzorcow');
        if ($liczba_nadzorcow)
            $this->menu[] = array(
                'id' => 'nadzor',
                'label' => _ucfirst($this->object->getData('nazwa_organu_nadzoru')),
            );


        $liczba_wspolnikow = (int)$this->object->getData('liczba_wspolnikow');
        if ($liczba_wspolnikow)
            $this->menu[] = array(
                'id' => 'wspolnicy',
                'label' => 'Wspólnicy',
            );


        $liczba_czlonkow_komitetu_zal = (int)$this->object->getData('liczba_czlonkow_komitetu_zal');
        if ($liczba_czlonkow_komitetu_zal)
            $this->menu[] = array(
                'id' => 'komitetZalozycielski',
                'label' => 'Komitet założycielski',
            );


        $liczba_jedynych_akcjonariuszy = (int)$this->object->getData('liczba_jedynych_akcjonariuszy');
        if ($liczba_jedynych_akcjonariuszy)
            $this->menu[] = array(
                'id' => 'jedynyAkcjonariusz',
                'label' => 'Jedyny akcjonariusz',
            );


        $liczba_oddzialow = (int)$this->object->getData('liczba_oddzialow');
        if ($liczba_oddzialow)
            $this->menu[] = array(
                'id' => 'oddzialy',
                'label' => 'Oddziały',
            );


        $liczba_emisji_akcji = (int)$this->object->getData('liczba_emisji_akcji');
        if ($liczba_emisji_akcji)
            $this->menu[] = array(
                'id' => 'emisjeAkcji',
                'label' => 'Emisje akcji',
            );


        $liczba_zmian_umow = (int)$this->object->getData('liczba_zmian_umow');
        if ($liczba_zmian_umow)
            $this->menu[] = array(
                'id' => 'zmianyUmow',
                'label' => ($this->object->getData('forma_prawna_id') == '1') ? 'Zmiany statutów' : 'Zmiany umów',
            );


    }
    */

    public function view()
    {
        parent::view();


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
}