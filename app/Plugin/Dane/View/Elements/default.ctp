<?

$path = App::path('Plugin');
$file = $path[0] . '/Dane/View/Elements/' . $theme . '/' . $object->getDataset() . '.ctp';
$file_exists = file_exists($file);

$shortTitle = (isset($options['forceTitle'])) ?
    $options['forceTitle'] :
    $object->getShortTitle();

if (in_array($object->getDataset(), array('rady_posiedzenia', 'rady_gmin_debaty', 'rady_gmin_wystapienia'))) {
    $object_content_sizes = array(3, 9);
} else {
    $object_content_sizes = array(2, 10);
}

$this->Dataobject->setObject($object);

?>
<div class="objectRender"
     oid="<?php echo $item['data']['id'] ?>" gid="<?php echo $gid ?>">
    <div class="row">
        <? if ($this->Dataobject->getDate()) { ?>
            <div class="formatDate col-md-1 dimmed">
                <?php echo($this->Dataobject->getDate()); ?>
            </div>
        <? } ?>
        <div class="data col-md-<?= $this->Dataobject->getDate() ? '11' : '12' ?>">
            <div class="row">
            	
            	<?
                	if( $object->getPosition() ) {
                ?>
                <div class="content col-md-1">
                	<span class="badge badge-position pull-right"><?= $object->getPosition() ?></span>
                </div>
                <?
                	}
                ?>
            	
                <? if ($object->getThumbnailUrl($thumbSize)) { 
	                
	                $size = $object_content_sizes[0];
	                if( $object->getPosition() )
	                	$size--;
	                
                ?>
                    <div class="attachment col-md-<?= $size ?> text-center">
                        <?php if ($object->getUrl() != false) { ?>
                        <a class="thumb_cont" href="<?= $object->getUrl() ?>">
                            <?php } ?>
                            <img class="thumb pull-right" onerror="imgFixer(this)" src="<?= $object->getThumbnailUrl($thumbSize) ?>"
                                 alt="<?= strip_tags($object->getTitle()) ?>"/>
                            <?php if ($object->getUrl() != false) { ?>
                        </a>
                    <?php } ?>
                    </div>                    
                    <?
                    	$size = $object_content_sizes[1];
                    	if( !$object->getThumbnailUrl($thumbSize) && $object->getPosition() )
                    		$size--;
                    ?>
                    <div class="content col-md-<?= $size ?>">

                        <? if ($object->force_hl_fields || $forceLabel) { ?>
                            <p class="header">
                                <?= $object->getLabel(); ?>
                            </p>
                        <? } ?>

                        <p class="title">
                            <?php if ($object->getUrl() != false) { ?>
                            <a href="<?= $object->getUrl() ?>" title="<?= strip_tags($object->getTitle()) ?>">
                                <?php } ?>
                                <?= $shortTitle ?>
                                <?php if ($object->getUrl() != false) { ?>
                            </a> <?
                        }
                        if ($object->getTitleAddon()) echo '<small>' . $object->getTitleAddon() . '</small>'; ?>
                        </p>
                        <?
                        if ($file_exists)
                            echo $this->element('Dane.' . $theme . '/' . $object->getDataset(), array(
                                'item' => $item,
                                'object' => $object,
                                'hlFields' => $hlFields,
                                'hlFieldsPush' => $hlFieldsPush,
                            ));
                        else
                            echo $this->Dataobject->highlights($hlFields, $hlFieldsPush);
                        ?>
                        
                        <? if( $object->getDescription() ){?>
                        <div class="description">
                        	<?= $object->getDescription() ?>
                        </div>
                        <?}?>
                        
                    </div>

                <? } else { ?>
                    <div class="content">

                        <? if ($object->force_hl_fields || $forceLabel) { ?>
                            <p class="header">
                                <?= $object->getLabel(); ?>
                            </p>
                        <? } ?>

                        <p class="title">
                            <?php if ($object->getUrl() != false){ ?>
                            <a href="<?= $object->getUrl() ?>" title="<?= strip_tags($object->getTitle()) ?>">
                                <?php } ?>
                                <?= $shortTitle ?>
                                <?php if ($object->getUrl() != false){ ?>
                            </a> <?
                        }
                        if ($object->getTitleAddon()) echo '<small>' . $object->getTitleAddon() . '</small>'; ?>
                        </p>
                        <?
                        if ($file_exists)
                            echo $this->element('Dane.' . $theme . '/' . $object->getDataset(), array(
                                'item' => $item,
                                'object' => $object,
                                'hlFields' => $hlFields,
                                'hlFieldsPush' => $hlFieldsPush,
                            ));
                        else
                            echo $this->Dataobject->highlights($hlFields, $hlFieldsPush);
                        ?>

                    </div>
                <? } ?>
            </div>
        </div>
    </div>
    <?php if ($object->hasHighlights() && $object->getHlText()) { ?>
        <div class="row">
            <div class="text-highlights alert alert-info">
                <?php echo $object->getHlText(); ?>
            </div>
        </div>
    <?php } ?>
</div>