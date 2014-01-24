<?php

App::uses('DataobjectsController', 'Dane.Controller');

class BdlWskaznikiController extends DataobjectsController
{
    public function view()
    {

        parent::_prepareView();
        $url = 'http://sejmometr.pl/bdl_wskazniki/' . $this->object->getId();
        $this->redirect($url);
        die();

    }
} 