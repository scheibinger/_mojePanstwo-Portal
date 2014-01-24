<?php

class DatachannelsController extends DaneAppController
{

    public function index()
    {
        $channels = $this->API->getDatachannels();
        $searchParams = array(
            'limit' => 12,
            'conditions' => array(),
            'facets' => true,
        );

        $q = (string)@$this->request->query['q'];

        if ($q) {

            $searchParams['q'] = $q;

            foreach ($channels as &$ch) {

                $this->API->searchDatachannel($ch['Datachannel']['slug'], $searchParams);
                $ch['dataobjects'] = $this->API->getObjects();
                $datachannel_count = 0;

                $facets = $this->API->getFacets();
                if (!empty($facets)) {
                    $facets = array_column($facets, 'params', 'field');
                    if (array_key_exists('dataset', $facets) &&
                        isset($facets['dataset']['options']) &&
                        !empty($facets['dataset']['options'])
                    ) {

                        $datasets = array_column($facets['dataset']['options'], 'count', 'id');

                        foreach ($ch['Dataset'] as &$d) {

                            if (array_key_exists($d['alias'], $datasets)) {
                                $d['count'] = $datasets[$d['alias']];
                                $datachannel_count += $d['count'];
                            } else {
                                $d['count'] = 0;
                            }

                        }

                    }
                }

                $ch['Datachannel']['score'] = 0;
                $ch['Datachannel']['count'] = $datachannel_count;


                if (!empty($ch['dataobjects']))
                    $ch['Datachannel']['score'] = $ch['dataobjects'][0]->getScore();

                /*
                $ch['Datachannel']['score'] = 0;
                if( !empty($ch['dataobjects']) )
                {
                    $i = 0;
                    foreach( $ch['dataobjects'] as $object )
                    {
                        $ch['Datachannel']['score'] += $object->getScore();
                        $i++;
                    }
                    if( $i )
                        $ch['Datachannel']['score'] = $ch['Datachannel']['score'] / $i;
                }
                */
            }

            uasort($channels, array($this, 'channelsCompareMethod'));
            // var_export( $channels ); die();

        } else {

            foreach ($channels as &$ch) {
                $res = $this->API->searchDatachannel($ch['Datachannel']['slug'], $searchParams);
                $ch['dataobjects'] = $this->API->getObjects();
            }

        }


        $this->set('q', $q);
        $this->set('channels', $channels);
        $this->set('title_for_layout', 'Dane publiczne');

    }

    private function channelsCompareMethod($a, $b)
    {
        if ($a['Datachannel']['score'] == $b['Datachannel']['score']) {
            return 0;
        }
        return ($a['Datachannel']['score'] > $b['Datachannel']['score']) ? -1 : 1;
    }

    public function view($name = null)
    {

        $alias = (string)@$this->request->params['alias'];
        $data = $this->API->getDatachannel($alias);
        $datachannel = $data['Datachannel'];


        $datasets = $data['Dataset'];

        if (count($datasets) === 1) {

            $dataset = $datasets[0];
            $url = '/dane/' . $dataset['base_alias'];
            if (!empty($this->request->query))
                $url .= '?' . http_build_query($this->request->query);

            $this->redirect($url);
            exit();

        }


        $title_for_layout = $datachannel['name'];
        $this->set('title_for_layout', $title_for_layout);


        $this->dataobjectsBrowserView(array(
            'source' => 'datachannel:' . $alias,
            'showTitle' => true,
            'titleTag' => 'h1',
        ));

    }

}
