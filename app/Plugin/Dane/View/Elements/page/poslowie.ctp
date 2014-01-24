<p class="subtitle"><?= $this->Czas->wiek($item['data']['data_urodzenia']) ?>, <?= $item['data']['zawod'] ?></p>

<div class="row">

    <?php if ($item['data']['klub_id'] != '7') { ?>
        <div class="col-lg-2">
            <p class="line club">
                <a href="/dane/sejm_kluby/<?php echo $item['data']['klub_id'] ?>"<?php if (isset($item['data']['sejm_kluby.nazwa'])) { ?> title="<?= $item['data']['sejm_kluby.nazwa'] ?>"<?php } ?>>
                    <img
                        src="http://resources.sejmometr.pl/s_kluby/<?php echo $item['data']['klub_id'] ?>_a_t.png"<?php if (isset($item['data']['sejm_kluby.nazwa'])) { ?>
                        alt="<?php if (isset($item['data']['sejm_kluby.nazwa'])) {
                            echo $item['data']['sejm_kluby.nazwa'];
                        } else ' ';
                        }; ?>"/>
                </a>
            </p>
        </div>
    <?php } ?>

    <?php
    if (isset($item['layers']['posiedzenia_poslowie'])) {
        ?>
        <div class="col-lg-5">
            <p class="line signature"><?php echo __d('dane', 'LC_DANE_POSLOWIE_ATTENDANCE', true) . ': <strong>' . $item['layers']['posiedzenia_poslowie']['frekwencja'] . ' %</strong>'; ?></p>

            <p class="line signature"><?php echo __d('dane', 'LC_DANE_POSLOWIE_ABANDONED_VOTING', true) . ': <strong>' . $item['layers']['posiedzenia_poslowie']['ilosc_opuszczonych_glosow'] . '</strong>'; ?></p>
        </div>

        <div class="col-lg-5">
            <p class="line signature"><?php echo __d('dane', 'LC_DANE_POSLOWIE_AMOUNT_MUTINIES', true) . ': <strong>' . $item['layers']['posiedzenia_poslowie']['ilosc_buntow'] . '</strong>'; ?></p>
        </div>
    <?
    } else {
        ?>


        <div class="col-lg-5">
            <p class="line signature"><?php echo __d('dane', 'LC_DANE_POSLOWIE_VOTING_ATTENDENCE', true) . ': <strong>' . $item['data']['frekwencja'] . ' %</strong>'; ?></p>

            <p class="line signature"><?php echo __d('dane', 'LC_DANE_POSLOWIE_REBELS', true) . ': <strong>' . $item['data']['zbuntowanie'] . ' %</strong>'; ?></p>
        </div>

        <div class="col-lg-5">
            <p class="line signature"><?php echo __d('dane', 'LC_DANE_POSLOWIE_AMOUNT_PERFORMANCES', true) . ': <strong>' . $item['data']['liczba_wypowiedzi'] . '</strong>'; ?></p>

            <p class="line signature"><?php echo __d('dane', 'LC_DANE_POSLOWIE_AMOUNT_BILLS', true) . ': <strong>' . $item['data']['liczba_projektow_ustaw'] . '</strong>'; ?></p>
        </div>
    <?php } ?>

</div>