<?php

class DocumentHelper extends AppHelper
{

	public $doc = false;
	
    public function place($doc)
    {
       	
       	$this->doc = $doc;
       	       	
       	return $this->_View->element('Document/view', array(
       		'document' => $this->doc,
       		'documentPackage' => 1,
       	));
       	
       	
    }

}