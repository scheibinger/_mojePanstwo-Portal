<?php

App::uses('DataobjectsController', 'Dane.Controller');

class SejmKomisjeController extends DataobjectsController
{
    public $menu = array();
    public $breadcrumbsMode = 'app';

    public function view()
    {
        parent::_prepareView();
        $this->dataobjectsBrowserView(array(
            'source' => 'sejm_komisje.poslowie:' . $this->object->getId(),
            'dataset' => 'poslowie',
            'noResultsTitle' => 'Brak posłów w tej komisji',
        ));
    }
} 