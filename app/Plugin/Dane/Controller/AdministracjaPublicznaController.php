<?php

App::uses('DataobjectsController', 'Dane.Controller');

class AdministracjaPublicznaController extends DataobjectsController
{
    public $menu = array();
	public $initLayers = array('nav', 'tree', 'menu', 'info');
	
	public function prawo()
    {
        parent::_prepareView();
        $this->dataobjectsBrowserView(array(
            'source' => 'administracja_publiczna.prawo:' . $this->object->getId(),
            'dataset' => 'prawo',
            'noResultsTitle' => 'Brak aktów prawnych',
            'excludeFilters' => array(
                'autor_id',
            ),
        ));

        $this->set('title_for_layout', "Akty prawne wydane przez " . $this->object->getTitle());

    }
    
    public function zamowienia()
    {
        parent::_prepareView();
        $this->dataobjectsBrowserView(array(
            'source' => 'administracja_publiczna.zamowienia_udzielone:' . $this->object->getId(),
            'dataset' => 'zamowienia_publiczne',
            'noResultsTitle' => 'Brak zamówień',
        ));
        
        $this->set('title_for_layout', "Zamówienia publiczne udzielone przez " . $this->object->getTitle());
    }
    
    public function budzet()
    {
    	
    	$this->addInitLayers(array('budzet'));
    	
        parent::_prepareView();
        $this->set('title_for_layout', "Budżet " . $this->object->getTitle());
        
        $this->render('budzet');
    }
	
	public function beforeRender()
    {

        // debug( $this->object->getLayer('menu') ); die();
		
		$_menu = $this->object->getLayer('menu');
		
        // PREPARE MENU		
        $href_base = '/dane/administracja_publiczna/' . $this->request->params['id'];

        $menu = array(
            'items' => array(
                array(
                    'id' => '',
                    'href' => $href_base,
                    'label' => 'Informacje',
                ),
            )
        );
		
		if( isset($_menu['budzet_czesci']) && !empty($_menu['budzet_czesci']) )
			$menu['items'][] = array(
				'id' => 'budzet',
				'href' => $href_base . '/budzet',
				'label' => 'Budżet',
			);
		
		if( isset($_menu['zamowienia_udzielone']) && !empty($_menu['zamowienia_udzielone']) )
			$menu['items'][] = array(
				'id' => 'zamowienia',
				'href' => $href_base . '/zamowienia',
				'label' => 'Zamówienia',
			);
		
		if( isset($_menu['prawo']) && $_menu['prawo'] )
			$menu['items'][] = array(
				'id' => 'prawo',
				'href' => $href_base . '/prawo',
				'label' => 'Akty prawne',
			);
			
		
			
		
		
        $menu['selected'] = ($this->request->params['action'] == 'view') ? '' : $this->request->params['action'];

        $this->set('_menu', $menu);

    }
	
} 