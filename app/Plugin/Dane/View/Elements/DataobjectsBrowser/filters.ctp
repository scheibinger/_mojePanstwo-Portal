<div class="col-xs-12 col-sm-3 dataFilters update-filters">

    <? if ($page['showTitle']) { ?>
    <div class="header">
        <<?= $page['titleTag'] ?>><? if (!empty($this->request->query)) { ?><a
            href="<?= $page['href'] ?>"><? } ?><?= $page['title'] ?><? if (!empty($this->request->query)) { ?></a><? } ?>
    </<?= $page['titleTag'] ?>>
</div>
<? } ?>

<?php echo $this->Filter->generateFilters($filters, $switchers, $facets, $page); ?>