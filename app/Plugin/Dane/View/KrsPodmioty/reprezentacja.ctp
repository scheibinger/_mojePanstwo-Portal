<?php $this->Combinator->add_libs('css', $this->Less->css('view-krspodmioty', array('plugin' => 'Dane'))); ?>

<?= $this->Element('dataobject/pageBegin'); ?>

    <h1><?= _ucfirst($object->getData('nazwa_organu_reprezentacji')) ?></h1>

<?
$items = $object->getLayer('reprezentacja');
if (count($items)) {
    ?>
    <ul class="stdUl">
        <? foreach ($items as $item) { ?>

            <li>
                <p class="title"><?= $item['nazwa'] ?></p>

                <p class="subtitle"><?= $item['funkcja'] ?></p>
            </li>

        <? } ?>
    </ul>
<?
}
?>



<?= $this->Element('dataobject/pageEnd'); ?>