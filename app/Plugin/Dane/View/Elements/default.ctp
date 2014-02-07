<?
$path = App::path('Plugin');
$file = $path[0] . '/Dane/View/Elements/' . $theme . '/' . $object->getDataset() . '.ctp';
$file_exists = file_exists($file);

if (in_array($object->getDataset(), array('rady_posiedzenia', 'rady_gmin_debaty', 'rady_gmin_wystapienia'))) {
    $object_content_sizes = array(3, 9);
} else {
    $object_content_sizes = array(2, 10);
}

$this->Dataobject->setObject( $object );
?>
<div class="objectRender col-md-12 <?= $object->getDataset() ?><? if ($bg) { ?> bg<? } ?>"
     oid="<?php echo $item['data']['id'] ?>">
<div class="row">
        <? if ($this->Dataobject->getDate()) { ?>
            <div class="formatDate col-md-1 dimmed">
                <?php echo($this->Dataobject->getDate()); ?>
            </div>
        <? } ?>
        <div class="data col-md-<?= $this->Dataobject->getDate() ? '11' : '12' ?>">
            <div class="row">
                <? if ($object->getThumbnailUrl( $thumbSize )) { ?>
                    <div class="attachment col-md-<?= $object_content_sizes[0] ?> text-center">
                        <?php if ($object->getUrl() != false) { ?>
                        <a href="<?= $object->getUrl() ?>">
                            <?php } ?>
                            <img onerror="imgFixer(this)" src="<?= $object->getThumbnailUrl( $thumbSize ) ?>"
                                 alt="<?= strip_tags($object->getTitle()) ?>"/>
                            <?php if ($object->getUrl() != false) { ?>
                        </a>
                    <?php } ?>
                    </div>
                    <div class="content col-md-<?= $object_content_sizes[1] ?>">
                        
                        <? if( $object->force_hl_fields || $forceLabel ) { ?>
                        <p class="header">
                            <?= $object->getLabel(); ?>
                        </p>
                        <? } ?>

                        <p class="title">
                            <?php if ($object->getUrl() != false) { ?>
                            <a href="<?= $object->getUrl() ?>" title="<?= strip_tags($object->getTitle()) ?>">
                                <?php } ?>
                                <?= $object->getShortTitle() ?>
                                <?php if ($object->getUrl() != false) { ?>
                            </a> <? if($object->getTitleAddon()) echo '<small>' . $object->getTitleAddon() . '</small>'; ?>
                        <?php } ?>
                        </p>
                        <?
                        if ($file_exists)
                            echo $this->element('Dane.' . $theme . '/' . $object->getDataset(), array(
                                'item' => $item,
                                'object' => $object
                            ));
                        else
	                        echo $this->Dataobject->highlights( $hlFields );
                        ?>
                    </div>

                <? } else { ?>
                    <div class="content">
                        
                        <? if( $object->force_hl_fields || $forceLabel ) { ?>
                        <p class="header">
                            <?= $object->getLabel(); ?>
                        </p>
                        <? } ?>

                        <p class="title">
                            <?php if ($object->getUrl() != false){ ?>
                            <a href="<?= $object->getUrl() ?>" title="<?= strip_tags($object->getTitle()) ?>">
                                <?php } ?>
                                <?= $object->getShortTitle() ?>
                                <?php if ($object->getUrl() != false){ ?>
                            </a> <? if($object->getTitleAddon()) echo '<small>' . $object->getTitleAddon() . '</small>'; ?>
                        <?php } ?>
                        </p>
                        <?
                        if ($file_exists)
                            echo $this->element('Dane.' . $theme . '/' . $object->getDataset(), array(
                                'item' => $item,
                                'object' => $object
                            ));
                        else
                        	echo $this->Dataobject->highlights( $hlFields );
                        ?>

                    </div>
                <? } ?>
            </div>
        </div>
    </div>
    <?php if ($object->hasHighlights() && $object->getHlText()) { ?>
        <div class="row">
            <div class="highlights alert alert-info">
                <?php echo $object->getHlText(); ?>
            </div>
        </div>
    <?php } ?>
</div>