<?php $this->Combinator->add_libs('css', $this->Less->css('view-radnigmin', array('plugin' => 'Dane'))); ?>

<?= $this->Element('dataobject/pageBegin'); ?>
    <div class="object">
        <div class="col-md-10 col-md-offset-1">
            <h2><?php echo __d('dane', 'LC_DANE_GMINA_DO_KTOREJ_ZOSTAL_WYBRANY_RADNY'); ?>:</h2>

            <div class="col-md-12">
                <div class="col-md-2">
                    <a href="<?php echo $this->Html->url(array('plugin' => 'Dane', 'controller' => 'gminy', 'action' => 'view', 'id' => $object->getData('gminy.id'))); ?>">
                        <img
                            src="http://resources.sejmometr.pl/gminy/thumbs/png/<?php echo $object->getData('gminy.id'); ?>.png"
                            class="pull-left"/>
                    </a>
                </div>
                <div class="col-md-10">
                    <h3>
                        <a href="<?php echo $this->Html->url(array('plugin' => 'Dane', 'controller' => 'gminy', 'action' => 'view', 'id' => $object->getData('gminy.id'))); ?>">
                            <?php echo $object->getData('gminy.nazwa'); ?>
                        </a>
                    </h3>
                </div>
            </div>
        </div>
    </div>
<?= $this->Element('dataobject/pageEnd'); ?>