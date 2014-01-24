<?php

App::uses('DataobjectsController', 'Dane.Controller');

class SejmKomisjeController extends DataobjectsController
{
    public function view()
    {

        parent::_prepareView();
        $url = 'http://sejmometr.pl/sejm_komisje/' . $this->object->getId();
        $this->redirect($url);
        die();

        parent::_prepareView();
        $this->innerSearch('poslowie', array(
            'fields' => 'id, dataset, object_id, score, _data_*',
            '_multidata_komisja_id' => $this->object->object_id,
        ), array(
            'searchTitle' => __d('dane', 'LC_DANE_POSLOWIE_ZASIADAJACY_W_KOMISJI', true),
        ));
    }
} 