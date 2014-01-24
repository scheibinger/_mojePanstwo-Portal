<?php echo $this->Element('logged'); ?>

<div class="container userCenter">
    <div class="row">
        <div class="col-xs-12 col-sm-3">
            <?php echo $this->element('left_nav_block'); ?>
        </div>
        <div class="col-xs-12 col-sm-9">
            <h3><?php echo __d('paszport', $title_for_layout); ?></h3>

            <div class="row controlsPanel">
                <div class="col-xs-12">
                    <?php echo $this->Form->create('Key', array('action' => 'add')); ?>
                    <?php echo $this->Form->submit(__d('paszport', 'LC_PASZPORT_KEY_GENERATE', true), array('class' => 'btn btn-primary')) ?>
                    <?php echo $this->Form->end(); ?>
                </div>
            </div>
        </div>
    </div>
</div>