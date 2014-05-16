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
        $apis = array(
          array(
            'name' => 'Szukaj',
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam viverra sapien sit amet lacus sagittis euismod. Vestibulum ac nisl ultricies, venenatis nibh at, luctus ligula. Curabitur facilisis sem arcu, tempus auctor risus pharetra in.',
            'slug' => 'szukaj',
          ),
            array(
                'name' => 'Kody Pocztowe',
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam viverra sapien sit amet lacus sagittis euismod. Vestibulum ac nisl ultricies, venenatis nibh at, luctus ligula. Curabitur facilisis sem arcu, tempus auctor risus pharetra in.',
                'slug' => 'kody_pocztowe',
            ),
            array(
                'name' => 'Ustawy',
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam viverra sapien sit amet lacus sagittis euismod. Vestibulum ac nisl ultricies, venenatis nibh at, luctus ligula. Curabitur facilisis sem arcu, tempus auctor risus pharetra in.',
                'slug' => 'ustawy',
            ),
        );

        $this->set(compact('apis'));
    }

    public function view($slug) {
        // Api->findBySlug($slug);

        $api = array(
            'name' => 'Szukaj',
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam viverra sapien sit amet lacus sagittis euismod. Vestibulum ac nisl ultricies, venenatis nibh at, luctus ligula. Curabitur facilisis sem arcu, tempus auctor risus pharetra in.',
            'slug' => 'szukaj',
        );

        $this->set(compact('api'));
    }
}