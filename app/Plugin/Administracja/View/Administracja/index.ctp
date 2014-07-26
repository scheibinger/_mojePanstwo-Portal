<?php
$this->Combinator->add_libs('css', $this->Less->css('new-look'));
$this->Combinator->add_libs('css', $this->Less->css('administracja', array('plugin' => 'Administracja')));
$this->Combinator->add_libs('js', 'Administracja.administracja.js');
?>
<div id="administracja">
    <div class="appHeader">
        <div class="container innerContent">
            <h1><?php echo __d('administracja', 'LC_ADMINISTRACJA_TITLE'); ?></h1>
        </div>
    </div>

    <div class="container">
        <? if ($items = $data['files']) ;
        { ?>
            <div class="content">
                <div class="row items">
                    <? foreach ($items as $item) { ?>
                        <div class="block col-md-<?= $item['width'] ?>">
                            <div class="item" data-id="<?= $item['id'] ?>">
                                <a href="/dane/administracja_publiczna/<?= $item['id'] ?>" class="inner">
                                    <div class="logo">
                                        <img src="/administracja/img/header.png" title="<?= $item['nazwa'] ?>"/>
                                    </div>
                                    <div class="title">
                                        <p class="nazwa"><?= $item['nazwa'] ?></p>

                                        <p class="desc"><?= pl_dopelniacz($item['childsCount'], 'instytucja', 'instytucje', 'instytucji') ?></p>
                                    </div>
                                </a>
                            </div>
                        </div>
                    <? } ?>
                </div>
            </div>
        <? } ?>
    </div>
</div>