<?php $this->Combinator->add_libs('css', $this->Less->css('view-krspodmioty', array('plugin' => 'Dane'))); ?>

<?= $this->Element('dataobject/pageBegin'); ?>

    <h1>Zmiany umów</h1>

<?
$items = $object->getLayer('zmianyUmow');
if (count($items)) {
    ?>
    <ul class="stdUl txt">
        <? foreach ($items as $item) { ?>

            <li>
                <p class="title"><?= $item['nazwa'] ?></p>
            </li>

        <? } ?>
    </ul>
<?
}
?>



<?= $this->Element('dataobject/pageEnd'); ?>