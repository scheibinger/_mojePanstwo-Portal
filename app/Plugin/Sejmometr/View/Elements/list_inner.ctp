<?
if (isset($items) && !empty($items)) {
    foreach ($items as $item) {
        ?>
        <li class="col-xs-6 col-sm-4 col-md-hack-20">
            <a href="<?= $item['url'] ?>" target="_self">
                <img class="avatar" src="<?= $item['posel_img_src'] ?>"
                     alt="<?= $item['nazwisko'] . ' ' . $item['imie'] ?>"/>

                <div class="poselLabel">
                <span><?= $item['nazwisko'] . ' ' . $item['imie'] ?>
                    <img class="club" src="<?= $item['klub_img_src'] ?>"
                         alt="(<?php echo $item['klub'] ?>)"/>
                    </span>
                </div>
                <div class="poselInfo">
                    <?php echo pl_dopelniacz(5, 'wystąpienie', 'wystąpienia', 'wystąpień'); ?>
                </div>
            </a>
        </li>
    <?
    }
}
?>