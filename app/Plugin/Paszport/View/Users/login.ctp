<?php echo $this->Element('notlogged'); ?>

<?php echo $this->Session->flash('flash', array('element' => 'alert')); ?>
<?php echo $this->Session->flash('auth', array('element' => 'alert')); ?>

<div class="main">
    <div class="header">
        <div class="container">
            <div class="row">
                <div class="col-xs-10 col-xs-offset-1 text-center">
                    <h1><?php echo __d('paszport', 'LC_PASZPORT_PROJECT_MOTTO'); ?></h1>
                </div>
            </div>
        </div>
    </div>
    <div class="content">
        <div class="container">
        <div class="row userHelper logInAccount">
                <?php echo $this->Form->create('User', array('action' => 'login')); ?>
                <div class="row">
                    <div class="or nomargin col-xs-12 col-sm-10 col-md-6 col-sm-offset-1 col-md-offset-3">
                        <span
                            class="middle"><?php echo __d('paszport', 'LC_PASZPORT_MODAL_LOGIN_VIA_FACEBOOK') ?></span>
                    </div>
                    <div class="logInVia col-xs-12 col-sm-8 col-sm-offset-2">
                        <div class="content">
                            <?php echo $this->Html->link('<i class="fa fa-facebook"></i>' . __d('paszport', 'LC_PASZPORT_LOGIN'), array('action' => 'fblogin'), array('class' => 'btn btn-facebook btn-md', 'target' => '_blank', 'escape' => false)); ?>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="or col-xs-12 col-sm-10 col-md-6 col-sm-offset-1 col-md-offset-3">
                        <span class="middle"><?php echo __d('paszport', 'LC_PASZPORT_MODAL_LOGIN_VIA_EMAIL') ?></span>
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
                        <?php echo $this->Html->link(__d('paszport', 'LC_PASZPORT_FORGOT_PASSWORD', true), array('plugin' => 'paszport', 'controller' => 'users', 'action' => 'forgot')); ?>
                    </div>
                </div>

                <div class="row">
                    <div class="loginSend col-xs-12 col-sm-8 col-md-4 col-sm-offset-2 col-md-offset-4 text-center">
                        <?php echo $this->Form->submit(__d('paszport', 'LC_PASZPORT_LOGIN'), array('class' => 'btn btn-default')); ?>
                    </div>
                </div>
                <?php echo $this->Form->end(); ?>
                <div class="row registerAccount">
                    <div class="or col-xs-12 col-sm-10 col-md-6 col-sm-offset-1 col-md-offset-3">
                    <span class="middle">
                        <?php echo $this->Html->link(__d('paszport', 'LC_PASZPORT_MODAL_LOGIN_REGISTER', true), array('plugin' => 'paszport', 'controller' => 'users', 'action' => 'add'), array('class' => 'register', 'autocomplete' => 'off', 'target' => '_self')); ?>
                    </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>