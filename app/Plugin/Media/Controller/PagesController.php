<?php

class PagesController extends MediaAppController
{
    public $components = array(
        'Session',
        'RequestHandler'
    );

    public function home()
    {

		
		$ranges = array('24h', '3d', '7d', '1m', '1y');
		$range = ( isset($this->request->query['range']) && in_array($this->request->query['range'], $ranges) ) ? 
			$this->request->query['range'] : 
			$ranges[0];
		
		
		
		
		
        $toc = array(
            array(
                'name' => 'media',
                'title' => 'Urzędy w mediach',
            ),
            array(
                'name' => 'twitter',
                'title' => 'Polityka na Twitterze',
                'subchapters' => array(
                    array(
                        'name' => 'obserwowani',
                        'title' => 'Najbardziej obserwowani',
                    ),
                    array(
                        'name' => 'najaktywniejsi',
                        'title' => 'Najaktywniesji',
                    ),
                    array(
                        'name' => 'retweetowani',
                        'title' => 'Najczęściej retweetowani',
                    ),
                    array(
                        'name' => 'retweetowane_tresci',
                        'title' => 'Najczęściej retweetowane treści',
                    ),
                    array(
                        'name' => 'hashtagi',
                        'title' => 'Najpopularniejsze hashtagi',
                    ),
                    array(
                        'name' => 'www',
                        'title' => 'Najczęściej udostępniane adresy WWW',
                    ),
                    array(
                        'name' => 'wzmiankowani',
                        'title' => 'Najczęściej wzmiankowani',
                    ),
                    array(
                        'name' => 'wywolujacy_dyskusje',
                        'title' => 'Najczęściej wywołujący dyskusje',
                    ),
                    array(
                        'name' => 'dyskutowane_tweety',
                        'title' => 'Najbardziej dyskutowane tweety',
                    ),
                    array(
                        'name' => 'aplikacje',
                        'title' => 'Najczęściej używane aplikacje',
                    ),
                    array(
                        'name' => 'wpadki',
                        'title' => 'Wpadki',
                    ),
                ),
            ),
            array(
                'name' => 'prawo',
                'title' => 'Prawo',
            ),
            array(
                'name' => 'kontrowersje',
                'title' => 'Kontrowersje',
            ),
            array(
                'name' => 'wnioski',
                'title' => 'Wnioski',
            ),
            array(
                'name' => 'ofundacji',
                'title' => 'O Fundacji',
            ),
            array(
                'name' => 'twitter_na_swiecie',
                'title' => 'Twitter na świecie',
            ),
        );


        $toc[0]['active'] = true;


        $this->set('toc', $toc);


        $font = array(
            'min' => 10,
            'max' => 100,
        );
        $font['diff'] = $font['max'] - $font['min'];

        
        $stats = $this->API->getTwitterStats( $range );

        $tags = $stats['tags'];
        $_stats = array(
            'min' => (int)$tags[count($tags) - 1]['count'],
            'max' => (int)$tags[1]['count'],
        );
        $_stats['diff'] = $_stats['max'] - $_stats['min'];

        foreach ($tags as &$tag) {
            $score = $_stats['diff']
                ? ($tag['count'] - $_stats['min']) / $_stats['diff']
                : 0;

            $score = min($score, 1);

            $tag = array_merge($tag, array(
                'score' => $score,
                'size' => $font['min'] + $score * $font['diff'],
            ));
        }
		
		shuffle($tags);
        $stats['tags'] = $tags;

        $this->set('stats', $stats);


        $accounts_types = $this->API->getTwitterAccountsTypes();
        $accounts_types_ids = array_column($accounts_types, 'id');
        $accounts_types_nazwy = array_column($accounts_types, 'nazwa', 'id');
        $accounts_types_klasy = array_column($accounts_types, 'class', 'id');

        $ranks = array(
            
            
            
            array(
                'title' => 'Najczęściej retweetowane treści',
                'name' => 'retweetowane_tresci',
                'groups' => array(
                    array(
                        'mode' => 'tweet',
                        'field' => 'liczba_retweetow',
                        'order' => 'liczba_retweetow desc',
                        'link' => array(
                            'dataset' => 'twitter',
                        ),
                    ),
                ),
            ),
			
            
            array(
                'title' => 'Najbardziej dyskutowane tweety',
                'name' => 'dyskutowane_tweety',
                'groups' => array(
                    array(
                        'mode' => 'tweet',
                        'field' => 'liczba_odpowiedzi',
                        'order' => 'liczba_odpowiedzi desc',
                        'link' => array(
                            'dataset' => 'twitter',
                        ),
                    ),
                ),
            ),
            
            array(
                'title' => 'Najpopularniejsze hashtagi',
                'name' => 'hashtagi',
                'groups' => array(
                    array(
                        'desc' => 'Najczęściej używane hashtagi.',
                        'mode' => 'tags',
                    ),
                    array(
                        'mode' => 'tag',
                    ),
                ),
            ),
            
            array(
                'title' => 'Najczęściej używane aplikacje',
                'name' => 'aplikacje',
                'groups' => array(
                    array(
                        'mode' => 'source',
                    ),
                ),
            ),
            
            
            array(
                'title' => 'Największy przyrost oberwujących',
                'name' => 'obserwujacy',
                'groups' => array(
                    array(
                        'mode' => 'account',
                        'preset' => 'followers',
                        'desc' => '',
                        'link' => array(
                            'dataset' => 'twitter_accounts',
                        ),
                    ),
                ),
            ),
            
            /*
            array(
                'title' => 'Najmniejszy przyrost oberwujących',
                'name' => 'nieobserwujacy',
                'groups' => array(
                    array(
                        'mode' => 'account',
                        'preset' => 'defollowers',
                        'desc' => '',
                        'link' => array(
                            'dataset' => 'twitter_accounts',
                        ),
                    ),
                ),
            ),
            */
            
            


            array(
                'title' => 'Najczęściej udostępniane adresy WWW',
                'name' => 'www',
                'groups' => array(
                    array(
                        'mode' => 'url',
                    ),
                ),
            ),
			
			
			array(
                'title' => 'Najaktywniejsi',
                'name' => 'najaktywniejsi',
                'groups' => array(
                    array(
                        'mode' => 'stats',
                        'preset' => 'accounts-activity',
                        'field' => 'liczba_tweetow_wlasnych_2013',
                        'order' => 'liczba_tweetow_wlasnych_2013 desc',
                        'desc' => 'Liczba nowych, własnych tweetów. Pod uwagę nie są brane retweety.',
                        'link' => array(
                            'dataset' => 'twitter_accounts',
                        ),
                    ),
                ),
            ),
			
			
			array(
                'title' => 'Najczęściej retweetowani',
                'name' => 'retweetowani',
                'groups' => array(
                    array(
                    	'mode' => 'stats',
                        'preset' => 'accounts-retweet',
                        'field' => 'liczba_retweetow_wlasnych_2013',
                        'order' => 'liczba_retweetow_wlasnych_2013 desc',
                        'desc' => 'Liczba retweetów tweetów z danego konta.',
                        'link' => array(
                            'dataset' => 'twitter_accounts',
                        ),
                    ),
                ),
            ),
			

            array(
                'title' => 'Najczęściej wywołujący dyskusje',
                'name' => 'wywolujacy_dyskusje',
                'groups' => array(
                    array(
                    	'mode' => 'stats',
                        'preset' => 'accounts-discussions',
                        'field' => 'liczba_odpowiedzi_rts_2013',
                        'order' => 'liczba_odpowiedzi_rts_2013 desc',
                        'desc' => 'Liczba komentarzy do tweetów z danego konta. Powiększona o liczbę retweetów tych komentarzy.',
                        'link' => array(
                            'dataset' => 'twitter_accounts',
                        ),
                    ),
                ),
            ),
            
            array(
                'title' => 'Najczęściej wzmiankowani',
                'name' => 'wzmiankowani',
                'groups' => array(
                    array(
                        'mode' => 'stats',
                        'preset' => 'accounts-mentions',
                        'field' => 'liczba_wzmianek_rts_2013',
                        'order' => 'liczba_wzmianek_rts_2013 desc',
                        'desc' => 'Liczba tweetów wzmiankujących dane konto. Powiększona o retweety.',
                        'link' => array(
                            'dataset' => 'twitter_accounts',
                        ),
                    ),
                ),
            ),
            
        );


        foreach ($ranks as &$rank) {

            foreach ($rank['groups'] as &$group) {
				
				if ($group['mode'] == 'account') {
					
					
					if( @$group['preset'] ) {
					
					
						$types = $this->API->getTwitterAccountsGroupByTypes($range, $accounts_types_ids, $group['preset']);
						
	                    foreach ($types as &$type)
	                        $type = array_merge($type, array(
	                            'title' => $accounts_types_nazwy[$type['id']],
	                            'class' => $accounts_types_klasy[$type['id']],
	                        ));
	
	                    $group = array_merge($group, array(
	                        'types' => $types,
	                    ));
						
						
	                } else {
	                
	                
	                    $types = $this->API->getTwitterAccountsGroupByTypes($range, $accounts_types_ids, $group['field']);
	                    foreach ($types as &$type)
	                        $type = array_merge($type, array(
	                            'title' => $accounts_types_nazwy[$type['id']],
	                            'class' => $accounts_types_klasy[$type['id']],
	                        ));
	
	                    $group = array_merge($group, array(
	                        'types' => $types,
	                    ));
                    
                    
                    }
                    

                } elseif ($group['mode'] == 'tweet') {

                    $types = $this->API->getTwitterTweetsGroupByTypes($range, $accounts_types_ids, $group['field']);
										
                    foreach ($types as &$type)
                        $type = array_merge($type, array(
                            'title' => $accounts_types_nazwy[$type['id']],
                            'class' => $accounts_types_klasy[$type['id']],
                        ));

                    $group = array_merge($group, array(
                        'types' => $types,
                    ));

                } elseif ($group['mode'] == 'tag') {

                    $group['types'] = @$stats['tags_by_groups'];

                } elseif ($group['mode'] == 'url') {

                    $group['types'] = @$stats['urls_by_groups'];

                } elseif ($group['mode'] == 'source') {

                    $group['types'] = @$stats['sources_by_groups'];

                }  elseif ($group['mode'] == 'stats') {
					
					$types = @$stats[ $group['preset'] . '_by_groups' ];
					
					foreach ($types as &$type)
                        $type = array_merge($type, array(
                            'title' => $accounts_types_nazwy[$type['id']],
                            'class' => $accounts_types_klasy[$type['id']],
                        ));
					
					$group = array_merge($group, array(
                        'types' => $types,
                    ));
					
                }

            }

        }
		

        // var_export( $ranks ); die();
        $this->set('range', $range);
        $this->set('ranks', $ranks);
        $this->set('title_for_layout', 'Państwo w Mediach Społecznościowych');

    }

} 