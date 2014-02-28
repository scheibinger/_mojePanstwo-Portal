<?php 
class SitemapsController extends AppController{ 

    var $name = 'Sitemaps'; 
    var $uses = array('Post', 'Info'); 
    var $helpers = array('Time'); 
    var $components = array('RequestHandler'); 

    function index (){     
        
        $objects = array();
        $this->set('objects', $objects);
        
        $this->set('_serialize', array('objects'));
        
		Configure::write ('debug', 0); 
    
    } 
} 
