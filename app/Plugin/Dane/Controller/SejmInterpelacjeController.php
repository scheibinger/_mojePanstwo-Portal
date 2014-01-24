<?php

App::uses('DocsObjectsController', 'Dane.Controller');
App::uses('Sanitize', 'Utility');

class SejmInterpelacjeController extends DocsObjectsController
{
    public $menu = array();

    public function view()
    {

        parent::_prepareView();
        $url = 'http://sejmometr.pl/sejm_interpelacje/' . $this->object->getId();
        $this->redirect($url);
        die();

        parent::view();
        $dane = $this->object->loadLayer('dane', $this->request->query);

        $wydarzenia = $dane['wydarzenia'];
        $wydarzenie = $dane['wydarzenie'];
        $teksty = $dane['teksty'];

        $this->set(compact('wydarzenia', 'wydarzenie', 'teksty'));

        if (empty($teksty) && $wydarzenie['s_interpelacje_tablice']['dokument_id']) {
            $this->set('document', new MP\Document($wydarzenie['s_interpelacje_tablice']['id']));
        }
    }

} 