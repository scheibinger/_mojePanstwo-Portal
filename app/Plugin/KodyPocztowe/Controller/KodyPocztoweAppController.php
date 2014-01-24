<?php

class KodyPocztoweAppController extends AppController
{

    public function beforeFilter()
    {
        $this->API = $this->API->KodyPocztowe();
        parent::beforeFilter();
    }

}