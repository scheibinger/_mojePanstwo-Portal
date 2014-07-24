<?php

App::uses('DataobjectsController', 'Dane.Controller');

class KrsOsobyController extends DataobjectsController
{
    public $menu = array();
    public $helpers = array(
        'Time',
    );

    public $objectOptions = array(
        'hlFields' => array(),
    );

    public $initLayers = array('powiazania', 'organizacje');

    public function view()
    {
        parent::view();
        $powiazania = $this->object->getLayer('powiazania');

        if (
            isset($powiazania['posel_id']) &&
            $powiazania['posel_id']
        ) {

            return $this->redirect('/dane/poslowie/' . $powiazania['posel_id'] . '/finanse');

        }

    }
}