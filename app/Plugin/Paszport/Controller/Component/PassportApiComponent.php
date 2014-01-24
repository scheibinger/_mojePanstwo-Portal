<?php

App::uses('HttpSocket', 'Network/Http');

class PassportApiComponent extends Component
{
    protected $socket;
    protected $response;

    public function request($endpoint, $action, $data = array())
    {
        $this->socket = new HttpSocket();
        $this->response = $this->socket->post("mpapi.localhost/$endpoint/$action.json", $data);
        CakeLog::debug(print_r($this->socket->request, true));
        CakeLog::debug(print_r($this->response, true));
        if ($this->response->isOk() && $this->response->body()) {
            return json_decode($this->response->body(), true);
        } else {
            return false;
        }

    }
} 