<?php $this->Combinator->add_libs('css', $this->Less->css('view-sejmdebaty', array('plugin' => 'Dane'))); ?>

<?php echo $this->Element('dataobject/pageBegin'); ?>
    <div class="col-md-12 row">
        <div class="object mpanel">
            <?php foreach ($stenogram['wystapienia'] as $wpis) { ?>

                <a class="wystapienie" href="/dane/sejm_wystapienia/<?= $wpis['id'] ?>">

                    <?php if ($wpis['marszalek'] == '1') { ?>
                        <div class="marszalek col-md-10 col-md-offset-1">
                            <div class="col-md-11">
                                <blockquote class="pull-right text-info">
                                    <small><?= $wpis['mowca_nazwa'] ?>, <?= $wpis['funkcja_nazwa'] ?></small>
                                    <?= $wpis['p_txt'] ?>
                                </blockquote>
                            </div>
                            <div class="col-md-1">
                                <img
                                    src="http://resources.sejmometr.pl/mowcy/a/1/<?= $wpis['mowca_id']; ?>.jpg"/>
                            </div>
                        </div>
                    <?php } else { ?>
                        <div class="col-md-10 col-md-offset-1">
                            <div class="col-md-1">
                                <img
                                    src="http://resources.sejmometr.pl/mowcy/a/1/<?= $wpis['mowca_id'] ?>.jpg"/>
                            </div>
                            <div class="col-md-11">
                                <blockquote>
                                    <small><?= $wpis['mowca_nazwa']; ?>, <?= $wpis['funkcja_nazwa'] ?></small>
                                    <?= $wpis['p_txt'] ?>
                                </blockquote>
                            </div>
                        </div>
                    <?php } ?>

                </a>

            <?php } ?>
        </div>
    </div>
<?php echo $this->Element('dataobject/pageEnd'); ?>