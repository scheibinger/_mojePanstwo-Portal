<div class="modal fade" id="modalPaszportLoginForm" tabindex="-1" role="dialog"
     aria-labelledby="<?php echo __d('paszport', 'LC_PASZPORT_PROJECT_MOTTO'); ?>" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title"
                    id="myModalLabel"><?php echo __d('paszport', 'LC_PASZPORT_PROJECT_MOTTO'); ?></h4>
            </div>
            <div class="modal-body">
                <?php echo $this->Form->create('User', array(
                    'id' => 'UserLoginForm',
                    'url' => $this->Html->url(array('plugin' => 'paszport', 'controller' => 'users', 'action' => 'login', 'full_base' => true))

                )); ?>
                <div class="row">
                    <div class="or nomargin col-xs-12 col-sm-10 col-sm-offset-1">
                        <span
                            class="middle"><?php echo __d('paszport', 'LC_PASZPORT_MODAL_LOGIN_VIA_FACEBOOK') ?></span>
                    </div>

                    <div class="logInVia col-xs-12">
                        <div class="content text-center">
                            <?php echo $this->Html->link('<i class="fa fa-facebook"></i>' . __d('paszport', 'LC_PASZPORT_LOGIN'), array('action' => 'fblogin'), array('class' => 'btn btn-facebook btn-md', 'target' => '_blank', 'escape' => false)); ?>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="or col-xs-12 col-sm-10 col-sm-offset-1">
                        <span class="middle"><?php echo __d('paszport', 'LC_PASZPORT_MODAL_LOGIN_VIA_EMAIL') ?></span>
                    </div>
                </div>

                <div class="row">
                    <div class="loginEmailForm col-xs-12 col-sm-10 col-sm-offset-1">
                        <?php echo $this->Form->input('User.email', array('class' => 'input-xlarge', 'type' => 'email', 'label' => __d('paszport', "LC_PASZPORT_CREATE_EMAIL", true), 'autocomplete' => 'off', 'data-validation-required-message' => __d('paszport', "LC_PASZPORT_EMAIL_REQUIRED", true), 'required' => 'required', 'data-validation-email-message' => __d('paszport', "LC_PASZPORT_NOT_A_VALID_EMAIL", true), 'after' => '<span class="help-block"></span>', 'class' => 'form-control')); ?>
                        <?php echo $this->Form->input('User.password', array('class' => 'input-xlarge', 'type' => 'password', 'label' => __d('paszport', "LC_PASZPORT_CREATE_PASSWORD", true), 'autocomplete' => 'off', 'data-validation-required-message' => __d('paszport', "LC_PASZPORT_PASSWORD_REQUIRED", true), 'required' => 'required', 'data-validation-minlength-message' => __d('paszport', "LC_PASZPORT_PASSWORD_MIN_6_CHAR", true), 'minlength' => '6', 'after' => '<span class="help-block"></span>', 'class' => 'form-control')); ?>
                    </div>
                </div>

                <div class="row">
                    <div class="loginSend col-xs-12 text-center">
                        <?php echo $this->Form->submit(__d('paszport', 'LC_PASZPORT_LOGIN'), array('class' => 'btn btn-default')); ?>
                    </div>
                </div>

                <div class="row">
                    <div class="or col-xs-12 col-sm-10 col-sm-offset-1">
                        <span class="middle">
                            <?php echo $this->Html->link(__d('paszport', 'LC_PASZPORT_MODAL_LOGIN_REGISTER', true), array('controller' => 'users', 'action' => 'add'), array('class' => 'register', 'autocomplete' => 'off', 'target' => '_self')); ?>
                        </span>
                    </div>
                </div>

                <?php echo $this->Form->end(); ?>
            </div>

        </div>
    </div>
</div>