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
	
	private function connections_view($id, $title) {
		
		parent::_prepareView();
        $this->dataobjectsBrowserView(array(
            // 'source' => 'poslowie.wspolpracownicy:' . $this->object->getId(),
            'dataset' => 'prawo',
            'noResultsTitle' => 'Brak aktów',
            'conditions' => array(
            	$id => $this->object->getId(),
            ),
        ));
		
		$this->request->params['action'] = $id;
        $this->set('title_for_layout', $title . ': ' . $this->object->getTitle());
		
	}
	
	public function podstawa_prawna() {
		return $this->connections_view('podstawa_prawna', 'Podstawa prawna');		
	}
	
	public function podstawa_prawna_z_artykulem() {
		return $this->connections_view('podstawa_prawna_z_artykulem', 'Podstawa prawna z artykułem');		
	}
	
	public function akty_zmienione() {
		return $this->connections_view('akty_zmienione', 'Akty zmienione');		
	}
	
	public function akty_uchylone() {
		return $this->connections_view('akty_uchylone', 'Akty uchylone');		
	}
	
	public function akty_uznane_za_uchylone() {
		return $this->connections_view('akty_uznane_za_uchylone', 'Akty uznane za uchylone');		
	}
	
	public function orzeczenie_do_aktu() {
		return $this->connections_view('orzeczenie_do_aktu', 'Orzeczenia do aktu');		
	}
	
	public function tekst_jednolity_do_aktu() {
		return $this->connections_view('tekst_jednolity_do_aktu', 'Tekst jednolity do aktu');		
	}
	
	public function orzeczenie_tk() {
		return $this->connections_view('orzeczenie_tk', 'Orzeczenia TK');		
	}
	
	public function informacja_o_tekscie_jednolitym() {
		return $this->connections_view('informacja_o_tekscie_jednolitym', 'Informacje o tekście jednolitym');		
	}
	
	public function akty_zmieniajace() {
		return $this->connections_view('akty_zmieniajace', 'Akty zmieniające');		
	}
	
	public function akty_uchylajace() {
		return $this->connections_view('akty_uchylajace', 'Akty uchylające');		
	}

	public function uchylenia_wynikajace_z() {
		return $this->connections_view('uchylenia_wynikajace_z', 'Uchylenia wynikające z');		
	}
	
	public function dyrektywy_europejskie() {
		return $this->connections_view('dyrektywy_europejskie', 'Dyrektywy europejskie');		
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
	    
	    if( $items = $this->object->getLayer('counters') ) {
		    foreach( $items as $item ) {
		    	
		    	if( $item['count'] )
			    	$menu['items'][] = array(
			    		'id' => $item['slug'],
		                'href' => $href_base . '/' . $item['slug'],
		                'label' => $item['nazwa'],
		                'count' => $item['count'],
			    	);
		    	
		    }
	    }
	    
        $menu['selected'] = ( $this->request->params['action'] == 'view' ) ? '' : $this->request->params['action'];
        
        $this->set('_menu', $menu);
		
	}
	
} 