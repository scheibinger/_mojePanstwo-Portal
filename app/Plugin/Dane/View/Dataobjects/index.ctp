<?php $this->Combinator->add_libs('css', $this->Less->css('dataobject', array('plugin' => 'Dane'))) ?>

<?php echo $this->element('appHeader', array('plugin' => 'Dane')); ?>

<div class="container dataBrowser">
    <div class="row">
        <div class="col-md-12 dataObjects">
            <div class="dataInfo">
                <div class="col-md-4 dataStats">
                    <strong><?= $this->Number->currency($pagination['total'], '', array('places' => 0,)); ?></strong>
                    <?php echo __d('dane', 'LC_DANE_WYNIKOW'); ?>
                </div>
            </div>
            <div class="innerContainer">
                <ul class="list-group list-dataobjects">
                    <? foreach ($objects as $object) {
                        echo $this->Dataobject->render($object['Dataobject']);
                    } ?>
                </ul>
                <div class="paginationList col-md-6 col-md-offset-3">
                    <ul class="pagination pagination-sm">
                        <?php echo $this->Paginator->numbers(array('tag' => 'li', 'currentTag' => 'a', 'currentClass' => 'active', 'separator' => false, 'escape' => false)); ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>