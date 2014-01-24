<?php

class DaneAppController extends AppController
{

    public $dataBrowser = false;

    public $helpers = array(
        'Dane.Dataobject',
        'Dane.DataobjectsSlider',
    );

    public function dataobjectsBrowserView($params = array())
    {

        $this->dataBrowser = $this->Components->load('Dane.DataobjectsBrowser', $params);

    }

    public function beforeFilter()
    {
        parent::beforeFilter();
        $this->API = $this->API->Dane();
    }

}