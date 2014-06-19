<?php

class SejmometrController extends SejmometrAppController
{
	
	public $helpers = array('Dane.DataobjectsSlider', 'Dane.Dataobject', 'Dane.Filter');
	public $components = array('RequestHandler');

    private function klub_img_src($klub_id) {
        // TODO use MP\Dane\Sejm_kluby::getThumbnailSrc
        return "http://resources.sejmometr.pl/s_kluby/" . $klub_id . "_a_t.png";
    }

    public function index()
    {
		$api = $this->API->Sejmometr();
		$stats = $api->getStats();

        $display_callbacks = array(
            'liczba_wypowiedzi' => function($object){
                        return pl_dopelniacz($object->getData('liczba_wypowiedzi'), 'wystąpienie', 'wystąpienia', 'wystąpień');
                    },
            'frekwencja' =>  function($object){
                        return $object->getData('frekwencja') . '%';
                    },
            'zbuntowanie' => function($object){
                        return $object->getData('zbuntowanie') . '%';
                    },
            'liczba_interpelacji' =>  function($object){
                        return pl_dopelniacz($object->getData('liczba_interpelacji'), 'interpelacja', 'interpelacje', 'interpelacji');
                    },
        );

        // ranking poslow
        $dane = $this->API->Dane();
        foreach($stats['poslowie'] as $section_name => $sekcja) {
            $data[$section_name] = array(
                'items' => array(),
                'order' => $sekcja['order']
            );

            foreach ($sekcja['dataobjects'] as $object_plain) {
                $object = $dane->interpretateObject($object_plain);

                $data[$section_name]['items'][] = array(
                    'imie' => $object->getData('imie_pierwsze'),
                    'nazwisko' => $object->getData('nazwisko'),
                    'url' => $object->getUrl(),
                    'klub_img_src' => $this->klub_img_src($object->getData('klub_id')),
                    'posel_img_src' => $object->getThumbnailUrl(),
                    'klub' => $object->getData('sejm_kluby.nazwa'),
                    'display' => $display_callbacks[$section_name]($object),
                );
            }
        }

        // rankingi agregowane
        $data['zawody'] = $stats['zawody'];
        //$data['poslanki_poslowie'] = $stats['poslanki_poslowie'];
        $data['poslanki_poslowie'] = array(
            array('title' => 'Sejm RP', 'img_src' => 'http://resources.sejmometr.pl/s_kluby/2_a_t.png', 'setup' => array(array('Mężczyźni', 65), array('Kobiety', 35))),
            array('title' => 'Platforma Obywatelska', 'img_src' => 'http://resources.sejmometr.pl/s_kluby/2_a_t.png', 'setup' => array(array('Mężczyźni', 65), array('Kobiety', 35))),
            array('title' => 'Prawo i Sprawiedliwość', 'img_src' => 'http://resources.sejmometr.pl/s_kluby/2_a_t.png', 'setup' => array(array('Mężczyźni', 65), array('Kobiety', 35))),
            array('title' => 'Twój Ruch', 'img_src' => 'http://resources.sejmometr.pl/s_kluby/2_a_t.png', 'setup' => array(array('Mężczyźni', 65), array('Kobiety', 35))),
            array('title' => 'Polskie Stronnictwo Ludowe', 'img_src' => 'http://resources.sejmometr.pl/s_kluby/2_a_t.png', 'setup' => array(array('Mężczyźni', 65), array('Kobiety', 35)))
        );
        
        // TODO
        $data['poslanki_poslowie'] = array(
            array('title' => 'Sejm RP', 'img_src' => 'http://resources.sejmometr.pl/s_kluby/2_a_t.png', 'setup' => array(array('Mężczyźni', 65), array('Kobiety', 35))),
            array('title' => 'Platforma Obywatelska', 'img_src' => 'http://resources.sejmometr.pl/s_kluby/2_a_t.png', 'setup' => array(array('Mężczyźni', 65), array('Kobiety', 35))),
            array('title' => 'Prawo i Sprawiedliwość', 'img_src' => 'http://resources.sejmometr.pl/s_kluby/2_a_t.png', 'setup' => array(array('Mężczyźni', 65), array('Kobiety', 35))),
            array('title' => 'Twój Ruch', 'img_src' => 'http://resources.sejmometr.pl/s_kluby/2_a_t.png', 'setup' => array(array('Mężczyźni', 65), array('Kobiety', 35))),
            array('title' => 'Polskie Stronnictwo Ludowe', 'img_src' => 'http://resources.sejmometr.pl/s_kluby/2_a_t.png', 'setup' => array(array('Mężczyźni', 65), array('Kobiety', 35)))
        );

        $poslowie_url = Router::url(array('plugin' => 'dane', 'controller' => 'poslowie'));
		$this->set('poslowie_url', $poslowie_url);

        $this->set($data);
    }
    
    public function detailBlock() {
	    
	    $id = $this->request->query['id'];
	    if( !$id )
	    	return false;
	    
	    $view = new View($this, false);
		
		$element = 'list_inner';
		if( $id=='zawody' )
			$element = 'zawody';
		
		$items = $this->poslowie($id);
		
        $html = $view->element('Sejmometr.' . $element, array(
            'items' => $items,
        ));
	    
	    $this->set('id', $id);
	    $this->set('html', $html);
	    $this->set('_serialize', array('html', 'id'));
	    
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
	            'headline' => '<a href="/dane/sejm_posiedzenia/' . $object->getData('id') . '">#' . $object->getData('numer') . '</a>',
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

    public function info()
    {
        $this->set(compact('info'));
    }
    
    public function posiedzenia(){
	    
	    
	    
    }
}