<?php $this->Combinator->add_libs('css', $this->Less->css('view-gminy', array('plugin' => 'Dane'))); ?>
<?php $this->Combinator->add_libs('css', $this->Less->css('view-gminy_rada', array('plugin' => 'Dane'))); ?>
<?php $this->Combinator->add_libs('css', $this->Less->css('dataobjectslider', array('plugin' => 'Dane'))) ?>

<? if ($object->getId() == '903') $this->Combinator->add_libs('css', $this->Less->css('view-gminy-krakow', array('plugin' => 'Dane'))); ?>

<?php echo $this->Element('dataobject/pageBegin'); ?>

    <div class="header">

        <div class="col-lg-9 ">
            <h1>Rada gminy <?= $object->getData('nazwa') ?></h1>
        </div>

        <div class="col-lg-3 text-right tools">
            <a class="btn btn-primary" href="/dane/gminy/<?= $object->getId() ?>/radni">Zobacz skład rady</a>
        </div>
    </div>

    <div class="object">

        <div class="col-lg-12">

            <h2><a href="/dane/gminy/<?= $object->getId() ?>/rady_posiedzenia">Posiedzenia rady</a></h2>

            <div
                class="radyPosiedzenia"><? echo $this->dataobjectsSlider->render($rady_posiedzenia, array('perGroup' => 1, 'theme' => 'rada-gminy-posiedzenie')); ?></div>

            <p class="well well-sm">Zobacz też <a href="/dane/gminy/<?= $object->getId() ?>/rady_gmin_debaty">listę
                    debat</a> oraz <a href="/dane/gminy/<?= $object->getId() ?>/rady_gmin_wystapienia">listę
                    wystąpień</a> na wszystkich posiedzeniach rady miasta <?= $object->getData('nazwa') ?>.</p>

            <h2><a href="/dane/gminy/<?= $object->getId() ?>/rady_druki">Druki</a></h2>

            <div
                class="radyDruki"><? echo $this->dataobjectsSlider->render($rady_druki, array('perGroup' => 4)); ?></div>

            <h2><a href="/dane/gminy/<?= $object->getId() ?>/radni">Radni gminy</a></h2>

            <div class="radniGminy"><? echo $this->dataobjectsSlider->render($radni, array(
                    'perGroup' => 4,
                    'theme' => 'gmina'
                )); ?></div>

        </div>

    </div>
<?php echo $this->Element('dataobject/pageEnd'); ?>