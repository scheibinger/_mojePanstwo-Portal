<?php echo $this->Element('notlogged'); ?>

<?php echo $this->Session->flash('flash', array('element' => 'alert')); ?>
<?php echo $this->Session->flash('auth', array('element' => 'alert')); ?>

<div class="main">
    <div class="header">
        <div class="container">
            <div class="row text-center">
            <h1><?php echo __d('paszport', "LC_PASZPORT_CREATE_MOTTO") ?></h1>
            </div>
        </div>
    </div>
    <div class="content">
        <div class="container userHelper createAccount">
            <?php echo $this->Form->create('User', array('action' => 'add')); ?>
            <div class="row">
                <div class="col-xs-12 col-sm-10 col-md-8 col-sm-offset-1 col-md-offset-2">
                    <div class="control-group">
                        <label class="control-label" for="AccountType">
                            <?php echo __d('paszport', "LC_PASZPORT_ACCOUNT_TYPE"); ?>
                        </label>

                        <div class="controls" id="AccountType">
                            <div class="btn-group">
                                <a class="btn btn-default dropdown-toggle" data-toggle="dropdown" href="#">
                                    <?php echo $groups[key($groups)]; ?>
                                    <span class="caret"></span>
                                </a>
                                <ul class="dropdown-menu">
                                    <?php foreach ($groups as $k => $g) { ?>
                                        <li data-group="<?php echo $k ?>"><a href="#"><?php echo $g ?></a></li>
                                    <?php } ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php echo $this->Form->hidden('User.group_id'); ?>
            <div class="row">
                <div class="col-xs-12 col-sm-5 col-md-4 col-sm-offset-1 col-md-offset-2 form-group">
                    <?php echo $this->Form->input('User.email', array('class' => 'input-xlarge form-control', 'type' => 'email', 'label' => __d('paszport', "LC_PASZPORT_CREATE_EMAIL", true), 'autocomplete' => 'off', 'data-validation-required-message' => __d('paszport', "LC_PASZPORT_EMAIL_REQUIRED", true), 'required' => 'required', 'data-validation-email-message' => __d('paszport', "LC_PASZPORT_NOT_A_VALID_EMAIL", true), 'after' => '<span class="help-block"></span>')); ?>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 col-sm-5 col-md-4 col-sm-offset-1 col-md-offset-2 form-group">
                    <?php echo $this->Form->input('User.password', array('class' => 'input-xlarge form-control', 'type' => 'password', 'label' => __d('paszport', "LC_PASZPORT_CREATE_PASSWORD", true), 'autocomplete' => 'off', 'data-validation-required-message' => __d('paszport', "LC_PASZPORT_NEW_PASSWORD_BLANK", true), 'required' => 'required', 'data-validation-minlength-message' => __d('paszport', "LC_PASZPORT_PASSWORD_MIN_6_CHAR", true), 'minlength' => '6', 'after' => '<span class="help-block"></span>')); ?>
                </div>
                <div class="col-xs-12 col-sm-5 col-md-4">
                    <?php echo $this->Form->input('User.repassword', array('class' => 'input-xlarge form-control', 'label' => __d('paszport', 'LC_PASZPORT_CONFIRM_PASSWORD', true), 'autocomplete' => 'off', 'type' => 'password', 'data-validation-match-match' => 'data[User][password]', 'data-validation-match-message' => __d('paszport', "LC_PASZPORT_CONFIRM_PASSWORD_NOT_EQUAL", true), 'data-validation-minlength-message' => __d('paszport', "LC_PASZPORT_PASSWORD_MIN_6_CHAR", true), 'minlength' => '6', 'after' => '<span class="help-block"></span>')); ?>
                </div>
            </div>

            <div class="groupType" rel="1">
                <div class="row">
                    <div class="col-xs-12 col-sm-5 col-md-4 col-sm-offset-1 col-md-offset-2 form-group">
                        <?php echo $this->Form->input('User.username', array('class' => 'input-xlarge form-control', 'label' => __d('paszport', "LC_PASZPORT_CREATE_USERNAME", true), 'autocomplete' => 'off', 'data-validation-required-message' => __d('paszport', "LC_PASZPORT_USERNAME_BLANK", true), 'group-required' => 'required', 'after' => '<span class="help-block"></span>')); ?>
                    </div>
                    <?php /*<div class="col-lg-4">
                        <?php echo $this->Form->input('User.username', array('class' => 'input-xlarge form-control', 'label' => __d('paszport', "LC_PASZPORT_CREATE_PERSONAL_LASTNAME", true), 'autocomplete' => 'off', 'data-validation-required-message' => __d('paszport', "LC_PASZPORT_PERSONAL_LASTNAME_BLANK", true), 'group-required' => 'required', 'after' => '<span class="help-block"></span>')); ?>
                    </div>*/
                    ?>
                </div>
            </div>
            <div class="groupType hidden" rel="2">
                <div class="row">
                    <div class="col-xs-12 col-sm-5 col-md-4 col-sm-offset-1 col-md-offset-2 form-group">
                        <?php echo $this->Form->input('User.username', array('class' => 'input-xlarge form-control', 'label' => __d('paszport', "LC_PASZPORT_CREATE_USERNAME", true), 'autocomplete' => 'off', 'data-validation-required-message' => __d('paszport', "LC_PASZPORT_INSTITUTION_NAME_BLANK", true), 'group-required' => 'required', 'disabled' => 'disabled', 'after' => '<span class="help-block"></span>')); ?>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-xs-12 col-sm-5 col-md-4 col-sm-offset-1 col-md-offset-2 form-group">
                    <?php echo $this->Form->input('User.language_id', array('class' => 'selectpicker', 'label' => __d('paszport', "LC_PASZPORT_CREATE_LANGUAGE", true))); ?>
                </div>
            </div>
            <div class="row last">
                <div class="col-xs-8 col-sm-6 col-md-4 col-xs-offset-2 col-sm-offset-3 col-md-offset-4">
                    <?php echo $this->Form->submit(__d('paszport', 'LC_PASZPORT_REGISTER_BUTTON'), array('class' => 'btn btn-primary btn-lg')); ?>
                </div>
            </div>
            <?php echo $this->Form->end(); ?>
        </div>
    </div>
</div>