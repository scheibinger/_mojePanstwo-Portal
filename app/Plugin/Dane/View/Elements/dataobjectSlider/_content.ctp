<?
	$title_truncate_length = 120;
	
	echo $this->element('dataobjectSlider/_header', array(
		'object' => $object,
		'options' => $options,
	));
?>
<p class="title">
    <a href="<?= $object->getUrl() ?>"
       title="<?= strip_tags($object->getTitle()) ?>"><?= $this->Text->truncate($object->getShortTitle(), $title_truncate_length) ?></a>
</p>