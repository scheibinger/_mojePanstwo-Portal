<?php

App::uses('DataobjectsController', 'Dane.Controller');

class CrawlerPagesController extends DataobjectsController
{

    public $components = array(
        'RequestHandler',
    );
    public $uses = array('Dane.CrawlerPage');
	
	public $objectOptions = array(
		'hlFields' => array('crawler_sites.nazwa', 'liczba_rozmiar', 'content_type', 'url'),
		'buttons' => array('shoutIt', 'careIt'),
	);
	
    public $menu = array(
    	array(
    		'id' => 'view',
    		'label' => 'Image',
    	),
    	array(
    		'id' => 'online',
    		'label' => 'Online',
    	),
    );

    public function view()
    {
        parent::_prepareView();        
    }
    
    public function online()
    {
        parent::_prepareView();        
    }
    
    public function careIt()
    {
	    parent::_prepareView();
	    $post_url = $this->CrawlerPage->careIt(array(
	    	'url' => $this->object->getData('url'),
	    	'title' => $this->object->getTitle(),
	    ));
	    
	    $this->Session->setFlash('<p>Utworzyłem nowy post na platformie Care\'o\'meter.</p><p><a target="_blank" href="' . $post_url . '">Edytuj i opublikuj go!</a></p>', 'default', array(
	    	'class' => 'careIt',
	    ));
	    $this->redirect($this->referer());
    }
    
} 