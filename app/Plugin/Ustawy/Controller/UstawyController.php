<?php

class UstawyController extends AppController
{
    public $components = array(
        'Session',
        'RequestHandler'
    );

    public function index()
    {


        $q = @$this->params->query['q'];
        $this->set('q', $q);
        $results = false;

        if ($q) {

            $conditions = array(
                'q' => $q,
                'dataset' => 'ustawy',
                'status_id' => '1',
            );

            $searcher = $this->API->Dane();
            $searcher->searchDataset('ustawy', array(
                'conditions' => $conditions,
                'limit' => 5,
            ));

            $objects = $searcher->getObjects();
            if (!empty($objects))
                $results = true;

            $this->set('objects', $objects);
            $this->set('pagination', $searcher->getPagination());

        }

        $this->set('results', $results);

        $application = $this->getApplication();
        $this->set('title_for_layout', $application['Application']['name']);

    }

} 