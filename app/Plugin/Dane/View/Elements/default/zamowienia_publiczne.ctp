<? $status = $object->getStatus(); ?>

<div class="row dataHighlights dimmed">
	<div class="dataHighlight col-md-4"><p class="_value"><span class="label label-<?= $status['class'] ?>"><?= $status['nazwa'] ?></span>
</p></div>
	<div class="dataHighlight col-md-4"><p class="_label">Wykonawca:</p><p class="_value"><?= $object->getData('wykonawca_str') ?></p></div>
	<div class="dataHighlight col-md-4"><p class="_label">Cena:</p><p class="_value"><?= _currency($object->getData('wartosc_cena')) ?></p></div>
</div>

<?= $this->Dataobject->highlights($hlFields, $hlFieldsPush )?>

</div>
</div>

<div>
    <div>