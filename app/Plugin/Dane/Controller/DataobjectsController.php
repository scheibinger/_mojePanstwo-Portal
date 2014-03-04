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

    public function related()
    {
        $this->view = 'view';
        $this->set('showRelated', true);
        return $this->view();
    }

    public function _prepareView()
    {
        $this->dataset = $this->API->getDataset($this->params->controller);
        $this->set('dataset', $this->dataset);

        $this->object = $this->API->getObject($this->params->controller, $this->params->id);

        if (is_object($this->object)) {


            $this->object->loadRelated();
            if ($this->object->hasRelated())
                foreach ($this->menu as $item) {
                    if ($item['id'] == 'related') {
                        break;
                    }
                    $this->menu[] = array(
                        'id' => 'related',
                        'label' => 'Powiązania',
                    );
                }
			
			
            $this->set('object', $this->object);
            $this->set('objectOptions', $this->objectOptions);

            $this->prepareMenu();

            foreach ($this->menu as &$item) {
                if ($item['id'] == $this->params->action) {
                    $item['selected'] = true;
                    break;
                }
            }

            $this->addStatusbarCrumb(array(
                'href' => '/dane/kanal/' . $this->dataset['Datachannel']['slug'],
                'text' => $this->dataset['Datachannel']['nazwa'],
            ));

            $this->addStatusbarCrumb(array(
                'href' => '/dane/' . $this->object->getDataset(),
                'text' => $this->dataset['Dataset']['name'],
            ));

            $title_for_layout = $this->object->getTitle();

            $this->set('menu', $this->menu);
            $this->set('menuMode', $this->menuMode);
            $this->set('title_for_layout', $title_for_layout);
            

            if ($this->Session->read('Auth.User.id'))
                $this->API->Powiadomienia()->flagObject($this->object->id);


        } else {

            throw new NotFoundException('Could not find that object');

        }
    }
	
	public function beforeRender()
	{
		
		parent::beforeRender();
		
		$this->set('_dataset', $this->object->getDataset());
        $this->set('_object_id', $this->object->getId());
        $this->set('_data', $this->object->getData());
        $this->set('_layers', $this->object->layers);
        $this->set('_serialize', array('_dataset', '_object_id', '_data', '_layers'));
	}
	
    protected function innerSearch($dataset, $initalConditions = array(), $options = array())
    {
        $alias = $dataset;
        $this->menuMode = 'none';
        $conditions = (isset($this->request->query)) ? $this->request->query : $this->data;
        $conditions = array_merge($conditions, $initalConditions);
        if (isset($initalConditions['fields'])) {
            $fields = $initalConditions['fields'];
            unset($initalConditions['fields']);
        } else {
            $fields = null;
        }
        $sortings = array();
        $dataset = array();
        $filters = array();
        if (!is_null($alias)) {
            if (!is_array($alias)) {
                // ŁADOWANIE INFORMACJI O DATASET'CIE
                $data = $this->API->getDataset($alias);
                $dataset = $data['Dataset'];
                $conditions['dataset'] = $dataset['alias'];
                // ŁADOWANIE SORTOWAŃ
                $sortings = $this->API->getDatasetSortings($dataset['alias']);

                // ŁADOWANIE FILTRÓW
                $filters = $this->API->getDatasetFilters($dataset['alias'], array('exclude' => $this->params->controller));

            } else {
                $conditions['dataset'] = $alias;
            }

            // ŁADOWANIE OBIEKTÓW
            $this->loadModel('Dane.Dataobject');

            $queryData = array(
                'conditions' => $conditions,
                'paramType' => 'querystring',
                'facets' => true,
            );
            if (!is_null($fields)) {
                $queryData['fields'] = $fields;
            }
            $this->paginate = $queryData;
            $dataobjects = $this->Paginator->paginate('Dataobject');
            $pagination = $this->Dataobject->pagination;
            $facets = $this->Dataobject->facets;
            $total = $this->Dataobject->total;
            if (isset($this->request->query)) {
                $this->data = array('Dataset' => $this->request->query);
            }

            $searchTitle = isset($options['searchTitle']) ? $options['searchTitle'] : false;

            $this->set(compact('dataobjects', 'pagination', 'sortings', 'filters', 'total', 'facets', 'dataset', 'conditions', 'searchTitle'));
            $this->view = 'Dataobjects/innerSearch';
        }
        $this->set('menuMode', $this->menuMode);
    }

    protected function externalRedir($name = null, $id = null)
    {
        if (is_null($name)) {
            $name = $this->name;
        }
        if (is_null($id)) {
            $id = $this->params->id;
        }
        $this->redirect('http://sejmometr.pl/' . Inflector::underscore($name) . '/' . $id, '302');
    }

    protected function prepareMenu()
    {
    }

}