<?
	$this->Combinator->add_libs('css', $this->Less->css('dataobjectslider', array('plugin' => 'Dane')));
	$this->Combinator->add_libs('css', $this->Less->css('view-sejmposiedzenia', array('plugin' => 'Dane')));
	$projekty = $object->getLayer('projekty');

	echo $this->Element('dataobject/pageBegin');
?>


<div class="poslowie row mpanel">
	<div class="column col-md-4">
	
		<h2 class="label label-success">Przyjęto</h2>
		<? echo $this->element('sejmposiedzenie-projekty', array(
			'projekty' => $projekty['przyjete'],
		)); ?>
		
	</div><div class="column col-md-4">
	
		<h2 class="label label-primary">Do dalszych prac</h2>
		<? echo $this->element('sejmposiedzenie-projekty', array(
			'projekty' => $projekty['dalsze_prace'],
		)); ?>
	
	</div><div class="column col-md-4">
	
		<h2 class="label label-danger">Odrzucono</h2>
		<? echo $this->element('sejmposiedzenie-projekty', array(
			'projekty' => $projekty['odrzucone'],
		)); ?>
	
	</div>
</div>


<?= $this->Element('dataobject/pageEnd'); ?>