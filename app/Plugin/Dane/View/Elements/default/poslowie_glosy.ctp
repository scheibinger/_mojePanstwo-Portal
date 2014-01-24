<div class="row">
    <div class="col-md-8">
        <p>
            <?php if ($item['data']['klub_id'] != '7') { ?>
            <a href="/dane/sejm_kluby/<?php echo $item['data']['klub_id'] ?>"<?php if (isset($item['data']['sejm_kluby.nazwa'])) { ?> title="<?php echo $item['data']['sejm_kluby.nazwa'] ?>"<?php } ?>>
                <img
                    src="http://resources.sejmometr.pl/s_kluby/<?php echo $item['data']['klub_id'] ?>_a_t.png"
                    alt="<?php if (isset($item['data']['sejm_kluby.nazwa'])) {
                        echo $item['data']['sejm_kluby.nazwa'];
                    } else ' ';
                    }; ?>"/>
            </a>

            <span><?= $object->getData('poslowie.nazwa') ?></span>
        </p>

        <p class="line">
            <a href="/dane/sejm_glosowania/<?= $object->getData('sejm_glosowania.id'); ?>">
                <?= $object->getData('sejm_glosowania.tytul'); ?>
            </a>
        </p>
    </div>
    <div class="col-md-4">
        <?php
        $class = null;
        $label = null;
        switch ($object->getData('glos_id')) {
            case 2:
                $class = 'danger';
                $label = __d('dane', 'LC_DANE_GLOSY_PRZECIW');
                break;
            case 1:
                $class = 'success';
                $label = __d('dane', 'LC_DANE_GLOSY_ZA');
                break;
            case 3:
                $class = 'disabled';
                $label = __d('dane', 'LC_DANE_GLOSY_WSTRZYMAL_SIE');
                break;
            case 4:
                $class = 'warning';
                $label = __d('dane', 'LC_DANE_GLOSY_NIEOBECNY');
                break;
        }
        ?>
        <button class="btn btn-large btn-<?php echo $class; ?> pull-right"><?php echo $label; ?></button>
    </div>
</div>