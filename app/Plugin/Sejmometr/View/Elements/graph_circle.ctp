<div id="<?= $page['anchor'] ?>" class="detailBlock graph circle <?php echo $page['class'] ?>">
    <h3><?php echo $page['title'] ?></h3>

    <p class="text"><?php echo $page['text'] ?></p>

    <div class="poslowieGraphCircle">
        <ul>
            <?php foreach ($items as $item) { ?>
                <li class="col-xs-6 col-sm-4 col-md-hack-20">
                    <div class="graphTitle"><?php echo $item['title'] ?></div>
                    <div class="graph">
                        <div class="graphLogo">
                            <img src="<?php echo $item['img_src']; ?>" alt="<?php echo $item['title'] ?>"/>
                        </div>
                        <div class="graphInner" data-setup='<?php echo json_encode($item["setup"]) ?>'></div>
                    </div>
                    <div class="split">
                        <div class="part men"><?php echo $item['setup'][0][1]; ?>%</div>
                        <div class="part women"><?php echo $item['setup'][1][1]; ?>%</div>
                    </div>
                </li>
            <?php } ?>
        </ul>

        <div class="checkIt text-center">
            <a class="btn btn-primary" href="<?php echo $page['link'] ?>" target="_self">Pokaż całość</a>
        </div>
    </div>
</div>
