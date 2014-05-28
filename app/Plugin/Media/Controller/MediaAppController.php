<?php

class MediaAppController extends AppController
{

    public function beforeFilter()
    {
        parent::beforeFilter();
        $this->API = $this->API->Media();
    }

}