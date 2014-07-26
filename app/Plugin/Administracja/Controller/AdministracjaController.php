<?php

class AdministracjaController extends AppController
{
    public $components = array(
        'Session',
        'RequestHandler'
    );

    public function index()
    {
        $data = $this->API->Administracja()->getData();
        $this->set('data', $data);

    }

} 