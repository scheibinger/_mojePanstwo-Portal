<?php

App::uses('DataobjectsController', 'Dane.Controller');

class WojewodztwaController extends DataobjectsController
{
    public function view()
    {
        parent::_prepareView();
        $this->innerSearch('gminy', array(
            'wojewodztwo_id' => $this->object->object_id,
        ), array(
            'searchTitle' => sprintf(__d('dane', 'LC_DANE_GMINY_W_WOJEWODZTWIE'), $this->object->getData('nazwa')),
        ));
    }
} 