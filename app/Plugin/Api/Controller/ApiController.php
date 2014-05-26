<?php


class ApiController extends AppController
{
    public $helpers = array(
    );

    public $components = array(
    );

    public $uses = array(
    );

    public function beforeFilter() {
        parent::beforeFilter();
    }

    public function index() {
        $apis = $this->API->request('/');

        $this->set(compact('apis'));
    }

    public function view($slug) {
        $apis = $this->API->request('/');
        $api = null;
        foreach($apis as $_api) {
            if ($_api['slug'] == $slug) {
                $api = $_api;
                break;
            }
        }

        if ($api == null) {
            throw new NotFoundException();
        }

        $this->set(compact('api'));
    }
}