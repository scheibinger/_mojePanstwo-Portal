<?php echo $this->Element('notlogged'); ?>

<?php echo $this->Session->flash('flash', array('element' => 'alert')); ?>
<?php echo $this->Session->flash('auth', array('element' => 'alert')); ?>

<div class="main">
    <div class="header">
        <div class="container">
            <div class="row">
                <h1><?php echo __d('paszport', "LC_PASZPORT_RESET_PASSWORD_MOTTO") ?></h1>
            </div>
        </div>
    </div>
    <div class="content">
        <div class="container userHelper forgotPassword">
            <?php echo $this->Form->create('User', array('action' => 'reset')); ?>
            <div class="row">
                <div class="col-xs-12 col-sm-5 col-md-4 col-sm-offset-1 col-md-offset-2 form-group">
                    <?php echo $this->Form->input('User.password', array('class' => 'input-xlarge form-control', 'label' => __d('paszport', 'LC_PASZPORT_NEW_PASSWORD', true), 'type' => 'password', 'data-validation-required-message' => __d('paszport', 'LC_PASZPORT_NEW_PASSWORD_BLANK', true), 'required' => 'required', 'data-validation-minlength-message' => __d('paszport', "LC_PASZPORT_PASSWORD_MIN_6_CHAR", true), 'minlength' => '6', 'autocomplete' => 'off', 'after' => '<span class="help-block"></span>')); ?>
                </div>
                <div class="col-xs-12 col-sm-5 col-md-4 form-group">
                    <?php echo $this->Form->input('User.repassword', array('class' => 'input-xlarge form-control', 'label' => __d('paszport', 'LC_PASZPORT_CONFIRM_PASSWORD', true), 'type' => 'password', 'data-validation-match-match' => 'data[User][password]', 'data-validation-match-message' => __d('paszport', "LC_PASZPORT_CONFIRM_PASSWORD_NOT_EQUAL", true), 'data-validation-minlength-message' => __d('paszport', "LC_PASZPORT_PASSWORD_MIN_6_CHAR", true), 'minlength' => '6', 'autocomplete' => 'off', 'after' => '<span class="help-block"></span>')); ?>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-6 col-sm-6 col-md-4 col-xs-offset-3 col-sm-offset-3 col-md-offset-4">
                    <?php echo $this->Form->submit(__d('paszport', 'LC_PASZPORT_SEND'), array('class' => 'btn btn-primary btn-lg')); ?>
                </div>
            </div>
            <?php echo $this->Form->end(); ?>
        </div>
    </div>
</div>