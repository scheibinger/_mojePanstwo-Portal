<?php echo $this->Element('logged'); ?>

<div class="container userCenter">
    <div class="row">
        <div class="col-xs-12 col-sm-3">
            <?php echo $this->element('left_nav_block'); ?>
        </div>
        <div class="col-xs-12 col-sm-9">
            <h3><?php echo __d('paszport', $title_for_layout); ?></h3>

            <div class="row">
                <h5><?php echo __d('paszport', 'LC_PASZPORT_SETPASSWORD_AFTER_FB', true); ?></h5>

                <?php echo $this->Form->create('User'); ?>
                <?php echo $this->Form->input('User.password', array('label' => __d('paszport', 'LC_PASZPORT_CHANGE_PASSWORD', true))); ?>
                <?php echo $this->Form->submit(__d('paszport', 'LC_PASZPORT_SEND', true), array('class' => 'btn btn-primary')); ?>
                <?php echo $this->Form->end(); ?>
            </div>
        </div>
    </div>
</div>
