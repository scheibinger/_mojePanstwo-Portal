<?php

class PrawoController extends AppController
{
    public $components = array(
        'Session',
        'RequestHandler'
    );
    public $helpers = array('Dane.Dataobject');

    public function index()
    {


        $_dane = $this->API->Dane();
        $_prawo = $this->API->Prawo();

		$tags = $_prawo->getExposedTags();
		$this->set('tags', $tags);
        


    }

    public function search()
    {
        if (isset($this->request->params['ext']) && ($this->request->params['ext'] == 'json')) {

            $api = $this->API->Dane();
            $search = array();

            $q = @$this->request->query['q'];


            $api->searchDataset('prawo', array(
                'conditions' => array(
                    'q' => $q,
                    'status_id' => '1',
                ),
                'facet' => array('haslo_id'),
                'limit' => 10,
            ));
            
            $objects = $api->getObjects();      		                    

            $this->set('search', array(
            	'objects' => $api->getObjects(),
            	'facets' => $api->getFacets(), 
            ));
            $this->set('_serialize', array('search'));

        }
    }

} 