<?php

App::uses('DataobjectsController', 'Dane.Controller');

class SejmPosiedzeniaPunktyController extends DataobjectsController
{
    public $uses = array('Dane.Dataobject');
    public $menu = array(
        array(
            'id' => 'view',
            'label' => 'LC_DANE_INFORMACJE',
        ),
        array(
            'id' => 'wystapienia',
            'label' => 'LC_DANE_WYSZUKIWARKA_WYSTAPIEN',
        ),
        array(
            'id' => 'glosowania',
            'label' => 'LC_DANE_WYSZUKIWARKA_GLOSOWAN',
        ),
    );

    public function view()
    {

        parent::_prepareView();
        $url = 'http://sejmometr.pl/sejm_posiedzenia_punkty/' . $this->object->getId();
        $this->redirect($url);
        die();

        parent::view();
        $debaty = $this->Dataobject->find('all', array(
            'conditions' => array(
                'punkt_id' => $this->object->object_id,
                'posiedzenie_id' => $this->object->getData('posiedzenie_id'),
                'dataset' => 'sejm_debaty',
            ),
        ));
        $posiedzenia = $this->Dataobject->find('all', array(
            'conditions' => array(
                'object_id' => $this->object->getData('posiedzenie_id'),
                'dataset' => 'sejm_posiedzenia',
            ),
        ));
        $this->set(compact('debaty', 'posiedzenia'));
    }

    public function wystapienia()
    {
        parent::view();
        $this->innerSearch('sejm_wystapienia', array('punkt_id' => $this->object->object_id));
    }

    public function glosowania()
    {
        parent::view();
        $this->innerSearch('sejm_glosowania', array('punkt_id' => $this->object->object_id));
    }
} 