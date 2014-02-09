<?

class mpapiComponent extends Component
{
    public $components = array('Session');

    public function initialize(Controller $controller)
    {

        if ($controller->Auth->loggedIn()) {
            $controller->API = $this->getAPI(array(
            	'user_id' => $controller->Auth->user('id'), 
            	'stream_id' => $controller->Session->read('Stream.id'),
            ));
        } else {
            $controller->API = $this->getAPI();
        }
        $params = array(
            'applications' => true,
        );

        $portalHeaderTemplate = Cache::read('portalHeader', 'short');
        if (!$portalHeaderTemplate)
            $params['portalHeader'] = true;

        $data = $controller->API->Paszport()->info($params);

        if ($data['user']) {
            // to powodowało ciągłe regenerowanie sesji, co w efekcie nie jest najlepszym rozwiazaniem
//            $controller->Auth->login($data['user']);
            $controller->Session->write('Auth.User', $data['user']);
            $controller->set('_USER', $data['user']);
        } else {


        }
        if ($data['applications']) {

            $applications = array();
            $folders = array();

            foreach ($data['applications'] as $dapplication) {
                // if (@$dapplication['Application']['folder_id']) {
                //     $folders[$dapplication['Application']['folder_id']][] = $dapplication['Application'];
                // } else {
                //     unset($dapplication['Folder']);
                $applications[] = $dapplication;
                // }
            }

            if (!empty($applications)) {
                foreach ($applications as &$app) {
                    if (
                        ($app['Application']['type'] == 'folder') &&
                        array_key_exists($app['Application']['id'], $folders)
                    ) {
                        $app['Content'] = $folders[$app['Application']['id']];
                    }
                }
            }

            $controller->Applications = $applications;
            $controller->set('_APPLICATIONS', $applications);

        }

        if ($data['portalHeaderTemplate']) {
            $portalHeaderTemplate = $data['portalHeaderTemplate'];
            Cache::write('portalHeader', $portalHeaderTemplate, 'short');
        }

        if ($controller->Auth->loggedIn()) {
            foreach ($this->Session->read('Auth.User') as $field => $value) {
                if (!is_array($value)) {
                    $portalHeaderTemplate = preg_replace('/\{\%' . $field . '\%\}/', $value, $portalHeaderTemplate);
                }
            }
        }

        $controller->set('_PORTAL_HEADER', $portalHeaderTemplate);

    }

    public function getAPI( $options = array() )
    {
    	
    	if( !isset($options['user_id']) )
    		$options['user_id'] = 0;
    	
    	if( !isset($options['stream_id']) )
    		$options['stream_id'] = 1;
    		    	
        require_once(MPAPI_path . 'loader.php');
        return new MP\API($options);

    }

}