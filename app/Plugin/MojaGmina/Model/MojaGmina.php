<?php

class MojaGmina extends AppModel
{

    public $useDbConfig = 'dummy';
    public $useTable = false;

    public function search($q, $limit = 1)
    {

        if (!$q)
            return false;

        $api = mpapiComponent::getApi()->Dane();
        $api->searchDataset('gminy', array(
            'conditions' => array(
                'q' => $q,
            ),
            'mode' => 'title_prefix',
            'limit' => $limit,
        ));
        return $api->getObjects();

    }

}
