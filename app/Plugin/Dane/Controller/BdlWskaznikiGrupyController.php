<?php

App::uses('DataobjectsController', 'Dane.Controller');

class BdlWskaznikiGrupyController extends DataobjectsController
{
    public $menu = array();

    public $objectOptions = array(
        'bigTitle' => true,
        'hlFields' => array(),
    );

    public function view()
    {
        parent::_prepareView();
        $this->dataobjectsBrowserView(array(
            'source' => 'bdl_wskazniki_grupy.bdl_wskazniki:' . $this->object->getId(),
            'dataset' => 'bdl_wskazniki',
            'noResultsTitle' => 'Brak wskaźników w tej grupie',
            'excludeFilters' => array(
                'grupa_id',
                'kategoria_id',
            ),
            'hlFields' => array('poziom_str', 'data_aktualizacji'),
        ));
    }
    
    public function beforeRender()
    {

        // debug( $this->object->getData() ); die();

        // PREPARE MENU		
        $href_base = '/dane/bdl_wskazniki_grupy/' . $this->request->params['id'];

        $menu = array(
            'items' => array(
                array(
                    'id' => '',
                    'href' => $href_base,
                    'label' => 'Wskaźniki w tej grupie',
                ),
            )
        );

        $menu['selected'] = ($this->request->params['action'] == 'view') ? '' : $this->request->params['action'];
        $this->set('_menu', $menu);

    }
    
} 