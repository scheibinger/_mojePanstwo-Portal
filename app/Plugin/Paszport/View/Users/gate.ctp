<?php echo $this->Element('notlogged'); ?>

<div class="main">
    <div class="container">
        <?php echo $this->Form->create('User'); ?>
        <?php echo $this->Form->input('User.email', array('placeholder' => __d('paszport', 'LC_PASZPORT_EMAIL', true))); ?>
        <?php echo $this->Form->input('User.password', array('placeholder' => __d('paszport', 'LC_PASZPORT_PASSWORD', true))); ?>
        <?php echo $this->Form->submit(__d('paszport', 'LC_PASZPORT_LOGIN', true), array('class' => 'btn btn-success')); ?>
        <?php echo $this->Form->end(); ?>
        <?php echo $this->Html->link(__d('paszport', 'LC_PASZPORT_REGISTER', true), array('action' => 'add')); ?>
        <?php echo $this->Html->link(__d('paszport', 'LC_PASZPORT_FORGOT_PASSWORD', true), array('action' => 'forgot')); ?>
    </div>
</div>