<p class="line signature komitet"><strong><?= $item['data']['rady_gmin_komitety.skrot_nazwy'] ?></strong></p>
<?php if ($item['data']['poparcie']) { ?>
    <p class="line signature"><?php echo __d('dane', 'LC_DANE_RADNI_GMIN_POPARCIE', true) . ': <strong>' . $item['data']['poparcie'] . '</strong>'; ?></p>
<?php } ?>

<p class="line signature"><?php echo __d('dane', 'LC_DANE_RADNI_GMIN_POPARCIE', true) . ': <strong>' . $item['data']['procent_glosow_w_okregu'] . ' %</strong>'; ?></p>
<?php if (isset($item['data']['oswiadczenie_id'])) {
    switch (oswiadczenie_id) {
        case '1':
            $status = "Praca";
            break;
        case '2':
            $status = "Służba";
            break;
        case '3':
            $status = "Współpraca";
            break;
        case '4':
            $status = "Brak danych";
            break;
    }
    ?>
    <p class="line signature"><?php echo __d('dane', 'LC_DANE_RADNI_GMIN_WSPOLPRACA', true) . ': <strong>' . $status . '</strong>'; ?></p>
<?php } ?>