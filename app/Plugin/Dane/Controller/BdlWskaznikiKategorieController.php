<?php

App::uses('DataobjectsController', 'Dane.Controller');

class BdlWskaznikiKategorieController extends DataobjectsController
{
    public $menu = array();

    public $objectOptions = array(
        'bigTitle' => true,
    );

    public function view()
    {
        parent::_prepareView();
        $this->dataobjectsBrowserView(array(
            'source' => 'bdl_wskazniki_kategorie.bdl_wskazniki_grupy:' . $this->object->getId(),
            'dataset' => 'bdl_wskazniki_grupy',
            // 'title' => __d('dane', 'LC_DANE_BDL_GRUPY_DLA_KATEGORII'),
            'noResultsTitle' => 'Brak grup wskaźników w tej kategorii',
            'excludeFilters' => array(
                'kategoria_id',
            ),
            'hlFields' => array(),
        ));
    }
    
    public function beforeRender()
    {

        // debug( $this->object->getData() ); die();

        // PREPARE MENU		
        $href_base = '/dane/bdl_wskazniki_kategorie/' . $this->request->params['id'];

        $menu = array(
            'items' => array(
                array(
                    'id' => '',
                    'href' => $href_base,
                    'label' => 'Grupy w tej kategorii',
                ),
            )
        );

        $menu['selected'] = ($this->request->params['action'] == 'view') ? '' : $this->request->params['action'];
        $this->set('_menu', $menu);

    }
    
} 