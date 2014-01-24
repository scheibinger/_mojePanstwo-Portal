<?php

App::uses('DataobjectsController', 'Dane.Controller');

class RadyPosiedzeniaController extends DataobjectsController
{
    public function view()
    {

        parent::_prepareView();
        $url = 'http://sejmometr.pl/rady_posiedzenia/' . $this->object->getId();
        $this->redirect($url);
        die();

        parent::_prepareView();
        $this->innerSearch('rady_gmin_debaty', array(
            'posiedzenie_id' => $this->object->object_id,
        ), array(
            'searchTitle' => __d('dane', 'LC_DANE_DEBATY_NA_POSIEDZENIU', true),
        ));
    }
} 