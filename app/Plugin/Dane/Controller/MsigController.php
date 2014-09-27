<?php

App::uses('DataobjectsController', 'Dane.Controller');

class MSiGController extends DataobjectsController
{
	
	public $initLayers = array('toc');
	public $helpers = array('Document');
	
	public $objectOptions = array(
        // 'hlFields' => array('isap_status_str', 'sygnatura', 'data_wydania', 'data_publikacji', 'data_wejscia_w_zycie'),
        'hlFields' => array(),
    );
    
	
	public function view($package = 1) {
		
		$this->_prepareView();
		
		if( $this->object->getLayer('toc') )
			$this->render('toc');
		else {
			$this->set('document', $this->API->document( $this->object->getData('dokument_id') ));
			$this->render('view');
		}
	}
	
	public function dzialy() {
		
		$this->_prepareView();
		
		if( $id = @$this->request->params['pass'][0] ) {
						
			$dzial = $this->API->getObject('msig_dzialy', $id, array());
			$this->set('document', $this->API->document( $dzial->getData('dokument_id') ));
			
            $this->set('dzial', $dzial);
            $this->set('title_for_layout', $dzial->getTitle());
            $this->render('dzial');
			
		} else $this->redirect('/dane/msig/' . $this->object->getId());
			
	}
	
	public function beforeRender()
	{
		
				
        // PREPARE MENU		
		$href_base = '/dane/msig/' . $this->request->params['id'];
        
        $item = array(
        	'id' => '',
            'label' => 'Dokument',
        );
        
        if( $dzialy = $this->object->getLayer('toc') ) {
	        
	        $item['label'] = 'Spis treści';
	        
	        foreach( $dzialy as $dzial_id => $dzial ) {
	       	
	       		$item['dropdown']['items'][] = array(
	       			'id' => $dzial_id,
	       			'label' => $dzial['nazwa'],
	       			'href' => $href_base . '/dzialy/' . $dzial_id,
	       		);
	       	
	       	}
        }
        
        $menu = array(
            'items' => array(
	            $item
	        )
	    );
	    
        $menu['selected'] = ( $this->request->params['action'] == 'view' ) ? '' : $this->request->params['action'];        
        $this->set('_menu', $menu);
		
	}
	
} 