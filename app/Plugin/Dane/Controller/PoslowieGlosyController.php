<?php

App::uses('DataobjectsController', 'Dane.Controller');

class PoslowieGlosyController extends DataobjectsController
{
    public function view()
    {
        parent::view();
        $this->redirect('/dane/sejm_glosowania/' . $this->object->getData('sejm_glosowania.id'));
    }
}