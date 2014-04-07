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
	
	public function add()
	{
		
		$status = false;
		
		if( isset($this->request->data['add']) )
		{
			
			$status = $this->API->addGroup( $this->request->data['add'] );
			
		}
		
		$this->set('status', $status);
		$this->set('_serialize', 'status');
		
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