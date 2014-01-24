<?
App::uses('SolrAppModel', 'Model');

class Dataobject extends SolrAppModel
{

    public function find($type = 'first', $queryData = array())
    {
        $this->API = mpapiComponent::getApi(CakeSession::read('Auth.User.id'))->Powiadomienia();
        if (isset($queryData['page']) && isset($queryData['limit'])) {
            $queryData['offset'] = ($queryData['page'] - 1) * $queryData['limit'];
            unset($queryData['page']);
        }
        $results = $this->API->search($queryData);
        $results = $this->afterFind($results);
        return $results;

    }

    public function afterFind($results, $primary = false)
    {

        if (isset($results['pagination'])) {
            $this->pagination = $results['pagination'];
            $this->total = (isset($results['pagination']['total'])) ? $results['pagination']['total'] : 0;
            unset($results['pagination']);

        }

        $this->facets = array();
        if (isset($results['facets'])) {
            $this->facets = $results['facets'];
            unset($results['facets']);
        }
        return $results['objects'];
    }

}