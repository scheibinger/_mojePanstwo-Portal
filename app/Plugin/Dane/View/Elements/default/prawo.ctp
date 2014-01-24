<div class="dimmed">

    <p class="line signature">
        <?php echo __d('dane', 'LC_DANE_PRAWO_SIGNATURE', true) . ': <strong>' . $item['data']['sygnatura'] . '</strong>'; ?>
    </p>


    <?php if (isset($item['data']['data_publikacji'])) { ?>
        <p class="line signature">
            <?php echo __d('dane', 'LC_DANE_PRAWO_PUBLISHED', true) . ': ' . '<strong>' . $this->Czas->dataSlownie($item['data']['data_publikacji']) . '</strong>'; ?>
        </p>
    <?php } ?>


    <?php if (isset($item['data']['data_wejscia_w_zycie'])) { ?>
        <p class="line signature">
            <?php echo __d('dane', 'LC_DANE_PRAWO_DATE_OF_ENTRY', true) . ': ' . '<strong>' . $this->Czas->dataSlownie($item['data']['data_wejscia_w_zycie']) . '</strong>'; ?>
        </p>
    <?php } ?>

</div>