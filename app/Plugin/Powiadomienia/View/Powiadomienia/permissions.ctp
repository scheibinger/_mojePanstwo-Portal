<?php $this->Combinator->add_libs('css', $this->Less->css('permissions', array('plugin' => 'Powiadomienia'))); ?>
<div class="container permissions">
    <div class="image col-sm-12 col-md-2">
        <?php echo $this->Html->image('Powiadomienia.ups.png'); ?>
    </div>
    <div class="information col-sm-12 col-md-10">
        <p class="text-center lead text-info">
            <strong><?php echo __d('powiadomienia', 'LC_POWIADOMIENIA_PERMISSION_HEADLINE'); ?></strong>
        </p>

        <p class="text-center">
            <a href="<?php echo $this->Html->url(array('plugin' => 'paszport', 'controller' => 'pages', 'action' => 'home')); ?>"
               class="btn btn-primary btn-lg">
                <?php echo __d('powiadomienia', 'LC_POWIADOMIENIA_PERMISSION_LOGIN'); ?>
            </a>
        </p>
    </div>
</div>