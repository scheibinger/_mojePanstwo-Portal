<?php

class PowiadomieniaController extends PowiadomieniaAppController
{
    public $components = array(
        'RequestHandler',
    );

    public function beforeFilter()
    {
        parent::beforeFilter();
        if (!$this->Auth->loggedIn() && $this->params->action != 'permissions') {
            $this->redirect(array('action' => 'permissions'));
        }
    }

    public function permissions()
    {

    }

    public function index()
    {
		
		/*
        $this->data = ($this->data) ? $this->data : (isset($this->request->query['data'])) ? $this->request->query['data'] : null;
        $data = $this->data;
        $phrases = $this->requestAction(array(
            'plugin' => 'powiadomienia',
            'controller' => 'phrases',
            'action' => 'index'
        ), array('return', 'data' => $this->data));

        $objects = $this->requestAction(array(
            'plugin' => 'powiadomienia',
            'controller' => 'dataobjects',
            'action' => 'index'
        ), array('return', 'data' => (isset($data['Dataobject'])) ? $data['Dataobject'] : null, 'extra' => $this->params->query));

        $this->set('phrases', $phrases);
        $this->set('objects', $objects);
        */

    }

}