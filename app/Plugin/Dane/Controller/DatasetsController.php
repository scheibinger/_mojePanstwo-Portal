<?php
App::uses('CakeTime', 'Utility');

class DatasetsController extends DaneAppController
{

    public $components = array(
        'RequestHandler',
    );

    public function view()
    {

        $alias = (string)@$this->request->params['alias'];
        $data = $this->API->getDataset($alias);
        $dataset = $data['Dataset'];
        $datachannel = $data['Datachannel'];


        $this->addStatusbarCrumb(array(
            'text' => $datachannel['nazwa'],
            'href' => '/dane/kanal/' . $datachannel['slug'],
        ));


        $title_for_layout = $dataset['name'];
        $this->set('title_for_layout', $title_for_layout);


        $this->dataobjectsBrowserView(array(
            'source' => 'dataset:' . $alias,
            'showTitle' => true,
            'titleTag' => 'h1',
        ));

    }

}