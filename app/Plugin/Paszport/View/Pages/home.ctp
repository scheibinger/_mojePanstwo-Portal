<?php echo $this->Element('notlogged'); ?>

<?php $this->Combinator->add_libs('css', $this->Less->css('home', array('plugin' => 'Paszport'))); ?>

<div class="main">
    <div class="content">
        <div class="container">
            <div class="row motto">
                <div class="col-xs-10 col-xs-offset-1">
                    <h1><?php echo __d('paszport', 'LC_PASZPORT_PROJECT_MOTTO'); ?></h1>
                </div>
            </div>
            <div class="row join">
                <div class="col-xs-12 col-sm-4 col-sm-offset-4">
                    <?php echo $this->Html->link(__d('paszport', 'LC_PASZPORT_REGISTER', true), array('controller' => 'users', 'action' => 'add'), array('class' => 'register btn btn-primary btn-lg', 'autocomplete' => 'off')); ?>
                </div>
            </div>
            <div class="row or">
                <div class="col-xs-12 col-sm-2 col-sm-offset-5">
                    <?php echo __d('paszport', 'LC_PASZPORT_HOMEPAGE_OR'); ?>
                    <?php echo $this->Html->link(__d('paszport', 'LC_PASZPORT_HOMEPAGE_SIGN', true), array('controller' => 'users', 'action' => 'failed'), array('class' => 'signIn', 'href' => '#', 'data-modal' => "epaszportLogIn", 'autocomplete' => 'off')); ?>
                </div>
            </div>
        </div>
    </div>
</div>