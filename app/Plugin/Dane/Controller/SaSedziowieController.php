<?php

App::uses('DataobjectsController', 'Dane.Controller');

class SaSedziowieController extends DataobjectsController
{
    public function view()
    {
        parent::_prepareView();
        $this->innerSearch('sa_orzeczenia', array(
            '_multidata_sedzia_id' => $this->object->object_id,
        ), array(
            'searchTitle' => sprintf(__d('dane', 'LC_DANE_ORZECZENIA_WYDANE_PRZEZ'), $this->object->getData('nazwa')),
        ));
    }
} 