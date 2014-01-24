<?php $this->Combinator->add_libs('css', $this->Less->css('view-krspodmioty', array('plugin' => 'Dane'))); ?>

<?= $this->Element('dataobject/pageBegin'); ?>

    <h1>Emisje akcji</h1>

<?
$items = $object->getLayer('emisjeAkcji');
if (count($items)) {
    ?>
    <ul class="stdUl">
        <? foreach ($items as $item) { ?>

            <li>
                <p class="title">
                    <small>Seria:</small> <?= $item['seria'] ?>
                    <small>, liczba akcji:</small> <?= $item['liczba'] ?></p>
                <p class="details"><?= $item['rodzaj_uprzywilejowania'] ?></p>
            </li>

        <? } ?>
    </ul>
<?
}
?>



<?= $this->Element('dataobject/pageEnd'); ?>