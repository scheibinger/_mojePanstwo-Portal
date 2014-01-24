<?php
App::uses('DataobjectsController', 'Dane.Controller');
App::uses('Set', 'Utility');

class TwitterController extends DataobjectsController
{

    public $components = array(
        'RequestHandler',
    );

    public $helpers = array(
        'Time',
    );
    public $menu = array();

    public function view()
    {

        parent::_prepareView();
        $this->dataobjectsBrowserView(array(
            'source' => 'twitter.responsesTo:' . $this->object->getId(),
            'dataset' => 'twitter',
            'title' => 'Odpowiedzi',
            'noResultsTitle' => 'Brak odpowiedzi na tego tweeta',
            'excludeFilters' => array(
                'twitter_account_id',
                'twitter_accounts.typ_id',
            ),
        ));

    }

} 