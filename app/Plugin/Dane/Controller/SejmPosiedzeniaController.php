<?php

App::uses('DataobjectsController', 'Dane.Controller');

class SejmPosiedzeniaController extends DataobjectsController
{
    public $menu = array();
    public $helpers = array(
        'Number',
    );
    public $uses = array(
        'Dane.Dataobject',
    );

    public function view()
    {

        parent::view();
        $this->dataobjectsBrowserView(array(
            'source' => 'sejm_posiedzenia.punkty:' . $this->object->getId(),
            'dataset' => 'sejm_posiedzenia_punkty',
            'title' => 'Punkty porządku dziennego',
            'noResultsTitle' => 'Brak punktów porządku',
            'hlFields' => array('numer', 'liczba_debat', 'liczba_wystapien', 'liczba_glosowan'),
            'order' => 'numer asc',        
        ));
        
    }

    
} 