<?php

class KtoTuRzadziController extends AppController
{
    public $uses = array();

    public function index()
    {

        $application = $this->getApplication();
        $this->set('title_for_layout', $application['Application']['name']);

    }
} 