<?php

App::uses('DataobjectsController', 'Dane.Controller');

class WojewodztwaController extends DataobjectsController
{
    
    public function view()
    {
    	
    	parent::_prepareView();
        $this->dataobjectsBrowserView(array(
            'source' => 'wojewodztwa.gminy:' . $this->object->getId(),
            'dataset' => 'gminy',
            'excludeFilters' => array(
                'wojewodztwo_id',
            ),
        ));
        
        $this->set('title_for_layout', __d('dane', 'LC_DANE_GMINY_W_WOJEWODZTWIE') . ' ' . $this->object->getData('nazwa'));
       
    }
    
    public function powiaty()
    {
    	
    	parent::_prepareView();
        $this->dataobjectsBrowserView(array(
            'source' => 'wojewodztwa.powiaty:' . $this->object->getId(),
            'dataset' => 'powiaty',
            'excludeFilters' => array(
                'wojewodztwo_id',
            ),
        ));
        
        $this->set('title_for_layout', 'Powiaty w województwie ' . $this->object->getData('nazwa'));
       
    }
    
    public function beforeRender()
    {

        // PREPARE MENU		
        $href_base = '/dane/wojewodztwa/' . $this->request->params['id'];

        $menu = array(
            'items' => array(
                array(
                    'id' => '',
                    'href' => $href_base,
                    'label' => 'Gminy',
                ),
                array(
                    'id' => 'powiaty',
                    'href' => $href_base . '/powiaty',
                    'label' => 'Powiaty',
                ),
            )
        );      

        $menu['selected'] = ($this->request->params['action'] == 'view') ? '' : $this->request->params['action'];
        $this->set('_menu', $menu);

    }
} 