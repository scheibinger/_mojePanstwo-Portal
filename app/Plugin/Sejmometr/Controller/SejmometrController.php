<?php

class SejmometrController extends SejmometrAppController
{
	
	public $helpers = array('Dane.DataobjectsSlider', 'Dane.Dataobject', 'Dane.Filter');
	public $components = array('RequestHandler');

    private function klub_img_src($klub_id) {
        // TODO use MP\Dane\Sejm_kluby::getThumbnailSrc
        return "http://resources.sejmometr.pl/s_kluby/" . $klub_id . "_a_t.png";
    }

    private function poslowie($sort = 'nazwa_odwrocona asc', $limit = 10, $metrics = NULL) {
        $this->loadModel('Dane.Dataobject');

        $objects = $this->Dataobject->find('all', array(
            'conditions' => array('dataset' => 'poslowie'),
            'order' => $sort,
            'limit' => $limit,
            'maxLimit' => $limit,
            //'facets' => true
            //'paramType' => 'querystring',
        ));

        $r = array();
        foreach($objects as $object) {
            $o = $object['Dataobject']->data;
            $entry = array(
                'imie' => $o['imie_pierwsze'],
                'nazwisko' => $o['nazwisko'],
                'url' => $object['Dataobject']->getUrl(),
                'klub_img_src' => $this->klub_img_src($o['klub_id']),
                'posel_img_src' => $object['Dataobject']->getThumbnailUrl(),
                'klub' => $o['sejm_kluby.nazwa'],
            );

            if (!empty($metrics)) {
                $entry['number'] = $o[$metrics];
            }

            array_push($r, $entry);
        }

        return $r;
    }
	
    public function index()
    {
		$API = $this->API->Dane();

        $poslowie_url = Router::url(array('plugin' => 'dane', 'controller' => 'poslowie'));

		// LISTA POSLOW 4x7
        $poslowie = $this->poslowie('nazwa_odwrocona asc', 12);

        // WYSTAPIENIA
        $wystapienia = $this->poslowie('liczba_wypowiedzi desc', 10, 'liczba_wypowiedzi');

        // FREKWENCJA
        $frekwencja = $this->poslowie('frekwencja desc', 10, 'frekwencja');

        // BUNTY
        $bunty = $this->poslowie('liczba_glosowan_zbuntowanych desc', 10, 'liczba_glosowan_zbuntowanych');

        // INTERPELACJE
        $interpelacje = $this->poslowie();

        // ETYKA
        $etyka = $this->poslowie();

        // PRZELOTY
        $przeloty = $this->poslowie();

        // PRZEJAZDY
        $przejazdy = $this->poslowie();

        // KWATERY PRYWATNE
        $kwatery = $this->poslowie();

        // WNIOSKI O UCHYLENIE IMMUNITETU
        $immunitet = $this->poslowie();

        // ZAROBKI
        $zarobki = $this->poslowie();

        // ZAWODY
        $zawody =  array(
            array('percent' => 65, 'job' => 'Prawnicy', 'more_link' => '#'),
            array('percent' => 15, 'job' => 'Nauczyciele', 'more_link' => '#'),
            array('percent' => 15, 'job' => 'Przedsiębiorcy', 'more_link' => '#'),
            array('percent' => 15, 'job' => 'Przedsiębiorcy', 'more_link' => '#'),
            array('percent' => 15, 'job' => 'Inne', 'more_link' => '#')
        );

        // POSLANKI POSLOWIE
        $genderyzm = array(
            array('title' => 'Sejm RP', 'img_src' => 'http://resources.sejmometr.pl/s_kluby/2_a_t.png', 'setup' => array(array('Mężczyźni', 65), array('Kobiety', 35))),
            array('title' => 'Platforma Obywatelska', 'img_src' => 'http://resources.sejmometr.pl/s_kluby/2_a_t.png', 'setup' => array(array('Mężczyźni', 65), array('Kobiety', 35))),
            array('title' => 'Prawo i Sprawiedliwość', 'img_src' => 'http://resources.sejmometr.pl/s_kluby/2_a_t.png', 'setup' => array(array('Mężczyźni', 65), array('Kobiety', 35))),
            array('title' => 'Twój Ruch', 'img_src' => 'http://resources.sejmometr.pl/s_kluby/2_a_t.png', 'setup' => array(array('Mężczyźni', 65), array('Kobiety', 35))),
            array('title' => 'Polskie Stronnictwo Ludowe', 'img_src' => 'http://resources.sejmometr.pl/s_kluby/2_a_t.png', 'setup' => array(array('Mężczyźni', 65), array('Kobiety', 35)))
        );

		
		// OSTATNIE POSIEDZENIE
		$posiedzenie = $API->searchDataset('sejm_posiedzenia', array(
			'order' => 'data_stop desc',
			'limit' => 1,
		));
		
		$posiedzenie = $API->getObjects();
		$posiedzenie = $posiedzenie[0];
		$related = $posiedzenie->loadRelated();
				
		$this->set(compact('posiedzenie', 'poslowie', 'wystapienia', 'frekwencja', 'bunty', 'interpelacje', 'etyka',
            'przeloty', 'przejazdy', 'kwatery', 'immunitet', 'zarobki', 'zawody', 'genderyzm', 'poslowie_url'));
		

    }
    
