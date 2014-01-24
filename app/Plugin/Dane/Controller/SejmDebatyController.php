<?php

App::uses('DataobjectsController', 'Dane.Controller');

class SejmDebatyController extends DataobjectsController
{
    public $uses = array('Dane.Dataobject');
    public $menu = array(
        array(
            'id' => 'view',
            'label' => 'LC_DANE_STENOGRAM',
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
        $url = 'http://sejmometr.pl/sejm_debaty/' . $this->object->getId();
        $this->redirect($url);
        die();

        parent::view();
        $stenogram = $this->Dataobject->find('all', array(
            'conditions' => array(
                'dataset' => 'sejm_wystapienia',
                'debata_id' => $this->object->object_id,
                'sort' => 'kolejnosc',
                'direction' => 'asc',
            ),
            'limit' => 100,
        ));
        foreach ($stenogram as &$wpis) {
            $wpis['Dataobject']->loadLayer('html');

        }
        $this->set(compact('stenogram'));
    }

    public function wystapienia()
    {
        parent::view();
        $this->innerSearch('sejm_wystapienia', array('debata_id' => $this->object->object_id));
    }

    public function glosowania()
    {
        parent::view();
        $this->innerSearch('sejm_glosowania', array('debata_id' => $this->object->object_id));
    }
} 