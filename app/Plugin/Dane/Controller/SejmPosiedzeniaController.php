<?php

App::uses('DataobjectsController', 'Dane.Controller');

class SejmPosiedzeniaController extends DataobjectsController
{
    public $menu = array();
    public $helpers = array(
        'Number',
    );
    public $uses = array(
        'Dane.Dataobject',
    );
    public $objectOptions = array(
    	'bigTitle' => true,
    );
	
	public $hlmap = array(
		array(
			'id' => 'liczba_wystapien',
			'label' => 'Wystąpienia',
			'href' => 'wystapienia',
		),
		array(
			'id' => 'liczba_glosowan',
			'label' => 'Głosowania',
			'href' => 'glosowania',
		),
		array(
			'id' => 'liczba_punktow',
			'label' => 'Punkty porządku dziennego',
			'href' => 'punkty',
		),
		array(
			'id' => 'liczba_przyjetych_ustaw',
			'label' => 'Przyjęte ustawy',
			'href' => 'przyjete_ustawy',
		),
		array(
			'id' => 'liczba_odrzuconych_ustaw',
			'label' => 'Odrzucone ustawy',
			'href' => 'odrzucone_ustawy',
		),
		array(
			'id' => 'liczba_przyjetych_uchwal',
			'label' => 'Przyjęte uchwały',
			'href' => 'przyjete_uchwaly',
		),
		array(
			'id' => 'liczba_odrzuconych_uchwal',
			'label' => 'Odrzucone uchwały',
			'href' => 'odrzucone_uchwaly',
		),
		array(
			'id' => 'liczba_ratyfikowanych_umow',
			'label' => 'Ratyfikowane umowy międzynarodowe',
			'href' => 'ratyfikowane_umowy',
		),
		array(
			'id' => 'liczba_odrzuconych_umow',
			'label' => 'Odrzucone umowy międzynarodowe',
			'href' => 'odrzucone_umowy',
		),
		array(
			'id' => 'liczba_przyjetych_sprawozdan_kontrolnych',
			'label' => 'Przyjęte sprawozdania kontrolne',
			'href' => 'przyjete_sprawozdania_kontrolne',
		),
		array(
			'id' => 'liczba_odrzuconych_sprawozdan_kontrolnych',
			'label' => 'Odrzucone sprawozdania kontrolne',
			'href' => 'odrzucone_sprawozdania_kontrolne',
		),
		array(
			'id' => 'liczba_przyjetych_referendow',
			'label' => 'Przyjęte wnioski o referenda',
			'href' => 'przyjete_referenda',
		),
		array(
			'id' => 'liczba_odrzuconych_referendow',
			'label' => 'Odrzucone wnioski o referenda',
			'href' => 'odrzucone_referenda',
		),
		array(
			'id' => 'liczba_przyjetych_powolan_odwolan',
			'label' => 'Przyjęte powołania / odwołania',
			'href' => 'przyjete_powolania_odwolania',
		),
		array(
			'id' => 'liczba_odrzuconych_powolan_odwolan',
			'label' => 'Odrzucone powołania / odwołania',
			'href' => 'odrzucone_powolania_odwolania',
		),
		array(
			'id' => 'liczba_przyjetych_zmian_komisji',
			'label' => 'Przyjęte zmiany w składach komisji',
			'href' => 'przyjete_zmiany_komisji',
		),
		array(
			'id' => 'liczba_odrzuconych_zmian_komisji',
			'label' => 'Odrzucone zmiany w składach komisji',
			'href' => 'odrzucone_zmiany_komisji',
		),
		array(
			'id' => 'liczba_przyjetych_inne',
			'label' => 'Przyjęte inne dokumenty',
			'href' => 'przyjete_inne',
		),
		array(
			'id' => 'liczba_odrzuconych_inne',
			'label' => 'Odrzucone inne dokumenty',
			'href' => 'odrzucone_inne',
		),
	);
	
	
		

			
			
	
	
    public function view()
    {
		
		parent::view();
		
		
		
		
		// PREPARING HIGHLIGHTS TABLE
		
		$hldata = array();
		foreach( $this->hlmap as $item )
		{
			if( $this->object->getData( $item['id'] ) )
			{
				
				$options = array(
					'type' => 'integer',
				);
				
				if( isset($item['href']) && $item['href'] )
					$options['link'] = array(
						'href' => '/dane/sejm_posiedzenia/' . $this->object->getId() . '/' . $item['href'],
					);
				
				$hldata[] = array(
					'id' => $item['id'],
					'label' => $item['label'],
					'value' => $this->object->getData( $item['id'] ),
					'options' => $options,
				);
			}
		}
		

	

		// PREPARE MENU
		
		$menu = array(
			array(
				'id' => 'punkty',
				'label' => 'Punkty porządku dziennego',
			),
		);
		

		
		$this->API->searchDataset('sejm_posiedzenia_punkty', array(
            'limit' => 100,
            'conditions' => array(
                'posiedzenie_id' => $this->object->getId(),
            ),
        ));
        $this->set('punkty', $this->API->getObjects());
        
        
		
		$this->set('hldata', $hldata);
		$this->set('_menu', $menu);
        
    }
    
    public function wystapienia()
    {

        parent::view();
        $this->dataobjectsBrowserView(array(
            'source' => 'sejm_posiedzenia.wystapienia:' . $this->object->getId(),
            'dataset' => 'sejm_wystapienia',
            'title' => 'Wystąpienia',
            'noResultsTitle' => 'Brak wystąpień',
            'order' => 'kolejnosc asc',        
        ));
        
    }
    
    public function punkty()
    {

        parent::view();
        $this->dataobjectsBrowserView(array(
            'source' => 'sejm_posiedzenia.punkty:' . $this->object->getId(),
            'dataset' => 'sejm_posiedzenia_punkty',
            'title' => 'Punkty porządku dziennego',
            'noResultsTitle' => 'Brak punktów porządku',
            'hlFields' => array('numer', 'liczba_debat', 'liczba_wystapien', 'liczba_glosowan'),
            'order' => 'numer asc',        
        ));
        
    }

    
} 