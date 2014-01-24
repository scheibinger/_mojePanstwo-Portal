<?php $this->Combinator->add_libs('css', $this->Less->css('view-krspodmioty', array('plugin' => 'Dane'))); ?>

<?= $this->Element('dataobject/pageBegin'); ?>

    <h1>Jedyny akcjonariusz</h1>

<?
$items = $object->getLayer('jedynyAkcjonariusz');
if (count($items)) {
    ?>
    <ul class="stdUl">
        <? foreach ($items as $item) { ?>

            <li>
                <h2 class="title"><?= $item['nazwa'] ?></h2>

                <p class="details"><?= $item['krs'] ?></p>
            </li>

        <? } ?>
    </ul>
<?
}
?>



<?= $this->Element('dataobject/pageEnd'); ?>