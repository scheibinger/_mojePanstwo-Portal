<?php

class DataobjectsController extends DaneAppController
{

    public $helpers = array('Paginator');
    public $components = array('Paginator', 'RequestHandler');
    public $object = false;
    public $objectOptions = array(
        'hlFields' => false,
    );
    public $dataset = false;
    public $menu = array(
        array(
            'id' => 'view',
            'label' => 'LC_DANE_START',
        ),
    );
    public $menuMode = 'horizontal';
    public $autoRelated = true;
    public $mode = false;

    public $breadcrumbsMode = 'datachannel';

    public $initLayers = array();

    public function index()
    {
        $conditions = $this->request->query;
        $queryData = array(
            'conditions' => $conditions,
            'paramType' => 'querystring',
        );
        $this->paginate = $queryData;
        $this->set('objects', $this->Paginator->paginate());
        $pagination = $this->Dataobject->pagination;
        $this->set('pagination', $pagination);
    }


    public function view()
    {
        $this->_prepareView();
    }

    public function addInitLayers($layers)
    {

        if (is_array($layers))
            $this->initLayers = array_merge($this->initLayers, $layers);
        else
            $this->initLayers[] = $layers;

    }

    public function related()
    {
        $this->_prepareView();

        if (!$this->autoRelated)
            $this->object->loadRelated();

        $this->set('showRelated', true);
        $this->view = '/Dataobjects/related';
    }

    public function _prepareView()
    {

        try {

            $this->object = $this->API->getObject($this->params->controller, $this->params->id, array(
                'layers' => $this->initLayers,
                'dataset' => true,
                'flag' => (boolean)$this->Session->read('Auth.User.id'),
                'alerts_queries' => true,
            ));

        } catch (Exception $e) {

            $data = $e->getData();
            if ($data && isset($data['redirect']) && $data['redirect']) {

                $this->redirect('/dane/' . $data['redirect']['alias'] . '/' . $data['redirect']['object_id']);

            }
            throw new NotFoundException('Could not find that object');

        }

        if (is_object($this->object)) {

            $this->dataset = $this->object->getLayer('dataset');

            $this->set('object', $this->object);
            $this->set('objectOptions', $this->objectOptions);

            if ($this->breadcrumbsMode == 'datachannel') {

                $this->addStatusbarCrumb(array(
                    'href' => '/dane/kanal/' . $this->dataset['Datachannel']['slug'],
                    'text' => $this->dataset['Datachannel']['nazwa'],
                ));

            } elseif (($this->breadcrumbsMode == 'app') && isset($this->dataset['App'])) {

                $this->set('_APPLICATION', array(
                    'Application' => $this->dataset['App'],
                ));

            }

            $this->addStatusbarCrumb(array(
                'href' => '/dane/' . $this->object->getDataset(),
                'text' => $this->dataset['Dataset']['name'],
            ));

            $title_for_layout = $this->object->getTitle();

            $this->set('menu', $this->menu);
            $this->set('menuMode', $this->menuMode);
            $this->set('title_for_layout', $title_for_layout);

        } else {

            throw new NotFoundException('Could not find that object');

        }
    }

    public function beforeRender()
    {

        parent::beforeRender();

        if (is_object($this->object) && !$this->request->is('ajax') && !$this->mode) {
            $this->set('_dataset', $this->object->getDataset());
            $this->set('_object_id', $this->object->getId());
            $this->set('_data', $this->object->getData());
            $this->set('_layers', $this->object->layers);
            $this->set('_serialize', array('_dataset', '_object_id', '_data', '_layers'));
        }
    }

    protected function prepareMenu()
    {
    }

}