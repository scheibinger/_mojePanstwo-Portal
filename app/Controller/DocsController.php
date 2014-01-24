<?php

class DocsController extends AppController
{

    public $components = array('RequestHandler');

    public function view()
    {

        $doc = new MP\Document($this->request->params['id']);
        $this->set('doc', $doc->getData());
        $this->set('_serialize', 'doc');

    }

    public function viewPackage()
    {

        $doc_id = $this->request->params['doc_id'];
        $package_id = $this->request->params['package_id'];

        $doc = new MP\Document($doc_id);
        $html = $doc->loadHTML($package_id);

        $ext = strtolower($this->request->params['ext']);

        if ($ext == 'html') {

            echo $html;
            die();

        } elseif ($ext == 'json') {

            $this->set('doc', $doc->getData());
            $this->set('html', $html);
            $this->set('_serialize', array('doc', 'html'));

        }

    }

}