<?
	$this->Combinator->add_libs('css', $this->Less->css('view-msig', array('plugin' => 'Dane')));
	echo $this->Element('dataobject/pageBegin', array(
		'titleTag' => 'p',
	));			
?>

<h1><?= $dzial->getShortTitle() ?></h1>

<?= $this->Document->place( $document ) ?>


<?=	$this->Element('dataobject/pageEnd'); ?>