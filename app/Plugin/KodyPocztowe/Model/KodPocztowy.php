<?php

App::uses('SolrAppModel', 'Model');

class KodPocztowy extends SolrAppModel
{

    public $validate = array(
        'postcode' => array(
            'rule' => '/[0-9]{2}\-[0-9]{3}/'
        ),
    );


} 