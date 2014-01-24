<p class="line signature">
    <?php echo $item['data']['trasa_opis'] ?>
</p>
<p class="line signature">
    <?php echo __d('dane', 'LC_DANE_KOLEJ_LINIE_LICZBA_STACJI', true) . ': <strong>' . $item['data']['liczba_stacji'] . '</strong>'; ?>
</p>
<p class="line signature">
    <?php echo __d('dane', 'LC_DANE_KOLEJ_LINIE_DLUGOSC_KURSU', true) . ': <strong>' . $item['data']['duration'] . ' min</strong>'; ?>
</p>