<?php

App::uses('DataobjectsController', 'Dane.Controller');

class SejmPosiedzeniaController extends DataobjectsController
{
    public $menu = array();
    public $autoRelated = false;
    public $helpers = array(
        'Number',
    );
    public $uses = array(
        'Dane.Dataobject',
    );
    public $objectOptions = array(
        'bigTitle' => true,
    );

    public $breadcrumbsMode = 'app';

    public $hlmap = array(
        array(
            'id' => 'liczba_wystapien',
            'label' => 'Wystąpienia',
            'href' => 'wystapienia',
        ),
        array(
            'id' => 'liczba_glosowan',
            'label' => 'Głosowania',
            'href' => 'glosowania',
        ),
        array(
            'id' => 'liczba_punktow',
            'label' => 'Punkty porządku dziennego',
            'href' => 'punkty',
        ),
        array(
            'id' => 'liczba_przyjetych_ustaw',
            'label' => 'Przyjęte ustawy',
            'href' => 'projekty#przyjete_ustawy',
        ),
        array(
            'id' => 'liczba_odrzuconych_ustaw',
            'label' => 'Odrzucone ustawy',
            'href' => 'projekty#odrzucone_ustawy',
        ),
        array(
            'id' => 'liczba_przyjetych_uchwal',
            'label' => 'Przyjęte uchwały',
            'href' => 'projekty#przyjete_uchwaly',
        ),
        array(
            'id' => 'liczba_odrzuconych_uchwal',
            'label' => 'Odrzucone uchwały',
            'href' => 'projekty#odrzucone_uchwaly',
        ),
        /*
        array(
            'id' => 'liczba_ratyfikowanych_umow',
            'label' => 'Ratyfikowane umowy międzynarodowe',
            'href' => 'projekty#ratyfikowane_umowy',
        ),
        array(
            'id' => 'liczba_odrzuconych_umow',
            'label' => 'Odrzucone umowy międzynarodowe',
            'href' => 'projekty#odrzucone_umowy',
        ),
        array(
            'id' => 'liczba_przyjetych_sprawozdan_kontrolnych',
            'label' => 'Przyjęte sprawozdania kontrolne',
            'href' => 'projekty#przyjete_sprawozdania_kontrolne',
        ),
        array(
            'id' => 'liczba_odrzuconych_sprawozdan_kontrolnych',
            'label' => 'Odrzucone sprawozdania kontrolne',
            'href' => 'projekty#odrzucone_sprawozdania_kontrolne',
        ),
        array(
            'id' => 'liczba_przyjetych_referendow',
            'label' => 'Przyjęte wnioski o referenda',
            'href' => 'projekty#przyjete_referenda',
        ),
        array(
            'id' => 'liczba_odrzuconych_referendow',
            'label' => 'Odrzucone wnioski o referenda',
            'href' => 'projekty#odrzucone_referenda',
        ),
        array(
            'id' => 'liczba_przyjetych_powolan_odwolan',
            'label' => 'Przyjęte powołania / odwołania',
            'href' => 'projekty#przyjete_powolania_odwolania',
        ),
        array(
            'id' => 'liczba_odrzuconych_powolan_odwolan',
            'label' => 'Odrzucone powołania / odwołania',
            'href' => 'projekty#odrzucone_powolania_odwolania',
        ),
        array(
            'id' => 'liczba_przyjetych_zmian_komisji',
            'label' => 'Przyjęte zmiany w składach komisji',
            'href' => 'projekty#przyjete_zmiany_komisji',
        ),
        array(
            'id' => 'liczba_odrzuconych_zmian_komisji',
            'label' => 'Odrzucone zmiany w składach komisji',
            'href' => 'projekty#odrzucone_zmiany_komisji',
        ),
        array(
            'id' => 'liczba_przyjetych_inne',
            'label' => 'Przyjęte inne dokumenty',
            'href' => 'projekty#przyjete_inne',
        ),
        array(
            'id' => 'liczba_odrzuconych_inne',
            'label' => 'Odrzucone inne dokumenty',
            'href' => 'projekty#odrzucone_inne',
        ),
        */
    );


    public function beforeRender()
    {

        // PREPARE MENU		
        $href_base = '/dane/sejm_posiedzenia/' . $this->request->params['id'] . '/';

        $menu = array(
            'items' => array(
                array(
                    'id' => '',
                    'href' => $href_base,
                    'label' => 'Rozpatrywane projekty',
                ),
                array(
                    'id' => 'punkty',
                    'href' => $href_base . 'punkty',
                    'label' => 'Punkty porządku dziennego',
                ),
                array(
                    'id' => 'wystapienia',
                    'href' => $href_base . 'wystapienia',
                    'label' => 'Wystąpienia',
                ),
                array(
                    'id' => 'glosowania',
                    'href' => $href_base . 'glosowania',
                    'label' => 'Głosowania',
                ),
            ),
            'selected' => ($this->request->params['action'] == 'view') ? '' : $this->request->params['action'],
        );

        $this->set('_menu', $menu);

    }


    public function view()
    {

        parent::view();
        $this->object->loadLayer('projekty');

    }

    public function punkty()
    {

        parent::view();

        $this->API->searchDataset('sejm_posiedzenia_punkty', array(
            'limit' => 100,
            'conditions' => array(
                'posiedzenie_id' => $this->object->getId(),
            ),
            'order' => 'numer asc',
        ));
        $this->set('punkty', $this->API->getObjects());

    }

    public function wystapienia()
    {

        parent::view();
        $this->dataobjectsBrowserView(array(
            'source' => 'sejm_posiedzenia.wystapienia:' . $this->object->getId(),
            'dataset' => 'sejm_wystapienia',
            'title' => 'Wystąpienia',
            'noResultsTitle' => 'Brak wystąpień',
            'order' => 'kolejnosc asc',
        ));

    }

    public function glosowania()
    {

        parent::view();
        $this->dataobjectsBrowserView(array(
            'source' => 'sejm_posiedzenia.glosowania:' . $this->object->getId(),
            'dataset' => 'sejm_glosowania',
            'title' => 'Głosowania',
            'noResultsTitle' => 'Brak głosowań',
            'order' => 'numer asc',
            'hlFields' => array('numer', 'wynik_id'),
        ));

    }

} 