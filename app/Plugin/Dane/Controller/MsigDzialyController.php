<?php

App::uses('DocsObjectsController', 'Dane.Controller');

class MsigDzialyController extends DocsObjectsController
{
	public function view()
    {

        parent::_prepareView();
        $this->redirect('/dane/msig/' . $this->object->getData('msig.id') . '/dzialy/' . $this->object->getId());
        die();

    }
}