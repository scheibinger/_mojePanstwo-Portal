<?= $this->Element('dataobject/pageBegin'); ?>

<?php $this->Combinator->add_libs('css', $this->Less->css('view-krsosoby', array('plugin' => 'Dane'))); ?>
<?php // $this->Combinator->add_libs('js', 'Dane.view-krspodmioty'); ?>

<?
if ($organizacje = $object->getLayer('organizacje')) {
    ?>
    <div class="object">

        <?=
        $this->Element('Dane.objects/krs_osoby/organizacje', array(
            'organizacje' => $organizacje,
        )); ?>

    </div>
<? } ?>

<?= $this->Element('dataobject/pageEnd'); ?>