<?php

App::uses('SessionComponent', 'Controller/Component');

class MySessionComponent extends SessionComponent
{
    public function setFlash($message, $element = 'default', $params = array(), $key = 'flash')
    {
        if ($flashes = CakeSession::read('Message.' . $key)) {
            array_push($flashes, compact('message', 'element', 'params'));
            CakeSession::write('Message.' . $key, $flashes);
        } else {
            $flashes = array();
            array_push($flashes, compact('message', 'element', 'params'));
            CakeSession::write('Message.' . $key, $flashes);
        }

    }
}