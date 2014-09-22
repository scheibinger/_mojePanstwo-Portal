<?php

App::uses('DataobjectsController', 'Dane.Controller');

class PrawoProjektyController extends DataobjectsController
{
    public $menu = array();

    public $objectOptions = array(
        'hlFields' => array('status_str'),
    );
    
    public $initLayers = array('related');

    public function view()
    {

        parent::view();

        if ($this->object->getData('nadrzedny_projekt_id')) {
            $this->redirect(array(
                'plugin' => 'Dane',
                'controller' => 'prawo_projekty',
                'action' => '',
                'id' => $this->object->getData('nadrzedny_projekt_id')
            ), '301');
        }

        $menu = array();

        $related = $this->object->getLayer('related');
        $groups = $related['groups'];

        foreach ($groups as $group)
            $menu[] = array(
                'id' => $group['id'],
                'label' => $group['title'],
            );


        $this->set('_menu', $menu);

    }

} 