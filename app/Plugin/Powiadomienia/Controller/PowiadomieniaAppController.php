<?php

class PowiadomieniaAppController extends AppController
{
    public $helpers = array(
        'Dane.Dataobject',
    );

    public function beforeFilter()
    {
        $this->API = $this->API->Powiadomienia();
        parent::beforeFilter();
    }

    public $pagination = array();

}