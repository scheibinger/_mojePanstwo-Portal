<?php if ($item['data']['liczba_wystapien']) { ?>
    <p class="line signature">
        <img
            src="http://resources.sejmometr.pl/stenogramy/punkty/<?php echo $item['data']['id'] ?>.jpg"/>
    </p>
<?php } ?>
<p class="line">
    <?php echo $item['data']['stats_str'] ?>
</p>
<?php if ($item['data']['opis']) { ?>
    <p class="line desc"><?php echo $item['data']['opis'] ?></p>
<?php } ?>
