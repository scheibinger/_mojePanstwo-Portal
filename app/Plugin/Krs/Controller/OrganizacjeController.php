<?php

class OrganizacjeController extends AppController
{
    public $components = array(
        'Session',
        'RequestHandler'
    );

    public function index()
    {
        $org = @$this->params->query['org'];
        $osb = @$this->params->query['osb'];
        $this->set('org', $org);
        $this->set('osb', $osb);
        $results = false;

        if ($org) {
            $conditions = array(
                'org' => $org,
                'dataset' => 'krs_podmioty',
            );

            $searcher = $this->API->Dane();
            $searcher->searchDataset('krs_podmioty', array(
                'conditions' => $conditions,
                'limit' => 5,
            ));

            $organization = $searcher->getObjects();
            if (!empty($organization))
                $results = true;

            $this->set('organization', $organization);

        }elseif($osb){
            $conditions = array(
                'osb' => $osb,
                'dataset' => 'krs_podmioty',
            );

            $searcher = $this->API->Dane();
            $searcher->searchDataset('krs_podmioty', array(
                'conditions' => $conditions,
                'limit' => 5,
            ));

            $osoba = $searcher->getObjects();
            if (!empty($osoba))
                $results = true;

            $this->set('osoba', $osoba);
        }

        $this->set('results', $results);

        $application = $this->getApplication();
        $this->set('title_for_layout', $application['Application']['name']);

    }

} 