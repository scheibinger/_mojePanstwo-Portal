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
            if ($q) {
                $api->searchDataset('ustawy', array(
                    'conditions' => array(
                        'q' => $q,
                        'status_id' => '1',
                    ),
                    'limit' => 10,
                ));
                $objects = $api->getObjects();

                foreach ($objects as $obj)
                    $search[] = array_merge($obj->getData(), array(
                        'data_slowna' => dataSlownie($obj->getData('data_publikacji')),
                        'hl' => $obj->getHlText(),
                    ));
            }

            $this->set('search', $search);
            $this->set('_serialize', array('search'));

        } else $this->redirect('/ustawy');
    }

} 