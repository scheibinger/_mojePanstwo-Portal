<p class="line signature"><?php echo __d('dane', 'LC_DANE_GMINA', true) . ': '; ?>
    <a href="/dane/gminy/<?php echo $item['data']['gminy.id'] ?>">
        <strong><?php echo $item['data']['gminy.nazwa'] ?></strong>
    </a>

</p>

<p class="line signature"><?php echo __d('dane', 'LC_DANE_RADNI_GMIN_DEBATY_NUMER_POSIEDZENIA', true) . ': '; ?>
    <a href="/dane/rady_posiedzenia/<?php echo $item['data']['rady_gmin_posiedzenia.id'] ?>">
        <strong><?php echo $item['data']['rady_gmin_posiedzenia.numer'] ?></strong>
    </a>
</p>

<p class="line signature"><?php echo __d('dane', 'LC_DANE_RADNI_GMIN_DEBATY_NUMER_PUNKTU', true) . ': <strong>' . $item['data']['numer_punktu'] . '</strong>'; ?></p>
<?php if ($item['data']['opis'] !== '') { ?>
    <p class="line signature">
        <?php echo String::truncate($item['data']['opis'], 200, array('html' => true)); ?>
    </p>
<?php } ?>