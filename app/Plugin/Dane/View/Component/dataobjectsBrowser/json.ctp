<div id="objectstatus">
    <strong><?= $this->Number->currency($total, '', array('places' => 0,)); ?></strong>
</div>
<div class="innerContainer">
    <ul class="list-group list-dataobjects">
        <? foreach ($objects as $object) {
            echo $this->Dataobject->render($object['Dataobject']);
        } ?>
    </ul>
    <div class="col-xs-12 col-sm-6 col-sm-offset-3">
        <ul class="pagination pagination-sm">
            <?php echo $this->Paginator->numbers(array('tag' => 'li', 'currentTag' => 'a', 'currentClass' => 'active', 'separator' => false, 'escape' => false)); ?>
        </ul>
    </div>
</div>

<div id="hiddenFilters">
    <div class="header">
        <h1>
            <a href="<?= $page['href'] ?>">
                <?= $page['title'] ?>
            </a>
        </h1>
    </div>

    <?php echo $this->Filter->generateFilters($filters, $switchers, $facets, $page); ?>

</div>