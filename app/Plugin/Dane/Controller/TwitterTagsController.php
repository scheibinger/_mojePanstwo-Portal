<?php

App::uses('DataobjectsController', 'Dane.Controller');

class TwitterTagsController extends DataobjectsController
{
    public function view()
    {
        parent::_prepareView();
        $this->innerSearch('twitter', array(
            'q' => '#' . $this->object->getData('tag'),
        ), array(
            'searchTitle' => sprintf(__d('dane', 'LC_DANE_TWITTY_OZNACZONE_TAGIEM'), '#' . $this->object->getData('tag')),
        ));
    }
} 