<?
$this->Combinator->add_libs('css', $this->Less->css('view-twitter', array('plugin' => 'Dane')));
echo $this->Element('dataobject/pageBegin');
?>

<?= $this->Element('dataobject/pageEnd'); ?>