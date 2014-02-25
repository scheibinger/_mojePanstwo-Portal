<?php

App::uses('DataobjectsController', 'Dane.Controller');

class BdlWskaznikiGrupyController extends DataobjectsController
{
    public $menu = array();
	
	public $objectOptions = array(
    	'bigTitle' => true,
    );
	
    public function view()
    {
        parent::_prepareView();
        $this->dataobjectsBrowserView(array(
            'source' => 'bdl_wskazniki_grupy.bdl_wskazniki:' . $this->object->getId(),
            'dataset' => 'bdl_wskazniki',
            'title' => __d('dane', 'LC_DANE_BDL_WSKAZNIKI_W_GRUPIE'),
            'noResultsTitle' => 'Brak wskaźników w tej grupie',
            'excludeFilters' => array(
                'grupa_id',
                'kategoria_id',
            ),
            'hlFields' => array('poziom_str', 'data_aktualizacji'),
        ));
    }
} 