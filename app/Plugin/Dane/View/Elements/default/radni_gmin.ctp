<div class="dimmed">
    <p class="line signature"><?php echo __d('dane', 'LC_DANE_RADNI_GMIN_KOMITET', true) . ': <strong>' . $item['data']['rady_gmin_komitety.nazwa'] . '</strong>'; ?></p>
    <?php if ($item['data']['poparcie']) { ?>
        <p class="line signature"><?php echo __d('dane', 'LC_DANE_RADNI_GMIN_POPARCIE', true) . ': <strong>' . $item['data']['poparcie'] . '</strong>'; ?></p>
    <?php } ?>
    <p class="line signature"><?php echo __d('dane', 'LC_DANE_RADNI_GMIN_VOTES', true) . ': <strong>' . $item['data']['liczba_glosow'] . '</strong>'; ?></p>

    <p class="line signature"><?php echo __d('dane', 'LC_DANE_RADNI_GMIN_POPARCIE', true) . ': <strong>' . $item['data']['procent_glosow_w_okregu'] . ' %</strong>'; ?></p>
    <?php if (isset($item['data']['oswiadczenie_id'])) {
        foreach ($item['data']['oswiadczenie_id'] as &$oswiadczenie) {
            switch ($oswiadczenie) {
                case '1':
                    $oswiadczenie = "Praca";
                    break;
                case '2':
                    $oswiadczenie = "Służba";
                    break;
                case '3':
                    $oswiadczenie = "Współpraca";
                    break;
                case '4':
                    $oswiadczenie = "Brak danych";
                    break;
                default:
                    $oswiadczenie = "Brak danych";
                    break;
            }

        }
        ?>
        <p class="line signature"><?php echo __d('dane', 'LC_DANE_RADNI_GMIN_WSPOLPRACA', true) . ': <strong>' . implode(" &bull; ", $item['data']['oswiadczenie_id']) . '</strong>'; ?></p>
    <?php } ?>
</div>