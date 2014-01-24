<?php

App::uses('DataobjectsController', 'Dane.Controller');

class PowiatyController extends DataobjectsController
{
    public function view()
    {
        parent::_prepareView();

        $this->innerSearch('gminy', array(
            'powiat_id' => $this->object->object_id,
        ), array(
            'searchTitle' => sprintf(__d('dane', 'LC_DANE_GMINY_W_POWIECIE'), $this->object->getData('nazwa')),
        ));
    }
} 