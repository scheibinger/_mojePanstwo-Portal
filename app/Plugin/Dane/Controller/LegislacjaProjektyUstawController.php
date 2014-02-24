<?php

App::uses('DataobjectsController', 'Dane.Controller');

class LegislacjaProjektyUstawController extends DataobjectsController
{
    public $menu = array();
    
    public $objectOptions = array(
    	'hlFields' => array('status_str'),
    );

    public function view()
    {
        
        parent::view();
        
        if ($this->object->getData('typ_id') == '2' && stripos($this->here, '/legislacja_projekty_ustaw') === 0) {
            $this->redirect(array('plugin' => 'Dane', 'controller' => 'legislacja_projekty_uchwal', 'id' => $this->request->params->id), '301');
        } elseif ($this->object->getData('nadrzedny_projekt_id') && ($this->object->getData('typ_id') == '1' || $this->object->getData('typ_id') == '2')) {
            if ($this->object->getData('typ_id') == '1')
                $this->redirect(array('plugin' => 'Dane', 'controller' => 'legislacja_projekty_ustaw', 'id' => $this->object->getData('nadrzedny_projekt_id')), '301');
            elseif ($this->OBJECT->data['typ_id'] == '2')
                $this->redirect(array('plugin' => 'Dane', 'controller' => 'legislacja_projekty_uchwal', 'id' => $this->object->getData('nadrzedny_projekt_id')), '301');
        }
		
		$menu = array();
		
		$related = $this->object->getLayer('related');
		$groups = $related['groups'];
		
		foreach( $groups as $group )
			$menu[] = array(
				'id' => $group['id'],
				'label' => $group['title'],
			);

		
		$this->set('_menu', $menu);

    }

} 