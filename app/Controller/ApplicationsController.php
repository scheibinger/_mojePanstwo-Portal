<?php

class ApplicationsController extends AppController
{

    public function index()
    {
        $this->set('apps', $this->Application->find('all'));
    }

}