<?php

App::uses('DataobjectsController', 'Dane.Controller');

class GminyController extends DataobjectsController
{
    public $menu = array(
        array(
            'label' => 'LC_DANE_START',
            'id' => 'view',
        ),
        array(
            'label' => 'LC_DANE_RADNI_GMINY',
            'id' => 'radni',
        ),
        array(
            'label' => 'LC_DANE_WSKAZNIKI',
            'id' => 'wskazniki',
        ),
        array(
            'label' => 'LC_DANE_ZAMOWIENIA_PUBLICZNE',
            'id' => 'zamowienia_publiczne',
        ),
        array(
            'label' => 'LC_DANE_MAPA',
            'id' => 'map',
        ),
    );

    public $menuMode = 'vertical';

    public $helpers = array(
        'Number' => array(
            'className' => 'Dane.NumberPlus',
        ),
    );

    public function view()
    {

        parent::_prepareView();
        $url = 'http://sejmometr.pl/gminy/' . $this->object->getId();
        $this->redirect($url);
        die();

        parent::view();
        $wskazniki = $this->object->loadLayer('wskazniki');
        $rada_komitety = $this->object->loadLayer('rada_komitety');
        $wskazniki = array_slice($wskazniki, 0, 5, true);

        if ($this->object->getId() == '903') {


            $this->API->searchDataset('prawo_lokalne', array(
                'limit' => 3,
            ));
            $this->set('prawo_lokalne', $this->API->getObjects());


            $this->API->searchDataset('rady_posiedzenia', array(
                'limit' => 6,
            ));
            $this->set('rady_posiedzenia', $this->API->getObjects());


            $this->API->searchDataset('rady_druki', array(
                'limit' => 6,
            ));
            $this->set('rady_druki', $this->API->getObjects());


        }


        $this->API->searchDataset('zamowienia_publiczne', array(
            'limit' => 16,
            'conditions' => array(
                'gmina_id' => $this->object->getId(),
            ),
        ));
        $this->set('zamowienia_publiczne', $this->API->getObjects());


        $this->API->searchDataset('radni_gmin', array(
            'limit' => 16,
            'conditions' => array(
                'gmina_id' => $this->object->getId(),
            ),
        ));
        $this->set('radni', $this->API->getObjects());


        $this->set(compact('wskazniki', 'rada_komitety'));
    }

    public function radni()
    {
        parent::_prepareView();

        $title_for_layout = 'Radni gminy ' . $this->object->getData('nazwa');
        $this->innerSearch('radni_gmin', array('gmina_id' => $this->object->object_id), array(
            'searchTitle' => $title_for_layout,
        ));

        $this->set('title_for_layout', $title_for_layout);
    }

    public function wskazniki()
    {
        parent::_prepareView();
        $this->innerSearch('bdl_wskazniki', array(
            'fields' => 'id, dataset, object_id, score, _data_*',
            '_multidata_gmina_id' => $this->object->object_id,
        ), array(
            'searchTitle' => sprintf(__d('dane', 'LC_DANE_WSKAZNIKI_W_GMINIE'), $this->object->getData('nazwa')),
        ));
    }

    public function zamowienia_publiczne()
    {
        parent::_prepareView();

        $title_for_layout = 'Zamówienia publiczne na terenie gminy ' . $this->object->getData('nazwa');
        $this->innerSearch('zamowienia_publiczne', array('gmina_id' => $this->object->getId()), array(
            'searchTitle' => $title_for_layout,
        ));
        $this->set('title_for_layout', $title_for_layout);
    }

    public function rady_gmin_debaty()
    {
        parent::_prepareView();

        $title_for_layout = 'Debaty podczas wszystkich posiedzeń rady gminy ' . $this->object->getData('nazwa');
        $this->innerSearch('rady_gmin_debaty', array('rady_gmin_posiedzenia.gmina_id' => $this->object->getId()), array(
            'searchTitle' => $title_for_layout,
        ));
        $this->set('title_for_layout', $title_for_layout);
    }

    public function rady_gmin_wystapienia()
    {
        parent::_prepareView();

        $title_for_layout = 'Wystąpienia podczas wszystkich posiedzeń rady gminy ' . $this->object->getData('nazwa');
        $this->innerSearch('rady_gmin_wystapienia', array('rady_gmin_debaty.gmina_id' => $this->object->getId()), array(
            'searchTitle' => $title_for_layout,
        ));
        $this->set('title_for_layout', $title_for_layout);
    }


    public function map()
    {
        parent::_prepareView();
        $this->set('spat', $this->object->loadLayer('enspat'));
    }

    public function prawo_lokalne()
    {
        parent::_prepareView();

        $title_for_layout = 'Prawo lokalne w gminie ' . $this->object->getData('nazwa');
        $this->innerSearch('prawo_lokalne', array('gmina_id' => $this->object->getId()), array(
            'searchTitle' => $title_for_layout,
        ));
        $this->set('title_for_layout', $title_for_layout);
    }

    public function darczyncy()
    {
        parent::_prepareView();

        $title_for_layout = 'Darczyńcy komitetów wyborczych w gminie ' . $this->object->getData('nazwa');
        $this->innerSearch('wybory_darczyncy', array(), array(
            'searchTitle' => $title_for_layout,
        ));
        $this->set('title_for_layout', $title_for_layout);
    }


    public function prepareMenu()
    {
        if ($this->object->getId() == '903') {


            $this->menu = array(
                array(
                    'label' => 'LC_DANE_START',
                    'id' => 'view',
                ),
                array(
                    'label' => 'Radni gminy',
                    'id' => 'radni',
                ),
                array(
                    'label' => 'Prawo lokalne',
                    'id' => 'prawo_lokalne',
                ),
                array(
                    'label' => 'Darczyńcy komitetów wyborczych',
                    'id' => 'darczyncy',
                ),
                array(
                    'label' => 'LC_DANE_WSKAZNIKI',
                    'id' => 'wskazniki',
                ),
                array(
                    'label' => 'LC_DANE_ZAMOWIENIA_PUBLICZNE',
                    'id' => 'zamowienia_publiczne',
                ),
                array(
                    'label' => 'LC_DANE_MAPA',
                    'id' => 'map',
                ),
            );


        }
    }
} 