<?

	if($object->getData('krakow_glosowania.wynik_str')) {
	
		$class = 'default';
		if( $object->getData('krakow_glosowania.wynik_id')==1 )
			$class = 'success';
		elseif( $object->getData('krakow_glosowania.wynik_id')==2 )
			$class = 'danger';
				
?>

<div style="padding: 5px;">
	<p class="label label-<?= $class ?>"><?= $object->getData('krakow_glosowania.wynik_str') ?></p>
</div>

<? } ?>