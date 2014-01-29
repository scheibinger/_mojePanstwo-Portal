<?php // $this->Combinator->add_libs('css', $this->Less->css('view-bdl-wskazniki', array('plugin' => 'Dane'))); ?>

<?= $this->Element('dataobject/pageBegin'); ?>
    <div class="object">
        <?= $this->Element('bdl_select', array('expanded_dim' => $expanded_dim, 'dims' => $dims)); ?>
    </div>
<?= $this->Element('dataobject/pageEnd'); ?>