    public function posiedzenia_timeline()
    {
	    
	    $output = array(
            'timeline' => array(
                'headline' => 'Posiedzenia Sejmu RP',
                'type' => 'default',
                'date' => array(),
            ),
        );
        
        
	    $API = $this->API->Dane();
		$API->searchDataset('sejm_posiedzenia', array(
			'order' => 'data_stop desc',
			'limit' => 100,
		));
		
		foreach( $API->getObjects() as $object )
		{
	    		    	
	    	$startDate = $object->getData('data_start');
            $dateParts = explode('-', $startDate);
            $startDate = $dateParts[0] . ',' . $dateParts[1] . ',' . $dateParts[2];
            
            $stopDate = $object->getData('data_stop');
            $dateParts = explode('-', $stopDate);
            $stopDate = $dateParts[0] . ',' . $dateParts[1] . ',' . $dateParts[2];

            if (!$object->getData('komunikat_id')) {
                $asset = array( /*IMAGE DONT EXIST - DEFAULT IMG*/
                    'media' => '/Sejmometr/img/default.jpg',
                    'thumbnail' => '/Sejmometr/img/default-thumbnail.jpg',
                    'credit' => '',
                );
            } else {
                $asset = array( /*PATH TO EXIST IMAGES*/
                    'media' => 'http://resources.sejmometr.pl/sejm_komunikaty/img/' . $object->getData('komunikat_id') . '-0.jpg',
                    'thumbnail' => 'http://resources.sejmometr.pl/sejm_komunikaty/img/' . $object->getData('komunikat_id') . '-1.jpg',
                    'credit' => '® Kancelaria Sejmu',
                );
            }

            $output['timeline']['date'][] = array(
	            'startDate' => $startDate,
	            'endDate' => $stopDate,
	            'headline' => '#' . $object->getData('numer'),
	            'text' => '<p>Statystyki posiedzenia</p>',
	            'classname' => 'klasa',
                'asset' => $asset,
            );
        
        }
        
        $this->set('data', $output);
        $this->set('_serialize', 'data');
	    
    }
    
    public function szukaj()
    {
	    
	    $this->API = $this->API->Dane();
	    $this->dataBrowser = $this->Components->load('Dane.DataobjectsBrowser', array(
            'source' => 'app:3',
            'title' => 'Szukaj w pracach Sejmu',
            'noResultsTitle' => 'Brak wyników',
        ));
	    	    
    }
    
    public function autorzy_projektow()
    {
	    
	    $this->API = $this->API->Sejmometr();
	    $data = $this->API->autorzy_projektow();
	    
	    $this->set('data', $data);
	    $this->set('_serialize', 'data');
	    
    }

    public function zawody_poslow() {
        $zawody = array_fill(0, 20, array(
            'name' => 'Prawnicy',
            'percent' => 10,
            'number' => 1,
        ));

        $total = 0;
        foreach($zawody as $z) {
            $total += $z['number'];
        }

        $chart_max_percent = 3;
        $chart_max_items = 18;
        $ppl_in_graph = 0;
        $zawody_chart = array();
        for($i =0; $i < $chart_max_items; $i++) {
            if ($zawody[$i]['percent'] < $chart_max_percent) {
                break;
            }

            array_push($zawody_chart, $zawody[$i]);
            $ppl_in_graph += $z['number'];
        }
        array_push($zawody_chart, array(
            'name' => 'Inne',
            'percent' => ($total - $ppl_in_graph) * 1000 / $total * 0.1,
            'number' => $total - $ppl_in_graph
        ));

        $this->set(compact('zawody_chart', 'zawody'));
    }
}