<?php

App::uses('DataobjectsController', 'Dane.Controller');

class SejmKlubyController extends DataobjectsController
{

    public $menu = array();

    public function view()
    {
        parent::_prepareView();
        $this->dataobjectsBrowserView(array(
            'source' => 'sejm_kluby.poslowie:' . $this->object->getId(),
            'dataset' => 'poslowie',
            'title' => __d('dane', 'LC_POSLOWIE_W_KLUBIE'),
            'noResultsTitle' => 'Brak posłów w tym klubie',
            'excludeFilters' => array(
                'klub_id',
            ),
        ));
    }
} 