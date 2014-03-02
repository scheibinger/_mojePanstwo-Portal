<?php 
class SitemapsController extends AppController{ 

    var $name = 'Sitemaps'; 
    var $uses = array('Post', 'Info'); 
    var $helpers = array('Time'); 
    var $components = array('RequestHandler'); 

    function index (){     
        
        $sitemapindex = array(
        	'xmlns:' => 'http://www.sitemaps.org/schemas/sitemap/0.9',
        	'sitemap' => array(
        		array(
        			'loc' => 'http://' . PORTAL_DOMAIN . '/sitemap1.xml.gz',
					'lastmod' => atomTime('2014-03-01 09:00:00'),
				),
	        	array(
	        		'loc' => 'http://' . PORTAL_DOMAIN . '/sitemap1.xml.gz',
					'lastmod' => atomTime('2014-03-01 09:00:00'),
	        	),
        	),
        );
		        
        
        $this->set('sitemapindex', $sitemapindex);
        $this->set('_serialize', array('sitemapindex'));
		Configure::write ('debug', 0); 
    
    } 
}