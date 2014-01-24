<div class="dimmed">
    <p class="line signature">
        <?php echo __d('dane', 'LC_DANE_NIK_RAPORTY_PUBLICATION_DATE', true) . ': ' . '<strong>' . $this->Czas->dataSlownie($item['data']['data_publikacji']) . '</strong>'; ?>
    </p>

    <p class="line signature">
        <?php echo __d('dane', 'LC_DANE_NIK_RAPORTY_MODERATE_DATE', true) . ': <strong>' . $this->Czas->dataSlownie($item['data']['data_moderacji']) . '</strong>'; ?>
    </p>
</div>