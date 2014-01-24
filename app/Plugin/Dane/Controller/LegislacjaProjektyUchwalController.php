<?php

App::uses('DataobjectsController', 'Dane.Controller');

class LegislacjaProjektyUchwalController extends DataobjectsController
{
    public $menu = array(
        array(
            'id' => 'related',
            'label' => 'LC_DANE_PRZEBIEG_PRAC',
            'selected' => true,
        ),
    );

    public function related()
    {
        parent::view();
        if ($this->object->getData('typ_id') == '2' && stripos($this->here, '/legislacja_projekty_ustaw') === 0) {
            $this->redirect(array('plugin' => 'Dane', 'controller' => 'legislacja_projekty_uchwal', 'id' => $this->request->params->id), '301');
        } elseif ($this->object->getData('nadrzedny_projekt_id') && ($this->object->getData('typ_id') == '1' || $this->object->getData('typ_id') == '2')) {
            if ($this->object->getData('typ_id') == '1')
                $this->redirect(array('plugin' => 'Dane', 'controller' => 'legislacja_projekty_ustaw', 'id' => $this->object->getData('nadrzedny_projekt_id')), '301');
            elseif ($this->OBJECT->data['typ_id'] == '2')
                $this->redirect(array('plugin' => 'Dane', 'controller' => 'legislacja_projekty_uchwal', 'id' => $this->object->getData('nadrzedny_projekt_id')), '301');
        }
//        $przebieg = $this->

    }

    public function view()
    {

        parent::_prepareView();
        $url = 'http://sejmometr.pl/legislacja_projekty_uchwal/' . $this->object->getId();
        $this->redirect($url);
        die();

        $this->related();
        $this->view = 'related';
    }
} 