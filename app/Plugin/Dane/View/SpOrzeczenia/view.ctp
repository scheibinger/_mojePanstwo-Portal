<?php $this->Combinator->add_libs('css', $this->Less->css('view-sporzeczenia', array('plugin' => 'Dane'))); ?>

<?= $this->Element('dataobject/pageBegin'); ?>
    <div class="object">
        <div class="document col-md-10 col-md-offset-1">
            <?php foreach ($bloki as $blok) { ?>
                <h2><?php echo $blok['orzeczenia_bloki']['tytul']; ?></h2>
                <div class="inner">
                    <?php echo $blok['orzeczenia_bloki']['wartosc']; ?>
                </div>
            <?php } ?>
        </div>
    </div>
<?= $this->Element('dataobject/pageEnd'); ?>