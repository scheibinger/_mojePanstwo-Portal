<?php // $this->Combinator->add_libs('css', $this->Less->css('view-bdl-wskazniki', array('plugin' => 'Dane'))); ?>

<?= $this->Element('dataobject/pageBegin'); ?>
    <div class="object">
        <? debug($expanded_dim); ?>
        <? debug($dims); ?>
    </div>
<?= $this->Element('dataobject/pageEnd'); ?>