<?php

class FinanseController extends AppController
{

  
    public function index()
    {
		
        $spendings = $this->API->Finanse()->getBudgetSpendings();
        $this->set('spendings', $spendings);


        // $application = $this->getApplication();
        $this->set('title_for_layout', 'Finanse publiczne');
    }

} 