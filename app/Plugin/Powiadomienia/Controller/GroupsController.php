<?php
App::uses('Sanitize', 'Utility');

class GroupsController extends PowiadomieniaAppController
{
    public $uses = array();
    public $components = array(
        'Session', 'RequestHandler',
    );

    public function index()
    {
        $groups = $this->API->getGroups();
        $this->set(compact('groups'));
        if (isset($this->params->query['addGroup'])) {
            $this->params->query['addGroup'] = Sanitize::stripAll($this->params->query['addgroup']);
            $this->API->addGroup(array('q' => $this->params->query['addgroup']));
            $this->Session->setFlash(sprintf(__d('powiadomienia', 'LC_POWIADOMIENIA_FRAZA_ZOSTALA_DODANA'), $this->params->query['addGroup']));
            $this->redirect(array('controller' => 'powiadomienia', 'action' => 'index'));
        }
    }
	
	public function view()
	{
		
		$group = $this->API->getGroup( $this->request->params['id'] );		
		
		$this->set('group', $group);
		$this->set('_serialize', array('group'));
		
	}
	
	public function add()
	{
		
		$data = $this->request->data;
		$data = '{
		    "group": {
		        "PowiadomieniaGroup": {
		            "title": "Narkotyki w Sejmie"
		        },
		        "phrases": [
		            "marihuana",
		            "kokaina",
		            "heroina",
		            "LSD",
		            "alkohol"
		        ],
		        "apps": [
		            {
		                "id": 14		                
		            }
		        ]
		    }
		}';
			
		$status = $this->API->addGroup( $data );
		
		$this->set('status', $status);
		$this->set('_serialize', 'status');
		
	}
	
	public function edit($id)
	{
		$data = $this->request->data;
		$data = '{
		    "group": {
		        "PowiadomieniaGroup": {
		            "id": "4",
		            "title": "COE Verbatim Records",
		            "slug": "coe-verbatim-records",
		            "user_id": "2578",
		            "alerts_unread_count": "7"
		        },
		        "phrases": [
		            "\"Catherine Ashton\"",
		            "\"depravation of liberty\"",
		            "\"Eastern Partnership\"",
		            "\"equal treatment\"",
		            "\"fair trial\"",
		            "\"freedom of religion\"",
		            "\"freedom of speech\"",
		            "\"rights of internally displaced people\"",
		            "\"\u0160tefan F\u00fcle\"",
		            "Azerbaijan",
		            "Barroso",
		            "discrimination",
		            "Kazakhstan",
		            "LGBT",
		            "protests",
		            "Tadeusz Iwi\u0144ski",
		            "torture"
		        ],
		        "apps": [
		            {
		                "id": 14,
		                "name": "HFHR",
		                "datasets": [
		                    {
		                        "id": "141",
		                        "name": "Posiedzenia Rady Europy"
		                    }
		                ]
		            }
		        ]
		    }
		}';
		$data = json_decode( $data );
		
		debug( $data );
		
	}
	
    public function remove($id = null)
    {
        if (!is_null($id)) {
            $this->API->removeGroup($id);
            // $this->Session->setFlash(__d('powiadomienia', 'LC_POWIADOMIENIA_FRAZA_ZOSTALA_USUNIETA', true));
            $this->redirect(array('controller' => 'powiadomienia', 'action' => 'index'));
        } else {
            throw new BadRequestException(__d('powiadomienia', 'LC_POWIADOMIENIA_BRAK_ID_DO_USUNIECIA', true));
        }
    }
} 