<?php

class FinanseController extends AppController
{
	
	public $components = array('RequestHandler');
  
    public function index()
    {
		
        $spendings = $this->API->Finanse()->getBudgetSpendings();
        $this->set('spendings', $spendings);


        // $application = $this->getApplication();
        $this->set('title_for_layout', 'Finanse publiczne');
    }
    
    
    
    public function dzialy()
    {
		
        $data = $this->API->Finanse()->getBudgetData();
        $this->set('data', $data);


        // $application = $this->getApplication();
        $this->set('title_for_layout', 'Wydatki gmin w Polsce');
    }
    
    public function getBudgetData()
    {
	    
	    $data = $this->API->Finanse()->getBudgetData($this->request->query);
	    $this->set('data', $data);
	    $this->set('_serialize', 'data');
	    
    }

} 