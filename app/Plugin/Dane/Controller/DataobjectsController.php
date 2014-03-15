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
        $this->_prepareView();
        
        if( !$this->autoRelated )
        	$this->object->loadRelated();
        
        $this->set('showRelated', true);
        $this->view = '/Dataobjects/related';
    }

    public function _prepareView()
    {
        $this->dataset = $this->API->getDataset($this->params->controller);
        $this->set('dataset', $this->dataset);

        $this->object = $this->API->getObject($this->params->controller, $this->params->id);

        if (is_object($this->object)) {

			
			if( $this->autoRelated )
			{
            
	            $this->object->loadRelated();
	
	            if ($this->object->hasRelated())
	                foreach ($this->menu as $item) {
	                    if ($item['id'] == 'related') {
	                        break;
	                    }
	                    $this->menu[] = array(
	                        'id' => 'related',
	                        'label' => 'Powiązania',
	                        'icon' => 'related',
	                    );
	                }
			
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
		
		if( is_object( $this->object ) && !$this->request->is('ajax') && !$this->mode )
		{
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