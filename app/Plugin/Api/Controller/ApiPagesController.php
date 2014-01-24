<?php

class ApiPagesController extends AppController
{
    public function dane($alias = null)
    {
        $api = mpapicomponent::getApi();
        if (!is_null($alias)) {

            $fields = $api->Dane()->fields($alias);
            $fields = $fields['fields'];
            $layers = $api->Dane()->layers($alias);
            $layers = $layers['layers'];

            $this->view = 'dane_dataset';
            $this->set(compact('layers', 'fields', 'alias'));
        } else {
            $datasets = $api->Dane()->index();
            $this->set('datasets', $datasets['datasets']);
        }

    }

    public function view($part)
    {
        $this->view = $part;
    }
} 