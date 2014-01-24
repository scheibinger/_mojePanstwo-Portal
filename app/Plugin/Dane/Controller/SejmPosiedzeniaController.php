<?php

App::uses('DataobjectsController', 'Dane.Controller');

class SejmPosiedzeniaController extends DataobjectsController
{
    public $menu = array(
        array(
            'id' => 'view',
            'label' => 'LC_DANE_START',
        ),
        array(
            'id' => 'punkty',
            'label' => 'LC_DANE_PUNKTY_PORZADKU_DZIENNEGO',
        ),
        array(
            'id' => 'poza_punktami',
            'label' => 'LC_DANE_POZA_PORZADKIEM_DZIENNYM',
        ),
        array(
            'id' => 'wystapienia',
            'label' => 'LC_DANE_WYSTAPIENIA',
        ),
        array(
            'id' => 'glosowania',
            'label' => 'LC_DANE_GLOSOWANIA',
        ),
        array(
            'id' => 'debaty',
            'label' => 'LC_DANE_DEBATY',
        )
    );
    public $helpers = array(
        'Number',
    );
    public $uses = array(
        'Dane.Dataobject',
    );

    public function view()
    {

        parent::_prepareView();
        $url = 'http://sejmometr.pl/sejm_posiedzenia/' . $this->object->getId();
        $this->redirect($url);
        die();

        parent::view();
        $ustawy = $this->Dataobject->find('all', array(
            'conditions' => array(
                'dataset' => 'legislacja_projekty_ustaw',
                'faza_id' => 3,
                'status_data' => '[' . date('Y-m-d', strtotime($this->object->getData('data_start'))) . ' TO ' . date('Y-m-d', strtotime($this->object->getData('data_stop'))) . ']',
            ),
        ));
        foreach ($ustawy as &$ustawa) {
            $ustawa = array_pop($ustawa);
        }
        $this->set(compact('ustawy'));
    }

    public function debaty()
    {
        parent::_prepareView();
        $this->innerSearch('sejm_debaty', array('posiedzenie_id' => $this->object->object_id), array('searchTitle' => __d('dane', 'LC_DANE_DEBATY')));
    }

    public function wystapienia()
    {
        parent::_prepareView();
        $this->innerSearch('sejm_wystapienia', array('posiedzenie_id' => $this->object->object_id), array('searchTitle', __d('dane', 'LC_DANE_WYSTAPIENIA')));
    }

    public function punkty()
    {
        parent::_prepareView();
        $this->innerSearch('sejm_posiedzenia_punkty', array('posiedzenie_id' => $this->object->object_id), array('searchTitle' => __d('dane', "LC_DANE_PUNKTY_PORZADKU_DZIENNEGO")));
    }

    public function poza_punktami()
    {
        parent::_prepareView();
        $this->innerSearch('sejm_debaty', array('posiedzenie_id' => $this->object->object_id, 'punkt_id' => 0), array('searchTitle' => __d('dane', 'LC_DANE_POZA_PORZADKIEM_DZIENNYM')));
    }

    public function glosowania()
    {
        parent::_prepareView();
        $this->innerSearch('sejm_glosowania', array('posiedzenie_id' => $this->object->object_id), array('searchTitle' => __d('dane', 'LC_DANE_GLOSOWANIA')));
    }


} 