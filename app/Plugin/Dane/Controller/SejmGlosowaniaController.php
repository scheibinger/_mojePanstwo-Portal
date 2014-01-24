<?php

App::uses('DataobjectsController', 'Dane.Controller');

class SejmGlosowaniaController extends DataobjectsController
{
    public $menu = array(
        array(
            'id' => 'view',
            'label' => 'LC_INDYWIDUALNE_WYNIKI_GLOSWANIA',
        ),
    );

    public function view()
    {

        parent::_prepareView();
        $url = 'http://sejmometr.pl/sejm_glosowania/' . $this->object->getId();
        $this->redirect($url);
        die();

        parent::view();
        $this->innerSearch('poslowie_glosy', array('glosowanie_id' => $this->object->object_id));
    }
} 