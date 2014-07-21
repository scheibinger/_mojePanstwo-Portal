<?php foreach ($items as $item) { ?>
    <li class="col-xs-6 col-sm-4 col-md-hack-20">
        <div class="percent"><?php echo $item['percent'] ?>%</div>
        <div class="job"><?php echo $item['job'] ?></div>
        <a href="<?php echo $item['more_link'] ?>" target="_self">Zobacz kto</a>
    </li>
<?php } ?>