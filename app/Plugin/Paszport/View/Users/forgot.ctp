<?php echo $this->Element('notlogged'); ?>

<?php echo $this->Session->flash('flash', array('element' => 'alert')); ?>
<?php echo $this->Session->flash('auth', array('element' => 'alert')); ?>

<div class="main">
    <div class="header">
        <div class="container">
            <div class="row text-center">
            <h1><?php echo __d('paszport', "LC_PASZPORT_PASSWORD_FORGOT_MOTTO") ?></h1>
            </div>
        </div>
    </div>
    <div class="content">
        <div class="container userHelper forgotPassword">
            <div class="row">
                <div class="col-xs-12 col-sm-8 col-md-6 col-sm-offset-2 col-md-offset-3 text-center">
                <?php echo __d('paszport', "LC_PASZPORT_FORGOT_PASSWORD_EVANGELION"); ?>
                </div>
            </div>
            <?php echo $this->Form->create('User', array('action' => 'forgot')); ?>
            <div class="row">
                <div class="col-xs-12 col-sm-6 col-md-4 col-sm-offset-3 col-md-offset-4 form-group">
                    <?php echo $this->Form->input('User.email', array('class' => 'input-xlarge form-control', 'type' => 'email', 'label' => __d('paszport', " ", true), 'data-validation-required-message' => __d('paszport', "LC_PASZPORT_EMAIL_REQUIRED", true), 'autocomplete' => 'off', 'required' => 'required', 'data-validation-email-message' => __d('paszport', "LC_PASZPORT_NOT_A_VALID_EMAIL", true), 'placeholder' => __d('paszport', "LC_PASZPORT_FORGET_EMAIL_PLACEHOLDER", true), 'after' => '<span class="help-block"></span>')); ?>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-6 col-sm-6 col-md-4 col-xs-offset-3 col-sm-offset-3 col-md-offset-4 text-center">
                    <?php echo $this->Form->submit(__d('paszport', 'LC_PASZPORT_SEND'), array('class' => 'btn btn-primary btn-lg')); ?>
                </div>
            </div>
            <?php echo $this->Form->end(); ?>
        </div>
    </div>
</div>