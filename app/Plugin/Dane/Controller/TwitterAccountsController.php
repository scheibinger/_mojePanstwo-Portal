<?php

App::uses('DataobjectsController', 'Dane.Controller');

class TwitterAccountsController extends DataobjectsController
{

    public $components = array(
        'RequestHandler',
    );
    public $uses = array('Dane.Dataobject');

    public $menu = array();

	public $objectOptions = array(
        'hlFields' => array(),
    );
	
    public function view()
    {


        parent::_prepareView();
        $this->object->loadLayer('followers_chart');
        
        $this->API->searchDataset('twitter', array(
            'limit' => 12,
            'conditions' => array(
                'twitter_account_id' => $this->object->getId(),
            ),
        ));
        $this->set('twitts', $this->API->getObjects());
        
        /*
        $this->dataobjectsBrowserView(array(
            'source' => 'twitterAccounts.relatedTweets:' . $this->object->getId(),
            'dataset' => 'twitter',
            'title' => 'Powiązane tweety',
        ));
        */

    }

    public function timeline()
    {

        $data = '{
    "timeline":
    {
        "headline":"Sh*t People Say",
        "type":"default",
		"text":"People say stuff",
		"startDate":"2012,1,26",
        "date": [
            {
                "startDate":"2012,1,26",
				"endDate":"2012,1,27",
                "headline":"Sh*t Politicians Say",
                "text":"<p>In true political fashion, his character rattles off common jargon heard from people running for office.</p>",
                "asset":
                {
                    "media":"http://youtu.be/u4XpeU9erbg",
                    "credit":"",
                    "caption":""
                }
            },
            {
                "startDate":"2012,1,10",
                "headline":"Sh*t Nobody Says",
                "text":"<p>Have you ever heard someone say “can I burn a copy of your Nickelback CD?” or “my Bazooka gum still has flavor!” Nobody says that.</p>",
                "asset":
                {
                    "media":"http://youtu.be/f-x8t0JOnVw",
                    "credit":"",
                    "caption":""
                }
            }
        ]
    }
}';

        $data = json_decode($data, true);

        $this->set('data', $data);
        $this->set('_serialize', 'data');

    }


    public function getpagetitle()
    {
        if ($this->data) {
            if (isset($this->data['url']) && preg_match('/http/', $this->data['url'])) {
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_HEADER, 0);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                curl_setopt($ch, CURLOPT_URL, $this->data['url']);
                curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
                $page = curl_exec($ch);
                curl_close($ch);

                preg_match('/<title>(.+)<\/title>/', $page, $matches);
                if (count($matches) > 0) {
                    $title = $matches[1];
                    $this->set(array(
                        'title' => $title,
                        '_serialize' => 'title',
                    ));
                } else {
                    throw new NotFoundException();
                    die();
                }
            } else {
                throw new MethodNotAllowedException();
                die();
            }

        } else {
            throw new MethodNotAllowedException();
            die();
        }
    }
} 