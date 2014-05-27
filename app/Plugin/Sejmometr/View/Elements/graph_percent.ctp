<div class="detailBlock graph percent <?php echo $page['class'] ?>">
    <h3><?php echo $page['title'] ?></h3>

    <div class="text"><?php echo $page['text'] ?></div>

    <div class="poslowieGraphPercent">
        <ul>
            <?php foreach ($items as $item) { ?>
                <li class="col-xs-6 col-sm-4 col-md-hack-20">
                    <div class="percent"><?php echo $item['percent'] ?>%</div>
                    <div class="job"><?php echo $item['job'] ?></div>
                    <a href="<?php echo $item['more_link'] ?>" target="_self">Zobacz kto</a>
                </li>
            <?php } ?>
        </ul>

        <div class="checkIt text-center">
            <a class="btn btn-primary" href="<?php echo $page['link'] ?>" target="_self">Zobacz całą listę</a>
        </div>
    </div>
</div>