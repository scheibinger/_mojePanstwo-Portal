<?

class DataobjectsBrowserComponent extends Component
{

    public $source = array();
    public $title = false;
    public $noResultsTitle = false;
    public $href = false;
    public $mode = false;
    public $tag = false;
    public $datasetLocked = false;
    public $showTitle = false;
    public $titleTag = 'h2';
    public $hlFields = false;
    public $routes = array();

    public $excludeFilters = array();

    public $components = array(
        'Paginator',
    );

    public $helpers = array(
        'Number',
        'Dane.Filter',
    );

    public function __construct($collection, $settings = array())
    {

        parent::__construct($collection, $settings);

        if (isset($settings['title'])) {
            $this->showTitle = true;
            $this->title = $settings['title'];
        }

        if (isset($settings['href']) && $settings['href'])
            $this->href = $settings['href'];

        if (isset($settings['titleTag']) && $settings['titleTag'])
            $this->titleTag = $settings['titleTag'];

        if (isset($settings['noResultsTitle']) && $settings['noResultsTitle'])
            $this->noResultsTitle = $settings['noResultsTitle'];

        if (isset($settings['excludeFilters']))
            $this->excludeFilters = $settings['excludeFilters'];
            
        if (isset($settings['hlFields']))
            $this->hlFields = $settings['hlFields'];
            
        if (isset($settings['routes']))
            $this->routes = $settings['routes'];
            		
        $add_source_params = array();
        $source_params = array();
        $source_parts = explode(' ', $settings['source']);
        foreach ($source_parts as $part) {

            $p = strpos($part, ':');
            if ($p !== false) {
                $key = substr($part, 0, $p);
                $value = substr($part, $p + 1);

                $source_params[$key] = $value;

                if (($key != 'dataset') && ($key != 'datachannel'))
                    $add_source_params[$key] = $value;
            }


        }

        $this->source = $add_source_params;


        if (isset($settings['dataset']))
            $source_params['dataset'] = $settings['dataset'];


        if (isset($source_params['dataset']) && !empty($source_params['dataset'])) {
            $this->mode = 'dataset';
            $this->tag = $source_params['dataset'];
            $this->datasetLocked = true;
        } elseif (isset($source_params['datachannel']) && !empty($source_params['datachannel'])) {
            $this->mode = 'datachannel';
            $this->tag = $source_params['datachannel'];
        }

    }

