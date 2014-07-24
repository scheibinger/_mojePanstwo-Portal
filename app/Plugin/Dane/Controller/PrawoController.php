<?php

App::uses('DataobjectsController', 'Dane.Controller');

class PrawoController extends DataobjectsController
{
	
	public $initLayers = array('docs', 'tags', 'counters');
	public $helpers = array('Document');
	
	public $objectOptions = array(
        // 'hlFields' => array('isap_status_str', 'sygnatura', 'data_wydania', 'data_publikacji', 'data_wejscia_w_zycie'),
        'hlFields' => array(),
    );
    
	
	public function view($package = 1) {
		
		$this->_prepareView();
		
		$this->set('document', $this->API->document( $this->object->getData('dokument_id') ));
		
		
		
		/*
		$docs = $this->object->getLayer('docs');
        $selected_doc_id = $this->object->getData('dokument_id');

        if (@$this->request->query['f'])
            foreach ($docs as $category)
                foreach ($category['files'] as $file)
                    if ($file['files']['dokument_id'] == $this->request->query['f']) {
                        $selected_doc_id = $file['files']['dokument_id'];
                        break;
                    }

        $document = $this->API->document($selected_doc_id);
        if ($this->request->isAjax()) {
            $this->set('html', $document->loadHtml($package));
            $this->set('_serialize', 'html');
        } else {
            $this->set(array(
                'docs' => $docs,
                'document' => $document,
                'documentPackage' => $package,
            ));

        }
        */
		
	}
	
	
	public function beforeRender()
	{
		
		
		
        // PREPARE MENU		
		$href_base = '/dane/prawo/' . $this->request->params['id'];
        
        $menu = array(
            'items' => array(
	            array(
	            	'id' => '',
	                'href' => $href_base,
	                'label' => 'Treść',
	            ),
	        )
	    );
	    
	    /*
	    if( $items = $this->object->getLayer('counters') ) {
		    foreach( $items as $item ) {
		    	
		    	$menu['items'][] = array(
		    		'id' => $item['slug'],
	                'href' => $href_base . '/' . $item['slug'],
	                'label' => $item['nazwa'],
	                'count' => $item['count'],
		    	);
		    	
		    }
	    }
	    */
		
	    
        $menu['selected'] = ( $this->request->params['action'] == 'view' ) ? '' : $this->request->params['action'];
        
        $this->set('_menu', $menu);
		
	}
	
} 