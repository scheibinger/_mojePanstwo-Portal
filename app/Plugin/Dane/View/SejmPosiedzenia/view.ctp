<?php $this->Combinator->add_libs('css', $this->Less->css('view-sejmposiedzenia', array('plugin' => 'Dane'))); ?>
<?php $this->Combinator->add_libs('css', $this->Less->css('dataobjectslider', array('plugin' => 'Dane'))); ?>

<?php $this->Combinator->add_libs('js', 'Dane.dataobjectsslider'); ?>

<?php echo $this->Element('dataobject/pageBegin'); ?>
    <div class="col-md-12 row">
        <div class="object">
            <div class="wskazniki">
                <div class="wskaznik text-center">
                    <small><?php echo __d('dane', 'LC_DANE_PUNKTY_PORZADKU_DZIENNEGO'); ?></small>
                    <strong><?php echo $this->Number->currency($object->getData('liczba_punktow'), '', array('places' => 0)); ?></strong>
                </div>

                <div class="wskaznik text-center">
                    <small><?php echo __d('dane', 'LC_DANE_PUNKTY_PORZADKU_DZIENNEGO'); ?></small>
                    <strong><?php echo $this->Number->currency($object->getData('liczba_punktow'), '', array('places' => 0)); ?></strong>
                </div>

                <div class="wskaznik text-center">
                    <small><?php echo __d('dane', 'LC_DANE_LICZBA_WYSTAPIEN'); ?></small>
                    <strong><?php echo $this->Number->currency($object->getData('liczba_wystapien'), '', array('places' => 0)); ?></strong>
                </div>

                <div class="wskaznik text-center">
                    <small><?php echo __d('dane', 'LC_DANE_LICZBA_GLOSOWAN'); ?></small>
                    <strong><?php echo $this->Number->currency($object->getData('liczba_glosowan'), '', array('places' => 0)); ?></strong>
                </div>

                <div class="wskaznik text-center">
                    <small><?php echo __d('dane', 'LC_DANE_LICZBA_PRZYJETYCH_USTAW'); ?></small>
                    <strong><?php echo $this->Number->currency($object->getData('liczba_przyjetych_ustaw'), '', array('places' => 0)); ?></strong>
                </div>
            </div>

            <div class="dataobjectsSliderRow col-md-12">
                <h2><?php echo __d('dane', 'LC_DANE_PRZYJETE_USTAWY'); ?></h2>
                <? echo $this->dataobjectsSlider->render($ustawy, array(
                    'perGroup' => 4,
                    'theme' => 'gmina'
                )); ?>
            </div>
        </div>
    </div>
<?php echo $this->Element('dataobject/pageEnd'); ?>