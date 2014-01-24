<?php echo $this->Element('notlogged'); ?>

<?php echo $this->Session->flash('flash', array('element' => 'alert')); ?>
<?php echo $this->Session->flash('auth', array('element' => 'alert')); ?>
<div class="main">
    <div class="header">
        <div class="container">
            <div class="row motto">
                <h1><?php echo __d('paszport', "LC_PASZPORT_LOGIN_MOTTO") ?></h1>
            </div>
        </div>
    </div>
    <div class="content">
        <div class="container userHelper logInAccount">
            <?php echo $this->Form->create('User', array('action' => 'login')); ?>
            <div class="row">
                <div class="col-xs-12 col-sm-8 col-md-4 col-sm-offset-2 col-md-offset-4">
                    <?php echo $this->Form->input('User.email', array('class' => 'input-xlarge', 'type' => 'email', 'label' => __d('paszport', "LC_PASZPORT_CREATE_EMAIL", true), 'autocomplete' => 'off', 'data-validation-required-message' => __d('paszport', "LC_PASZPORT_EMAIL_REQUIRED", true), 'required' => 'required', 'data-validation-email-message' => __d('paszport', "LC_PASZPORT_NOT_A_VALID_EMAIL", true), 'after' => '<span class="help-block"></span>', 'class' => 'form-control')); ?>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 col-sm-8 col-md-4 col-sm-offset-2 col-md-offset-4">
                    <?php echo $this->Form->input('User.password', array('class' => 'input-xlarge', 'type' => 'password', 'label' => __d('paszport', "LC_PASZPORT_CREATE_PASSWORD", true), 'autocomplete' => 'off', 'data-validation-required-message' => __d('paszport', "LC_PASZPORT_PASSWORD_REQUIRED", true), 'required' => 'required', 'data-validation-minlength-message' => __d('paszport', "LC_PASZPORT_PASSWORD_MIN_6_CHAR", true), 'minlength' => '6', 'after' => '<span class="help-block"></span>', 'class' => 'form-control')); ?>
                </div>
            </div>
            <div class="row logInActions">
                <div class="col-xs-12 col-sm-8 col-md-4 col-sm-offset-2 col-md-offset-4">
                    <?php echo $this->Html->link(__d('paszport', 'LC_PASZPORT_REGISTER', true), array('action' => 'add')); ?>
                    <?php echo $this->Html->link(__d('paszport', 'LC_PASZPORT_FORGOT_PASSWORD', true), array('action' => 'forgot')); ?>
                </div>
            </div>
            <?php /*
            <div class="row">
                <div class="logInVia col-xs-12 col-sm-8 col-md-4 col-sm-offset-2 col-md-offset-4">
                    <div class="content">
                        <span>Zaloguj się przez</span>
                        <?php echo $this->Html->link('', array('action' => 'fblogin'), array('class' => 'logInBy fb ')); ?>
                        <?php echo $this->Html->link('', array('controller' => 'users','action' => 'twitterlogin'), array('class' => 'logInBy twitter ')); ?>
                        <a href="#googlePlus" class="logInBy gPlus disabled"></a>
                    </div>
                </div>
            </div>
            */
            ?>

            <div class="row last">
                <div class="col-xs-12 col-sm-8 col-md-4 col-sm-offset-2 col-md-offset-4">
                    <?php echo $this->Form->submit(__d('paszport', 'LC_PASZPORT_LOGIN'), array('class' => 'btn btn-primary')); ?>
                </div>
            </div>
            <?php echo $this->Form->end(); ?>
        </div>
    </div>
</div>