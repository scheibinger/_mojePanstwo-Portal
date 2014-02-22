<?
$path = App::path('Plugin');
$file = $path[0] . '/Dane/View/Elements/' . $theme . '/' . $object->getDataset() . '.ctp';
$file_exists = file_exists($file);

$title_truncate_length = 120;
?>
<div class="objectRender col-md-12 <?php echo $object->getDataset() ?>" oid="<?php echo $item['data']['id'] ?>">
<?
	if( $file_exists ) {
	
		echo $this->element('Dane.' . $theme . '/' . $object->getDataset(), array(
            'item' => $item,
            'object' => $object
        ));
        
    }
    else
    {
?>    		
 
    <div class="row">
		
        <? if ($object->getThumbnailUrl()) { ?>
            <div class="attachment col-md-4">
                <a href="<?= $object->getUrl() ?>">
                    <img onerror="imgFixer(this)" src="<?= $object->getThumbnailUrl('1') ?>"
                         alt="<?= strip_tags($object->getTitle()) ?>"

                        />
                </a>
            </div>
            <div class="content col-md-8">
                <p class="header">
                    <?= $object->getLabel(); ?>
                </p>

                <p class="title">
                    <a href="<?= $object->getUrl() ?>"
                       title="<?= strip_tags($object->getTitle()) ?>"><?= $this->Text->truncate($object->getShortTitle(), $title_truncate_length) ?></a>
                </p>

                <? if ($file_exists)
                    echo $this->element('Dane.' . $theme . '/' . $object->getDataset(), array(
                        'item' => $item,
                        'object' => $object
                    ));
                ?>
            </div>
        <? } else { ?>
            <div class="content col-md-12">
                <p class="header">
                    <?= $object->getLabel(); ?>
                </p>

                <p class="title">
                    <a href="<?= $object->getUrl() ?>"
                       title="<?= strip_tags($object->getTitle()) ?>"><?= $this->Text->truncate($object->getShortTitle(), $title_truncate_length) ?></a>
                </p>

            </div>
        <? } ?>

    </div>
    <? } ?>
</div>