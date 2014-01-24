<?php

class ZamowieniaPubliczneController extends AppController
{

    public $helpers = array(
        'Dane.Dataobject',
        'Dane.DataobjectsSlider',
    );

    public function index()
    {

        $stats = $this->API->ZamowieniaPubliczne()->getStats();
        $this->set('stats', $stats);


        $api = $this->API->Dane();


        $api->searchDataset('zamowienia_publiczne', array(
            'limit' => 20,
            'conditions' => array(
                'rodzaj_id' => 2,
            ),
        ));
        $this->set('uslugi', $api->getObjects());


        $api->searchDataset('zamowienia_publiczne', array(
            'limit' => 20,
            'conditions' => array(
                'rodzaj_id' => 3,
            ),
        ));
        $this->set('dostawy', $api->getObjects());


        $api->searchDataset('zamowienia_publiczne', array(
            'limit' => 20,
            'conditions' => array(
                'rodzaj_id' => 1,
            ),
        ));
        $this->set('roboty', $api->getObjects());

        $application = $this->getApplication();
        $this->set('title_for_layout', $application['Application']['name']);
    }

} 