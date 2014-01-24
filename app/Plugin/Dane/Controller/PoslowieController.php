<?php

App::uses('DataobjectsController', 'Dane.Controller');

class PoslowieController extends DataobjectsController
{

    public $components = array(
        'RequestHandler',
    );

    public $menuMode = 'horizontal';
    public $menu = array(
        array(
            'id' => 'view',
            'label' => 'LC_DANE_INFORMACJE',
        ),
        array(
            'id' => 'aktywnosci',
            'label' => 'Aktywności w Sejmie',
        ),
        array(
            'id' => 'glosowania',
            'label' => 'Wyniki głosowań',
        ),
        /*
        array(
            'id' => 'wspolpracownicy',
            'label' => 'LC_DANE_WSPOLPRACOWNICY',
        ),
        array(
            'id' => 'komisje',
            'label' => 'LC_DANE_KOMISJE',
        ),
        array(
            'id' => 'rejestrkorzysci',
            'label' => 'LC_DANE_REJESTR_KORZYSCI',
        ),
        array(
            'id' => 'oswiadczeniamajatkowe',
            'label' => 'LC_DANE_OSWIADCZENIA_MAJATKOWE',
        ),
        */
    );

    public function view()
    {

        parent::_prepareView();
        $url = 'http://sejmometr.pl/poslowie/' . $this->object->getId();
        $this->redirect($url);
        die();

        parent::view();
        $this->set('info', $this->object->loadLayer('info'));
        $this->set('krs', $this->object->loadLayer('krs'));
        $this->set('stats', $this->object->loadLayer('stat'));
    }

    public function aktywnosci()
    {

        parent::_prepareView();
        $this->dataobjectsBrowserView(array(
            'source' => 'poslowie.aktywnosci:' . $this->object->getId(),
        ));
    }

    public function glosowania()
    {
        parent::_prepareView();
        $this->dataobjectsBrowserView(array(
            'source' => 'poslowie.glosowania:' . $this->object->getId(),
            'dataset' => 'poslowie_glosy',
        ));
    }

    public function timeline()
    {

        parent::_prepareView();

        $this->API->search(array(
            'conditions' => array(
                '_source' => 'poslowie.aktywnosci:' . $this->object->getId(),
            ),
            'q' => 'test',
            'limit' => '100',
            'order' => 'date desc'
        ));

        $objects = $this->API->getObjects();


        $output = array(
            'timeline' => array(
                'headline' => 'Ostatnie aktywności posła Jana Kowalskiego',
                'type' => 'default',
                'text' => "<p>Ta linia czasu pokazuje ostatnie aktywności w Sejmie posła Jana Kowalskiego.</p>",
                'font' => 'NewsCycle-Merriweather',
                'date' => array(),
            ),
        );


        foreach ($objects as $object) {

            $dataset = $object->getDataset();

            $date = $object->getDate();
            $dateParts = explode('-', $date);
            $date = $dateParts[0] . ',' . $dateParts[1] . ',' . $dateParts[2];

            switch ($dataset) {

                case 'sejm_wystapienia':
                {


                    $output['timeline']['date'][] = array(
                        'startDate' => $date,
                        'headline' => 'Wystąpienie w Sejmie',
                        'text' => '<p>Poseł wziął udział w debacie Sejmowej</p>',
                        'tag' => 'Wystąpienie w Sejmie',
                        'classname' => 'klasa',
                        'asset' => array(
                            'media' => 'http://mojepanstwo/dane/poslowie/123',
                            'thumbnail' => 'optional-32x32px.jpg',
                            'credit' => 'Credit Name Goes Here',
                            'caption' => 'Caption text goes here',
                        ),
                    );

                    break;

                }

                case 'sejm_interpelacje':
                {

                    $output['timeline']['date'][] = array(
                        'startDate' => $date,
                        'headline' => $object->getData('tytul'),
                        'text' => '<p>Poseł złożył interpelację</p>',
                        'tag' => 'Interpelacja',
                        'classname' => 'klasa',
                        'asset' => array(
                            'media' => 'http://mojepanstwo/dane/poslowie/123',
                            'thumbnail' => 'optional-32x32px.jpg',
                            'credit' => 'Credit Name Goes Here',
                            'caption' => 'Caption text goes here',
                        ),
                    );

                    break;

                }

            }

        }


        $this->set('data', $output);
        $this->set('_serialize', 'data');

    }

}