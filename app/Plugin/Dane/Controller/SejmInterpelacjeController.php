<?php

App::uses('DataobjectsController', 'Dane.Controller');
App::uses('Sanitize', 'Utility');

class SejmInterpelacjeController extends DataobjectsController
{
    public $menu = array();
    public $breadcrumbsMode = 'app';

    public function view($package = 1)
    {
        parent::view();
        $t = isset($this->request->params['t_id']) ? $this->request->params['t_id'] : false;
		
		
        $dane = $this->object->loadLayer('dane', array(
            't' => $t,
        ));
		
        $wydarzenia = $dane['wydarzenia'];
        $wydarzenie = $dane['wydarzenie'];
        $teksty = $dane['teksty'];

        $this->set(compact('wydarzenia', 'wydarzenie', 'teksty'));

        if (empty($teksty) && $wydarzenie['dokument_id']) {
            $this->set('document', new MP\Document($wydarzenie['dokument_id']));
            $this->set('documentPackage', $package);
        }
    }

} 