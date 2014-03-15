<?php

App::uses('DataobjectsController', 'Dane.Controller');

class SejmPosiedzeniaPunktyController extends DataobjectsController
{
    public $uses = array('Dane.Dataobject');
    public $helpers = array('Dane.Dataobject');
    public $menu = array();
    public $autoRelated = false;
    
    public $objectOptions = array(
    	'hlFields' => array('sejm_posiedzenia.tytul', 'numer'),
    );

    public function view()
    {

        parent::view();
        $this->object->loadRelated();
        
        $debaty = array();
		$_related = array(
			'groups' => array(),
		);
		
        if (
            ($related = $this->object->getLayer('related')) &&
            (isset($related['groups'])) &&
            (!empty($related['groups']))
        ) {
            foreach ($related['groups'] as $group) {
                if ($group['id'] == 'debaty')
                    $debaty = $group['objects'];
                else
                	$_related['groups'][] = $group;
            }
        }
		
		$this->object->layers['related'] = $_related;
				
        $this->set('debaty', $debaty);

    }


} 