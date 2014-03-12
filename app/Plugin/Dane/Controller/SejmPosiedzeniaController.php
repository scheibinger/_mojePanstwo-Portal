<?php

App::uses('DataobjectsController', 'Dane.Controller');

class SejmPosiedzeniaController extends DataobjectsController
{
    public $menu = array();
    public $helpers = array(
        'Number',
    );
    public $uses = array(
        'Dane.Dataobject',
    );
    public $objectOptions = array(
        'bigTitle' => true,
    );

    public function view()
    {

        parent::view();

        $hldata = array();

        if ($this->object->getData('liczba_wystapien'))
            $hldata[] = array(
                'id' => 'liczba_wystapien',
                'label' => 'Liczba wystąpień',
                'value' => $this->object->getData('liczba_wystapien'),
                'options' => array(
                    'type' => 'integer',
                    'link' => array(
                        'href' => '/dane/sejm_posiedzenia/' . $this->object->getId() . '/wystapienia',
                    ),
                ),
            );

        if ($this->object->getData('liczba_glosowan'))
            $hldata[] = array(
                'id' => 'liczba_glosowan',
                'label' => 'Liczba głosowań',
                'value' => $this->object->getData('liczba_glosowan'),
                'options' => array(
                    'type' => 'integer',
                    'link' => array(
                        'href' => '/dane/sejm_posiedzenia/' . $this->object->getId() . '/glosowania',
                    ),
                ),
            );

        if ($this->object->getData('liczba_punktow'))
            $hldata[] = array(
                'id' => 'liczba_punktow',
                'label' => 'Liczba punktów porządku',
                'value' => $this->object->getData('liczba_punktow'),
                'options' => array(
                    'type' => 'integer',
                    'link' => array(
                        'href' => '/dane/sejm_posiedzenia/' . $this->object->getId() . '/punkty',
                    ),
                ),
            );

        if ($this->object->getData('liczba_przyjetych_ustaw'))
            $hldata[] = array(
                'id' => 'liczba_przyjetych_ustaw',
                'label' => 'Liczba przyjętych ustaw',
                'value' => $this->object->getData('liczba_przyjetych_ustaw'),
                'options' => array(
                    'type' => 'integer',
                ),
            );

        if ($this->object->getData('liczba_odrzuconych_ustaw'))
            $hldata[] = array(
                'id' => 'liczba_odrzuconych_ustaw',
                'label' => 'Liczba odrzuconych ustaw',
                'value' => $this->object->getData('liczba_odrzuconych_ustaw'),
                'options' => array(
                    'type' => 'integer',
                ),
            );

        if ($this->object->getData('liczba_przyjetych_uchwal'))
            $hldata[] = array(
                'id' => 'liczba_przyjetych_uchwal',
                'label' => 'Liczba przyjętych uchwał',
                'value' => $this->object->getData('liczba_przyjetych_uchwal'),
                'options' => array(
                    'type' => 'integer',
                ),
            );

        if ($this->object->getData('liczba_odrzuconych_uchwal'))
            $hldata[] = array(
                'id' => 'liczba_odrzuconych_uchwal',
                'label' => 'Liczba odrzuconych uchwał',
                'value' => $this->object->getData('liczba_odrzuconych_uchwal'),
                'options' => array(
                    'type' => 'integer',
                ),
            );

        if ($this->object->getData('liczba_odrzuconych_umow'))
            $hldata[] = array(
                'id' => 'liczba_odrzuconych_umow',
                'label' => 'Liczba odrzuconych umów międzynarodowych',
                'value' => $this->object->getData('liczba_odrzuconych_umow'),
                'options' => array(
                    'type' => 'integer',
                ),
            );

        if ($this->object->getData('liczba_ratyfikowanych_umow'))
            $hldata[] = array(
                'id' => 'liczba_ratyfikowanych_umow',
                'label' => 'Liczba ratyfikowanych umów międzynarodowych',
                'value' => $this->object->getData('liczba_ratyfikowanych_umow'),
                'options' => array(
                    'type' => 'integer',
                ),
            );

        if ($this->object->getData('liczba_przyjetych_sprawozdan_kontrolnych'))
            $hldata[] = array(
                'id' => 'liczba_przyjetych_sprawozdan_kontrolnych',
                'label' => 'Liczba przyjętych sprawozdań kontrolnych',
                'value' => $this->object->getData('liczba_przyjetych_sprawozdan_kontrolnych'),
                'options' => array(
                    'type' => 'integer',
                ),
            );

        if ($this->object->getData('liczba_odrzuconych_sprawozdan_kontrolnych'))
            $hldata[] = array(
                'id' => 'liczba_odrzuconych_sprawozdan_kontrolnych',
                'label' => 'Liczba przyjętych sprawozdań kontrolnych',
                'value' => $this->object->getData('liczba_odrzuconych_sprawozdan_kontrolnych'),
                'options' => array(
                    'type' => 'integer',
                ),
            );

        if ($this->object->getData('liczba_przyjetych_referendow'))
            $hldata[] = array(
                'id' => 'liczba_przyjetych_referendow',
                'label' => 'Liczba przyjętych wniosków o referenda',
                'value' => $this->object->getData('liczba_przyjetych_referendow'),
                'options' => array(
                    'type' => 'integer',
                ),
            );

        if ($this->object->getData('liczba_odrzuconych_referendow'))
            $hldata[] = array(
                'id' => 'liczba_odrzuconych_referendow',
                'label' => 'Liczba odrzuconych wniosków o referenda',
                'value' => $this->object->getData('liczba_odrzuconych_referendow'),
                'options' => array(
                    'type' => 'integer',
                ),
            );

        if ($this->object->getData('liczba_przyjetych_powolan_odwolan'))
            $hldata[] = array(
                'id' => 'liczba_przyjetych_powolan_odwolan',
                'label' => 'Liczba przyjętych powołań / odwołań',
                'value' => $this->object->getData('liczba_przyjetych_powolan_odwolan'),
                'options' => array(
                    'type' => 'integer',
                ),
            );

        if ($this->object->getData('liczba_odrzuconych_powolan_odwolan'))
            $hldata[] = array(
                'id' => 'liczba_odrzuconych_powolan_odwolan',
                'label' => 'Liczba odrzuconych powołań / odwołań',
                'value' => $this->object->getData('liczba_odrzuconych_powolan_odwolan'),
                'options' => array(
                    'type' => 'integer',
                ),
            );

        if ($this->object->getData('liczba_przyjetych_zmian_komisji'))
            $hldata[] = array(
                'id' => 'liczba_przyjetych_zmian_komisji',
                'label' => 'Liczba przyjętych zmian w składach komisji',
                'value' => $this->object->getData('liczba_przyjetych_zmian_komisji'),
                'options' => array(
                    'type' => 'integer',
                ),
            );

        if ($this->object->getData('liczba_odrzuconych_zmian_komisji'))
            $hldata[] = array(
                'id' => 'liczba_odrzuconych_zmian_komisji',
                'label' => 'Liczba przyjętych zmian w składach komisji',
                'value' => $this->object->getData('liczba_odrzuconych_zmian_komisji'),
                'options' => array(
                    'type' => 'integer',
                ),
            );

        if ($this->object->getData('liczba_przyjetych_inne'))
            $hldata[] = array(
                'id' => 'liczba_przyjetych_inne',
                'label' => 'Liczba przyjętych innych dokumentów',
                'value' => $this->object->getData('liczba_przyjetych_inne'),
                'options' => array(
                    'type' => 'integer',
                ),
            );

        if ($this->object->getData('liczba_odrzuconych_inne'))
            $hldata[] = array(
                'id' => 'liczba_odrzuconych_inne',
                'label' => 'Liczba odrzuconych innych dokumentów',
                'value' => $this->object->getData('liczba_odrzuconych_inne'),
                'options' => array(
                    'type' => 'integer',
                ),
            );


        $menu = array(
            array(
                'id' => 'punkty',
                'label' => 'Punkty porządku dziennego',
            ),
        );


        $this->API->searchDataset('sejm_posiedzenia_punkty', array(
            'limit' => 100,
            'conditions' => array(
                'posiedzenie_id' => $this->object->getId(),
            ),
        ));
        $this->set('punkty', $this->API->getObjects());


        $this->set('hldata', $hldata);
        $this->set('_menu', $menu);

    }

    public function wystapienia()
    {

        parent::view();
        $this->dataobjectsBrowserView(array(
            'source' => 'sejm_posiedzenia.wystapienia:' . $this->object->getId(),
            'dataset' => 'sejm_wystapienia',
            'title' => 'Wystąpienia',
            'noResultsTitle' => 'Brak wystąpień',
            // 'hlFields' => array('numer', 'liczba_debat', 'liczba_wystapien', 'liczba_glosowan'),
            // 'order' => 'numer asc',        
        ));

    }

    public function punkty()
    {

        parent::view();
        $this->dataobjectsBrowserView(array(
            'source' => 'sejm_posiedzenia.punkty:' . $this->object->getId(),
            'dataset' => 'sejm_posiedzenia_punkty',
            'title' => 'Punkty porządku dziennego',
            'noResultsTitle' => 'Brak punktów porządku',
            'hlFields' => array('numer', 'liczba_debat', 'liczba_wystapien', 'liczba_glosowan'),
            'order' => 'numer asc',
        ));

    }


} 