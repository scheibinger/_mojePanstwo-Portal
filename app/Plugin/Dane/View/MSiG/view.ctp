<?
	$this->Combinator->add_libs('css', $this->Less->css('view-msig', array('plugin' => 'Dane')));
	echo $this->Element('dataobject/pageBegin');			
?>

<?= $this->Document->place( $document ) ?>

<?=	$this->Element('dataobject/pageEnd'); ?>