<?php

class AdministracjaController extends AppController
{
    public $components = array(
        'Session',
        'RequestHandler'
    );

    public function index()
    {

        $data = $this->API->Administracja()->getData();
        $this->set('data', $data);

    }

    public function search()
    {
        if (isset($this->request->params['ext']) && ($this->request->params['ext'] == 'json')) {

            $search = array();

            $q = @$this->request->query['q'];
            if ($q)
                $search = $this->API->KRS()->search($q);

            $search = @$search['search'];
            $html = '';

            if (!empty($search)) {
                $view = new View($this, false);
                foreach ($search as $result) {
                    $html .= $view->element('item', array(
                        'result' => $result,
                    ));
                }
            }

            $this->set('html', $html);
            $this->set('_serialize', 'html');

        } else $this->redirect('/krs');
    }

} 