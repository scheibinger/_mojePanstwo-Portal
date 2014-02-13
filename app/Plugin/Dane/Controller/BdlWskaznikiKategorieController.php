<?php

App::uses('DataobjectsController', 'Dane.Controller');

class BdlWskaznikiKategorieController extends DataobjectsController
{
    public $menu = array();

    public function view()
    {
        parent::_prepareView();
        $this->dataobjectsBrowserView(array(
            'source' => 'bdl_wskazniki_kategorie.bdl_wskazniki_grupy:' . $this->object->getId(),
            'dataset' => 'bdl_wskazniki_grupy',
            'title' => __d('dane', 'LC_DANE_BDL_GRUPY_DLA_KATEGORII'),
            'noResultsTitle' => 'Brak grup wskaźników w tej kategorii',
            'excludeFilters' => array(
                'kategoria_id',
            ),
            'hlFields' => array(),
        ));
    }
} 