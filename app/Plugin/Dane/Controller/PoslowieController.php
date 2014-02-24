<?php

App::uses('DataobjectsController', 'Dane.Controller');

class PoslowieController extends DataobjectsController
{

    public $components = array(
        'RequestHandler',
    );

    public $menu = array();

    public function view()
    {
        
        parent::view();
		
		$menu = array(
			array(
				'id' => 'wystapienia',
				'label' => 'Wystąpienia w Sejmie',
			),
			array(
				'id' => 'interpelacje',
				'label' => 'Interpelacje',
			),
			array(
				'id' => 'wystapienia',
				'label' => 'Projekty ustaw',
			),
			array(
				'id' => 'glosowania',
				'label' => 'Wyniki głosowań',
			),
		);
		
					
		$this->API->searchDataset('sejm_wystapienia', array(
            'limit' => 9,
            'conditions' => array(
                'ludzie.id' => $this->object->getData('ludzie.id'),
            ),
        ));
        $this->set('wystapienia', $this->API->getObjects());
        
        $this->API->searchDataset('sejm_interpelacje', array(
            'limit' => 9,
            'conditions' => array(
                'posel_id' => $this->object->getId(),
            ),
        ));
        $this->set('interpelacje', $this->API->getObjects());
        
        $this->API->searchDataset('legislacja_projekty_ustaw', array(
            'limit' => 9,
            'conditions' => array(
                'posel_id' => $this->object->getId(),
            ),
        ));
        $this->set('projekty_ustaw', $this->API->getObjects());
        
        $this->API->searchDataset('poslowie_glosy', array(
            'limit' => 9,
            'conditions' => array(
                'posel_id' => $this->object->getId(),
            ),
        ));
        $this->set('glosowania', $this->API->getObjects());
		
		
        // $this->set('info', $this->object->loadLayer('info'));
        // $this->set('krs', $this->object->loadLayer('krs'));
        // $this->set('stats', $this->object->loadLayer('stat'));
        
        $this->set('_menu', $menu);
    }

    public function aktywnosci()
    {

        parent::_prepareView();
        $this->dataobjectsBrowserView(array(
            'source' => 'poslowie.aktywnosci:' . $this->object->getId(),
        ));
    }
	
	public function wystapienia()
    {
        parent::_prepareView();
        $this->dataobjectsBrowserView(array(
            'source' => 'poslowie.wystapienia:' . $this->object->getId(),
            'dataset' => 'sejm_wystapienia',
            'title' => 'Wystąpienia w Sejmie',
            'noResultsTitle' => 'Brak wystąpień',
            'hlFields' => array('sejm_debaty.tytul'),
        ));
    }
    
    public function interpelacje()
    {
        parent::_prepareView();
        $this->dataobjectsBrowserView(array(
            'source' => 'poslowie.interpelacje:' . $this->object->getId(),
            'dataset' => 'sejm_interpelacje',
            'title' => 'Interpelacje',
            'noResultsTitle' => 'Brak interpelacji',
        ));
    }
    
    public function projekty_ustaw()
    {
        parent::_prepareView();
        $this->dataobjectsBrowserView(array(
            'source' => 'poslowie.projekty_ustaw:' . $this->object->getId(),
            'dataset' => 'legislacja_projekty_ustaw',
            'title' => 'Złożone projekty ustaw',
            'noResultsTitle' => 'Brak projektów',
        ));
    }
	
    public function glosowania()
    {
        parent::_prepareView();
        $this->dataobjectsBrowserView(array(
            'source' => 'poslowie.glosowania:' . $this->object->getId(),
            'dataset' => 'poslowie_glosy',
            'title' => 'Wyniki głosowań',
            'noResultsTitle' => 'Brak wyników głosowań',
        ));
    }

    public function timeline()
    {

        parent::_prepareView();

        $this->API->search(array(
            'conditions' => array(
                '_source' => 'poslowie.aktywnosci:' . $this->object->getId(),
            ),
            'q' => 'test',
            'limit' => '100',
            'order' => 'date desc'
        ));

        $objects = $this->API->getObjects();


        $output = array(
            'timeline' => array(
                'headline' => 'Ostatnie aktywności posła Jana Kowalskiego',
                'type' => 'default',
                'text' => "<p>Ta linia czasu pokazuje ostatnie aktywności w Sejmie posła Jana Kowalskiego.</p>",
                'font' => 'NewsCycle-Merriweather',
                'date' => array(),
            ),
        );


        foreach ($objects as $object) {

            $dataset = $object->getDataset();

            $date = $object->getDate();
            $dateParts = explode('-', $date);
            $date = $dateParts[0] . ',' . $dateParts[1] . ',' . $dateParts[2];

            switch ($dataset) {

                case 'sejm_wystapienia':
                {


                    $output['timeline']['date'][] = array(
                        'startDate' => $date,
                        'headline' => 'Wystąpienie w Sejmie',
                        'text' => '<p>Poseł wziął udział w debacie Sejmowej</p>',
                        'tag' => 'Wystąpienie w Sejmie',
                        'classname' => 'klasa',
                        'asset' => array(
                            'media' => 'http://mojepanstwo/dane/poslowie/123',
                            'thumbnail' => 'optional-32x32px.jpg',
                            'credit' => 'Credit Name Goes Here',
                            'caption' => 'Caption text goes here',
                        ),
                    );

                    break;

                }

                case 'sejm_interpelacje':
                {

                    $output['timeline']['date'][] = array(
                        'startDate' => $date,
                        'headline' => $object->getData('tytul'),
                        'text' => '<p>Poseł złożył interpelację</p>',
                        'tag' => 'Interpelacja',
                        'classname' => 'klasa',
                        'asset' => array(
                            'media' => 'http://mojepanstwo/dane/poslowie/123',
                            'thumbnail' => 'optional-32x32px.jpg',
                            'credit' => 'Credit Name Goes Here',
                            'caption' => 'Caption text goes here',
                        ),
                    );

                    break;

                }

            }

        }


        $this->set('data', $output);
        $this->set('_serialize', 'data');

    }

}