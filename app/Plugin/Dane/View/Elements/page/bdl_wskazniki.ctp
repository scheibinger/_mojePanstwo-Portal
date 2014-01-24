<p class="line signature">
    <?php echo __d('dane', 'LC_DANE_CATEGORY', true); ?>:
    <a href="/dane/bdl_wskazniki?f_kategoria_id[]=<?php echo $item['data']['kategoria_id'] ?>">
        <strong><?php echo $item['data']['kategoria_tytul'] ?></strong>
    </a>
</p>

<p class="line signature">
    <?php echo __d('dane', 'LC_DANE_GROUP', true); ?>:
    <a href="/dane/bdl_wskazniki?f_kategoria_id[]=<?php echo $item['data']['kategoria_id'] ?>&f_grupa_id[]=<?php echo $item['data']['grupa_id'] ?>">
        <strong><?php echo $item['data']['grupa_tytul'] ?></strong>
    </a>
</p>

<p class="line signature">
    <?php echo __d('dane', 'LC_DANE_BDL_WSKAZNIKI_DATE_DETAILS', true); ?>:
    <strong><?php echo $item['data']['poziom_str'] ?></strong>
</p>