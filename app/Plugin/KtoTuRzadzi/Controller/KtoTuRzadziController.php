<?php

class KtoTuRzadziController extends AppController
{
    public $components = array(
        'Session',
        'RequestHandler'
    );

    public function index()
    {
        $data = $this->API->KtoTuRzadzi()->getData();
        $this->set('data', $data);
        $this->set('title_for_layout', 'Kto tu rządzi?');
    }

} 