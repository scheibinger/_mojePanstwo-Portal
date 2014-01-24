<?php

App::uses('DataobjectsController', 'Dane.Controller');

class SejmKlubyController extends DataobjectsController
{
    public function view()
    {

        parent::_prepareView();
        $url = 'http://sejmometr.pl/sejm_kluby/' . $this->object->getId();
        $this->redirect($url);
        die();

        parent::_prepareView();
        $this->innerSearch('poslowie', array(
            'klub_id' => $this->object->object_id,
        ), array(
            'searchTitle' => sprintf(__d('dane', 'LC_DANE_POSLOWIE_KLUBU'), $this->object->getData('nazwa')),
        ));
    }
} 