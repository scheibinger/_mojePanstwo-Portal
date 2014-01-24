<div class="dimmed">

    <p class="line signature">
        <?= __d('dane', 'LC_DANE_AGE'); ?>:
        <strong><?= $this->Czas->wiek($object->getData('data_urodzenia')) ?></strong>
    </p>

    <p class="line signature morespace">
        <?= $object->getData('str') ?>
    </p>

</div>