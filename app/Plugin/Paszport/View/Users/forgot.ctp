<?php echo $this->Element('notlogged'); ?>

<?php echo $this->Session->flash('flash', array('element' => 'alert')); ?>
<?php echo $this->Session->flash('auth', array('element' => 'alert')); ?>

<div class="main">
    <div class="header">
        <div class="container">
            <div class="row">
                <h1><?php echo __d('paszport', "LC_PASZPORT_PASSWORD_FORGOT_MOTTO") ?></h1>
            </div>
        </div>
    </div>
    <div class="content">
        <div class="container userHelper forgotPassword">
            <div class="row">
                <div class="col-xs-12 col-sm-10 col-md-8 col-sm-offset-1 col-md-offset-2">
                    <?php echo __d('paszport', "LC_PASZPORT_FORGOT_PASSWORD_EVANGELION"); ?>
                </div>
            </div>
            <?php echo $this->Form->create('User', array('action' => 'forgot')); ?>
            <div class="row">
                <div class="col-xs-12 col-sm-5 col-md-4 col-sm-offset-1 col-md-offset-2 form-group">
                    <?php echo $this->Form->input('User.email', array('class' => 'input-xlarge form-control', 'type' => 'email', 'label' => __d('paszport', " ", true), 'data-validation-required-message' => __d('paszport', "LC_PASZPORT_EMAIL_REQUIRED", true), 'autocomplete' => 'off', 'required' => 'required', 'data-validation-email-message' => __d('paszport', "LC_PASZPORT_NOT_A_VALID_EMAIL", true), 'after' => '<span class="help-block"></span>')); ?>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-6 col-sm-6 col-md-4 col-xs-offset-3 col-sm-offset-3 col-md-offset-4">
                    <?php echo $this->Form->submit(__d('paszport', 'LC_PASZPORT_SEND'), array('class' => 'btn btn-primary')); ?>
                </div>
            </div>
            <?php echo $this->Form->end(); ?>
        </div>
    </div>
</div>