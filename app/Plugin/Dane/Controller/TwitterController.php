<?php
App::uses('DataobjectsController', 'Dane.Controller');
App::uses('Set', 'Utility');

class TwitterController extends DataobjectsController
{

    public $breadcrumbsMode = 'app';

    public $components = array(
        'RequestHandler',
    );

    public $helpers = array(
        'Time',
    );
    public $menu = array();

    public $objectOptions = array(
        'hlFields' => array(),
    );

    public function view()
    {

        parent::_prepareView();
        $this->object->loadLayer('source');
        $this->object->loadLayer('responses');


        /*
        $this->dataobjectsBrowserView(array(
            'source' => 'twitter.responsesTo:' . $this->object->getId(),
            'dataset' => 'twitter',
            'title' => 'Odpowiedzi',
            'noResultsTitle' => 'Brak odpowiedzi na tego tweeta',
        ));
        */

    }

} 