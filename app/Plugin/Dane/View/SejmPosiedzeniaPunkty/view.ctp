<?php $this->Combinator->add_libs('css', $this->Less->css('view-sejmposiedzeniapunkty', array('plugin' => 'Dane'))); ?>

<?php echo $this->Element('dataobject/pageBegin'); ?>
    <div class="object">
        <div class="col-md-11">
            <h2><?php echo __d('dane', 'LC_DANE_DEBATY_W_RAMACH_TEGO_PUNKTU'); ?></h2>
            <?php if (count($posiedzenia) > 0) { ?>
                <?php foreach ($debaty as $debata) { ?>
                    <?php echo $this->Dataobject->render($debata['Dataobject']); ?>
                <?php } ?>
            <?php } else { ?>
                <span class="stillWorking"><?php echo __d('dane', 'LC_SEJMPOSIEDZENIAPUNKTY_BRAK_DEBAT'); ?></span>
            <?php } ?>
        </div>
        <div class="col-md-11">
            <h2><?php echo __d('dane', 'LC_DANE_POSIEDZENIE_SEJMU_PODCZAS_KTOREGO_ODBYLA_SIE_DEBATA'); ?></h2>
            <?php if (count($posiedzenia) > 0) { ?>
                <?php foreach ($posiedzenia as $posiedzenie) { ?>
                    <?php echo $this->Dataobject->render($posiedzenie['Dataobject']); ?>
                <?php } ?>
            <?php } else { ?>
                <span
                    class="stillWorking"><?php echo __d('dane', 'LC_SEJMPOSIEDZENIAPUNKTY_BRAK_POSIEDZEN'); ?></span>
            <?php } ?>
        </div>
    </div>
<?php echo $this->Element('dataobject/pageEnd'); ?>