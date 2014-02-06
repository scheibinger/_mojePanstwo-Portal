<?php echo $this->Element('notlogged'); ?>

<div class="main">
    <div class="content">
        <div class="container">
            <div class="row motto">
                <div class="col-xs-10 col-xs-offset-1">
                    <h1><?php echo __d('paszport', 'LC_PASZPORT_PROJECT_MOTTO'); ?></h1>
                </div>
            </div>
            <div class="row userHelper logInAccount">
                <?php echo $this->Form->create('User', array('action' => 'login')); ?>
                <div class="row">
                    <div class="logInVia col-xs-12 col-sm-8 col-md-4 col-sm-offset-2 col-md-offset-4">
                        <div class="content">
                            <span>Zaloguj się przez</span>
                            <?php echo $this->Html->link('', array('action' => 'fblogin'), array('class' => 'logInBy fb ')); ?>
                            <a href="#twitter"
                               class="logInBy twitter disabled"></a><?php /*echo $this->Html->link('', array('controller' => 'users', 'action' => 'twitterlogin'), array('class' => 'logInBy twitter ')); */ ?>
                            <a href="#googlePlus" class="logInBy gPlus disabled"></a>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="or col-xs-12 col-md-8 col-md-offset-2">
                        <span class="middle"><?php echo __d('paszport', 'LC_PASZPORT_HOMEPAGE_OR'); ?></span>
                    </div>
                </div>

                <div class="row">
                    <div class="loginEmailForm col-xs-12 col-sm-8 col-md-4 col-sm-offset-2 col-md-offset-4">
                        <?php echo $this->Form->input('User.email', array('class' => 'input-xlarge', 'type' => 'email', 'label' => __d('paszport', "LC_PASZPORT_CREATE_EMAIL", true), 'autocomplete' => 'off', 'data-validation-required-message' => __d('paszport', "LC_PASZPORT_EMAIL_REQUIRED", true), 'required' => 'required', 'data-validation-email-message' => __d('paszport', "LC_PASZPORT_NOT_A_VALID_EMAIL", true), 'after' => '<span class="help-block"></span>', 'class' => 'form-control')); ?>
                        <?php echo $this->Form->input('User.password', array('class' => 'input-xlarge', 'type' => 'password', 'label' => __d('paszport', "LC_PASZPORT_CREATE_PASSWORD", true), 'autocomplete' => 'off', 'data-validation-required-message' => __d('paszport', "LC_PASZPORT_PASSWORD_REQUIRED", true), 'required' => 'required', 'data-validation-minlength-message' => __d('paszport', "LC_PASZPORT_PASSWORD_MIN_6_CHAR", true), 'minlength' => '6', 'after' => '<span class="help-block"></span>', 'class' => 'form-control')); ?>
                    </div>
                </div>
                <div class="row">
                    <div class="loginOptions col-xs-12 col-sm-8 col-md-4 col-sm-offset-2 col-md-offset-4">
                        <?php echo $this->Html->link(__d('paszport', 'LC_PASZPORT_FORGOT_PASSWORD', true), array('action' => 'forgot')); ?>
                    </div>
                </div>

                <div class="row">
                    <div class="loginSend col-xs-12 col-sm-8 col-md-4 col-sm-offset-2 col-md-offset-4">
                        <?php echo $this->Form->submit(__d('paszport', 'LC_PASZPORT_LOGIN'), array('class' => 'btn btn-primary pull-right')); ?>
                    </div>
                </div>
                <?php echo $this->Form->end(); ?>
            </div>
            <div class="row registerAccount">
                <div class="col-xs-12 col-sm-4 col-sm-offset-4">
                    <?php echo $this->Html->link(__d('paszport', 'LC_PASZPORT_HOMEPAGE_REGISTER', true), array('controller' => 'users', 'action' => 'add'), array('class' => 'register btn btn-success btn-lg', 'autocomplete' => 'off')); ?>
                </div>
            </div>
        </div>
    </div>
</div>