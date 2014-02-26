<?
App::uses('ExceptionRenderer', 'Error');

class AppExceptionRenderer extends ExceptionRenderer {

    public function render()
    {
    	
	    if( 
	    	( $this->error->getCode()==404 ) && 
	    	( $this->controller->request->params['plugin'] != 'Dane' ) && 
	    	( $alias = $this->controller->request->params['controller'] ) && 
	    	( $api = mpapiComponent::getApi()->Dane() ) && 
	    	( $dataset = $api->getDataset($alias) )
	    )
	    {
		    		    
		    $url = '/dane/' . $this->controller->request->url;
		    $this->controller->redirect( $url );
		    
	    }
	    else parent::render();
    }
    
}