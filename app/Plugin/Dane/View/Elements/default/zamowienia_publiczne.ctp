<? 
	$status = $object->getStatus();
	$liczba_wykonawcow = count($object->getData('wykonawca_id'));
?>

<div class="row dataHighlights dimmed">
	<div class="dataHighlight col-md-4"><p class="_value" style="padding: 3px 0;"><span class="label label-<?= $status['class'] ?>"><?= $status['nazwa'] ?></span>
</p></div>
	<div class="dataHighlight col-md-4"><p class="_label">Wykonawc<? if( $liczba_wykonawcow > 1 ) { ?>y<? } else { ?>a<? } ?>:<? if( $liczba_wykonawcow > 1 ) { ?> <span class="label label-default"><?= $liczba_wykonawcow ?></span><? } ?></p><p class="_value"><?= $this->Text->truncate($object->getData('wykonawca_str'), 50) ?></p></div>
	<div class="dataHighlight col-md-4"><p class="_label">Cena:</p><p class="_value"><?= _currency($object->getData('wartosc_cena')) ?></p></div>
</div>

<?= $this->Dataobject->highlights($hlFields, $hlFieldsPush )?>

</div>
</div>

<div>
    <div>