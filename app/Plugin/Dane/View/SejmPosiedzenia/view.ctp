<?php // $this->Combinator->add_libs('css', $this->Less->css('view-sejmposiedzenia', array('plugin' => 'Dane'))); ?>
<?php $this->Combinator->add_libs('css', $this->Less->css('dataobjectslider', array('plugin' => 'Dane'))); ?>
<?php $this->Combinator->add_libs('js', 'Dane.dataobjectsslider'); ?>

<?php echo $this->Element('dataobject/pageBegin'); ?>
    
<div class="object">
	Posiedzenie
</div>
    
<?php echo $this->Element('dataobject/pageEnd'); ?>