<?

class mpapiComponent extends Component
{
    public $components = array('Session');

    public function initialize(Controller $controller)
    {

        if ($controller->Auth->loggedIn()) {
            $controller->API = $this->getAPI(array(
                'user_id' => $controller->Auth->user('id'),
            ));
        } else {
            $controller->API = $this->getAPI();
        }

        $data = $controller->API->Paszport()->info(array(
            'applications' => true,
        ));


        // PROCESSING USER

        if ($data['user']) {
            $this->User = $data['user'];
            $controller->Session->write('Auth.User', $this->User);
            $controller->set('_USER', $this->User);
        }


        // PROCESSING APPLICATIONS 

        $applications = array();
        if ($data['applications']) {

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

        }

        $controller->Applications = $applications;
        $controller->set('_APPLICATIONS', $applications);

        $controller->set('_APPLICATION', $controller->getApplication());


        // PROCESSING STREAMS

        $streams = array();
        if (isset($data['streams']) && !empty($data['streams'])) {


            foreach ($data['streams'] as $id => $name) {
                $selected = ($this->Session->read('Stream.id') == $id);
                $streams[] = array(
                    'id' => $id,
                    'name' => $name,
                    'selected' => $selected,
                );

                if ($selected)
                    $this->stream_id = $id;

            }

        }

        if ($this->Session->read('Stream.id') != $this->stream_id )
            $this->Session->write('Stream.id', $this->stream_id);

        $controller->API->setOptions(array(
            'stream_id' => $this->stream_id,
        ));

        $this->Streams = $streams;
        $controller->set('_STREAMS', $streams);

    }

    public function getAPI($options = array())
    {
        $options = array_merge(array(
            'user_id' => SessionComponent::read('Auth.User.id'),
            'stream_id' => SessionComponent::read('Stream.id'),
        ), $options);

        require_once(MPAPI_path . 'loader.php');
        return new MP\API($options);

    }

}