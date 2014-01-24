<p class="line signature">
    <?php echo 'Data wytowrzenia: ' . '<strong>' . $this->Czas->dataSlownie($item['data']['data']) . '</strong>'; ?>
</p>

<p class="line signature">
    <?php echo __d('dane', 'LC_DANE_SEJM_DRUKI_DOCUMENT_TYPE', true) . ': <strong>' . $item['data']['druk_typ_nazwa'] . '</strong>'; ?>
</p>
