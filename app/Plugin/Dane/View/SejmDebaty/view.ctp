<?php $this->Combinator->add_libs('css', $this->Less->css('view-sejmdebaty', array('plugin' => 'Dane'))); ?>

<?php echo $this->Element('dataobject/pageBegin'); ?>
    <div class="col-md-12 row">
        <div class="object">
            <?php foreach ($stenogram as $wpis) { ?>
                <?php if ($wpis['Dataobject']->getData('stanowiska.id') == 3) { ?>
                    <div class="wystapienie marszalek col-md-10 col-md-offset-1">
                        <div class="col-md-11">
                            <blockquote class="pull-right text-info">
                                <small><?php echo $wpis['Dataobject']->getData('ludzie.nazwa'); ?>
                                    , <?php echo $wpis['Dataobject']->getData('stanowiska.nazwa'); ?></small>
                                <?php echo $wpis['Dataobject']->layers['html']['SejmWystapienia']['o_txt']; ?>
                                <!--                            <a href="-->
                                <?php //echo $this->Html->url(array('plugin' => 'Dane', 'controller' => 'sejm_wystapienia', 'action' => 'view', 'id' => $wpis['Dataobject']->object_id)); ?><!--" class="btn btn-primary pull-right btn-sm">-->
                                <?php //echo __d('dane','LC_ZOBACZ_STRONE_WYSTAPIENIA'); ?><!--</a>-->
                            </blockquote>
                        </div>
                        <div class="col-md-1">
                            <img
                                src="http://resources.sejmometr.pl/mowcy/a/1/<?php echo $wpis['Dataobject']->getData('czlowiek_id'); ?>.jpg"/>
                        </div>
                    </div>
                <?php } else { ?>
                    <div class="wystapienie col-md-10 col-md-offset-1">
                        <div class="col-md-1">
                            <img
                                src="http://resources.sejmometr.pl/mowcy/a/1/<?php echo $wpis['Dataobject']->getData('czlowiek_id'); ?>.jpg"/>
                        </div>
                        <div class="col-md-11">
                            <blockquote>
                                <small><?php echo $wpis['Dataobject']->getData('ludzie.nazwa'); ?>
                                    , <?php echo $wpis['Dataobject']->getData('stanowiska.nazwa'); ?></small>
                                <?php echo $wpis['Dataobject']->layers['html']['SejmWystapienia']['o_txt']; ?>
                                <!--                            <a href="-->
                                <?php //echo $this->Html->url(array('plugin' => 'Dane', 'controller' => 'sejm_wystapienia', 'action' => 'view', 'id' => $wpis['Dataobject']->object_id)); ?><!--" class="btn btn-primary btn-sm">-->
                                <?php //echo __d('dane','LC_ZOBACZ_STRONE_WYSTAPIENIA'); ?><!--</a>-->
                            </blockquote>
                        </div>
                    </div>
                <?php } ?>
            <?php } ?>
        </div>
    </div>
<?php echo $this->Element('dataobject/pageEnd'); ?>