    public function beforeRender(Controller $controller)
    {

        $q = '';
        $conditions = array();
        $order = array();
        $order_selected = false;
        $useDefaults = true;

        $filters = array();
        $switchers = array();
        $orders = array();


        if (
            isset($controller->request->query['dataset']) &&
            !empty($controller->request->query['dataset'])
        ) {

            $dataset = is_array($controller->request->query['dataset']) ?
                $controller->request->query['dataset'][0] :
                $controller->request->query['dataset'];

            if ($dataset) {

                if ($this->mode == 'datachannel') {

                    $url = '/dane/' . $dataset;
                    if (isset($controller->request->query['q']) && $controller->request->query['q'])
                        $url .= '?q=' . urlencode($controller->request->query['q']);

                    $controller->redirect($url);
                    exit();
                }


                $this->mode = 'dataset';
                $this->tag = $dataset;

            }
        }


        if (!$this->href) {
            $here = $controller->here;

            if ($p = strpos($here, '.'))
                $here = substr($here, 0, $p);

            /*
            $strlen = strlen($here);
            if( $here[ $strlen-1 ]=='/' )
                $here = substr($here, 0, $strlen-1);
            */

            $this->href = $here;
        }

        if (!empty($this->source)) {

            $source_parts = array();
            foreach ($this->source as $key => $value)
                $source_parts[] = $key . ':' . $value;

            $conditions['_source'] = implode(' ', $source_parts);

        }

        $query_keys = array_keys($controller->request->query);
        foreach ($query_keys as $key) {

            $value = $controller->request->query[$key];
            switch ($key) {

                case 'order':
                {
                    $order_parts = explode(' ', $value);
                    $order = array(
                        'field' => $order_parts[0],
                        'direction' => isset($order_parts[1]) ? $order_parts[1] : 'desc',
                    );
                    $order['str'] = $order['field'] . ' ' . $order['direction'];
                    break;
                }

                case 'q':
                {
                    $q = $value;
                    if ($value)
                        $orders[] = array(
                            'sorting' => array(
                                'field' => 'score',
                                'label' => 'Trafność',
                                'direction' => 'desc',
                            ),
                        );
                    break;
                }

                case 'search':
                {

                    $useDefaults = false;
                    break;

                }

                default:
                    {

                    $key = str_replace(':', '.', $key);

                    if (in_array($key, $this->excludeFilters))
                        continue;

                    if (array_key_exists($key, $conditions)
                        && ($conditions[$key] != $value)
                    ) {
                        $conditions[$key][] = $value;
                    } else {
                        $conditions[$key] = $value;
                    }


                    }

            }
        }


        foreach ($conditions as $key => &$cond)
            if (preg_match('/data_/', $key) && $cond)
                $cond = preg_replace('/\:/', '\:', CakeTime::toAtom($cond));


        if ($this->mode == 'dataset') {

            $conditions['dataset'] = $this->tag;

            $dataset = $controller->API->getDataset($this->tag);
            if( !$this->title )
	            $this->title = $dataset['Dataset']['name'];

            // ŁADOWANIE SORTOWAŃ

            $orders = array_merge($orders, $controller->API->getDatasetSortings($this->tag));


            if (empty($orders) || ((count($orders) === 1) && ($orders[0]['sorting']['field'] == 'score')))
                $orders[] = array(
                    'sorting' => array(
                        'field' => 'date',
                        'label' => 'Data',
                        'direction' => 'desc',
                    ),
                );

            if (isset($order['field'])) {
                foreach ($orders as &$_order) {
                    if ($_order['sorting']['field'] == $order['field']) {
                        $_order['selected_direction'] = $order['direction'];
                        $order_selected = true;
                        break;
                    }
                }
            }


            // ŁADOWANIE PRZEŁĄCZNIKÓW
            $switchers = $controller->API->getDatasetSwitchers($this->tag);
            if ($useDefaults && !empty($switchers)) {
                foreach ($switchers as $switcher) {

                    $switcher = $switcher['switcher'];
                    if ($switcher['dataset_search_default'] == '1')
                        $conditions['!' . $switcher['name']] = '1';

                }
            }


            // ŁADOWANIE FILTRÓW
            $filters = $controller->API->getDatasetFilters($this->tag, true);

            if (!empty($filters)) {

                $_filters = array();
                foreach ($filters as $filter)
                    if (!in_array($filter['filter']['field'], $this->excludeFilters))
                        $_filters[] = $filter;

                $filters = $_filters;

            }


        } elseif ($this->mode == 'datachannel') {


            $datachannel = $controller->API->getDatachannel($this->tag);
            $this->title = $datachannel['Datachannel']['name'];

            $data = $controller->API->getDatachannel($this->tag);
            $datachannel = $data['Datachannel'];
            $conditions['datachannel'] = $datachannel['slug'];

            $title_for_layout = $datachannel['name'];


            $filters[] = array(
                'filter' => array(
                    'field' => 'dataset',
                    'typ_id' => '2',
                    'parent_field' => false,
                    'label' => 'Zbiory danych:',
                    'desc' => false,
                    'multi' => '0',
                ),
            );

            $orders[] = array(
                'sorting' => array(
                    'field' => 'date',
                    'label' => 'Data',
                    'direction' => 'desc',
                ),
            );


        } else {

            if (isset($controller->request->query['dataset']) &&
                !empty($controller->request->query['dataset'])
            ) {

                $dataset = is_array($controller->request->query['dataset']) ?
                    $controller->request->query['dataset'][0] :
                    $controller->request->query['dataset'];


                if ($dataset) {

                    /*
                    $query = $controller->request->query;
                    unset($query['dataset']);
                    unset($query['datachannel']);
                    unset($query['search']);

                    return $controller->redirect('/dane/' . $dataset . '?' . http_build_query($query));
                    */

                }
            }

            $filters[] = array(
                'filter' => array(
                    'field' => 'dataset',
                    'typ_id' => '2',
                    'parent_field' => false,
                    'label' => 'Zbiory danych:',
                    'desc' => false,
                    'multi' => '0',
                ),
            );

            $orders[] = array(
                'sorting' => array(
                    'field' => 'date',
                    'label' => 'Data',
                    'direction' => 'desc',
                ),
            );

        }


        // ŁADOWANIE OBIEKTÓW
        // $controller->Dataobject = ClassRegistry::init('Dane.Dataobject');		
        $controller->loadModel('Dane.Dataobject');


        $queryData = array(
            'q' => $q,
            'conditions' => $conditions,
            'paramType' => 'querystring',
            'facets' => true,
        );


        if (empty($order) && !empty($orders))
            $order = array(
                'field' => $orders[0]['sorting']['field'],
                'direction' => $orders[0]['sorting']['direction'],
                'str' => $orders[0]['sorting']['field'] . ' ' . $orders[0]['sorting']['direction'],
            );


        if (!$order_selected && !empty($order))
            foreach ($orders as &$o)
                if ($o['sorting']['field'] == $order['field'])
                    $o['selected_direction'] = $order['direction'];


        if (!empty($order))
            $queryData['order'] = $order['str'];


        $this->Paginator->settings = $queryData;
        $objects = $this->Paginator->paginate('Dataobject');


        $pagination = $controller->Dataobject->pagination;
        $facets = $controller->Dataobject->facets;


        $total = $controller->Dataobject->total;

        if (isset($controller->request->query))
            $controller->data = array('Dataset' => $controller->request->query);


        $page = array(
            'title' => $this->title,
            'href' => $this->href,
            'mode' => $this->mode,
            'tag' => $this->tag,
            'datasetLocked' => $this->datasetLocked,
            'showTitle' => $this->showTitle,
            'titleTag' => $this->titleTag,
            'noResultsTitle' => $this->noResultsTitle,
        );
        $controller->set(compact('objects', 'pagination', 'orders', 'filters', 'total', 'facets', 'page', 'title_for_layout', 'conditions', 'switchers', 'q'));

        $controller->set('dataBrowser', $this);


        $path = App::path('View', 'Dane');
        $path = $path[0] . $controller->viewPath . '/' . $controller->view . '.ctp';

        if (file_exists($path))
            $controller->set('originalViewPath', $path);


        if (strtolower($controller->request->ext) == 'json')
            $controller->view = $this->getJSONPath();
        else
            $controller->view = $this->getViewPath();

    }


    public function getViewPath()
    {

        $path = App::path('View', 'Dane');
        return $path[0] . '/Component/dataobjectsBrowser/view.ctp';

    }

    public function getJSONPath()
    {

        $path = App::path('View', 'Dane');
        return $path[0] . '/Component/dataobjectsBrowser/json.ctp';

    }

}