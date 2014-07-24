<?
	echo $this->Element('dataobject/pageBegin');
?>
	<div class="col-md-10">
<?
	echo $this->Element('Document/view', array(
		'document' => $document,
		'documentPackage' => 1,
	));
	echo $this->Element('dataobject/pageEnd');
?>
	</div>