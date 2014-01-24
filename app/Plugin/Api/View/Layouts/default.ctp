<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">

    <title>Sejmometr API</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <?php $this->Combinator->add_libs('css', '//fonts.googleapis.com/css?family=Lato:300,400,700'); ?>
    <?php $this->Combinator->add_libs('css', '//fonts.googleapis.com/css?family=Roboto+Condensed:300,400,700&amp;subset=latin,latin-ext'); ?>
    <?php $this->Combinator->add_libs('css', $this->Less->css('statusbar')); ?>
    <?php $this->Combinator->add_libs('css', $this->Less->css('main')); ?>
    <?php $this->Combinator->add_libs('css', 'Api.style'); ?>

    <?php $this->Combinator->add_libs('js', "//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"); ?>

    <?php echo $this->Html->css('//netdna.bootstrapcdn.com/twitter-bootstrap/2.3.2/css/bootstrap-combined.min.css') ?>
    <?php echo $this->Combinator->scripts('css'); ?>
</head>
<body>
<?php //echo($_PORTAL_HEADER); ?>
<?php echo $this->Element('statusbar'); ?>
<div class="container setTop">
    <div class="hero-unit">
        <ul class="mainMenu">
            <li>
                <a href="<?php echo $this->Html->url(array('plugin' => 'api', 'controller' => 'api_pages', 'action' => 'view', 'start')); ?>">Start</a>
            </li>
            <li>
                <a href="<?php echo $this->Html->url(array('plugin' => 'api', 'controller' => 'api_pages', 'action' => 'view', 'dane')); ?>">Dane</a>
            </li>
            <li>
                <a href="<?php echo $this->Html->url(array('plugin' => 'api', 'controller' => 'api_pages', 'action' => 'view', 'rest')); ?>">Rest
                    API</a></li>
            <li>
                <a href="<?php echo $this->Html->url(array('plugin' => 'api', 'controller' => 'api_pages', 'action' => 'view', 'php')); ?>">PHP
                    API</a></li>
            <li>
                <a href="<?php echo $this->Html->url(array('plugin' => 'api', 'controller' => 'api_pages', 'action' => 'view', 'przyklady')); ?>">Przykłady</a>
            </li>
        </ul>
    </div>
    <div class="row-fluid row-inner">
        <?php echo $this->fetch('content'); ?>
        <div class="clearfix"></div>
    </div>
</div>

<?php echo $this->Html->script('//netdna.bootstrapcdn.com/twitter-bootstrap/2.3.2/js/bootstrap.min.js'); ?>
<?php echo $this->Combinator->scripts('js'); ?>

</body>