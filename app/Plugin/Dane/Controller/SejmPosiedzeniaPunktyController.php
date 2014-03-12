<?php

App::uses('DataobjectsController', 'Dane.Controller');

class SejmPosiedzeniaPunktyController extends DataobjectsController
{
    public $uses = array('Dane.Dataobject');
    public $helpers = array('Dane.Dataobject');
    public $menu = array();

    public function view()
    {

        parent::view();
        $debaty = array();

        if (
            ($related = $this->object->getLayer('related')) &&
            (isset($related['groups'])) &&
            (!empty($related['groups']))
        ) {
            foreach ($related['groups'] as $group) {
                if ($group['id'] == 'debaty')
                    $debaty = $group['objects'];
            }
        }

        $this->set('debaty', $debaty);

    }


} 