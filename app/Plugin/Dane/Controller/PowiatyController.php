<?php

App::uses('DataobjectsController', 'Dane.Controller');

class PowiatyController extends DataobjectsController
{
    
    public function view()
    {
    	
    	parent::_prepareView();
    	
    	if( ($this->object->getData('typ_id')=='2') || ($this->object->getData('typ_id')=='3') ) {
	    	if( $gmina_id = $this->object->loadLayer('gmina') ) {
		    	
		    	$this->redirect('/dane/gminy/' . $gmina_id);
		    	
	    	}
    	}
    	
        $this->dataobjectsBrowserView(array(
            'source' => 'powiaty.gminy:' . $this->object->getId(),
            'dataset' => 'gminy',
            'excludeFilters' => array(
                'wojewodztwo_id', 'powiat_id'
            ),
        ));
        
        $this->set('title_for_layout', 'Gminy w powiecie ' . ' ' . $this->object->getData('nazwa'));
       
    }
    
    public function beforeRender()
    {

        // PREPARE MENU		
        $href_base = '/dane/powiaty/' . $this->request->params['id'];

        $menu = array(
            'items' => array(
                array(
                    'id' => '',
                    'href' => $href_base,
                    'label' => 'Gminy',
                ),
            )
        );      

        $menu['selected'] = ($this->request->params['action'] == 'view') ? '' : $this->request->params['action'];
        $this->set('_menu', $menu);

    }
    
} 