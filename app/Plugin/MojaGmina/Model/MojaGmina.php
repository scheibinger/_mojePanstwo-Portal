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
                'sq' => $q,
            ),
            'limit' => $limit,
        ));
        return $api->getObjects();

    }

}
