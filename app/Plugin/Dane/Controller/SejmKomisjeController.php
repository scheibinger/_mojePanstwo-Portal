<?php

App::uses('DataobjectsController', 'Dane.Controller');

class SejmKomisjeController extends DataobjectsController
{
    public $menu = array();
	
    public function view()
    {
        parent::_prepareView();
        $this->dataobjectsBrowserView(array(
            'source' => 'sejm_kluby.poslowie:' . $this->object->getId(),
            'dataset' => 'poslowie',
            'title' => __d('dane', 'LC_DANE_POSLOWIE_ZASIADAJACY_W_KOMISJI'),
            'noResultsTitle' => 'Brak posłów w tej komisji',
        ));
    }
} 