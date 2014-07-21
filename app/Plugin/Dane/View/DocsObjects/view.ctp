<?

	echo $this->Element('dataobject/pageBegin');
	echo $this->Element('docsBrowser/doc', array(
		'document' => $document,
		'documentPackage' => $documentPackage,
	));
	echo $this->Element('dataobject/pageEnd');

?>