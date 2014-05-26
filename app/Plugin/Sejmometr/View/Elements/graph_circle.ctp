<div class="detailBlock graph circle <?php echo $page['class'] ?>">
    <h3><?php echo $page['title'] ?></h3>

    <p class="text"><?php echo $page['text'] ?></p>

    <div class="poslowieGraphCircle">
        <ul>
            <?php foreach ($items as $item) { ?>
                <li class="col-xs-6 col-sm-4 col-md-hack-20">
                    <div class="graph" data-title="<?php echo $item['title'] ?>"
                         data-setup='<?php echo json_encode($item["setup"]) ?>'></div>
                    <div class="setup">
                        <div class="men"></div>
                        <div class="women"></div>
                    </div>
                </li>
            <?php } ?>
        </ul>

        <div class="checkIt text-center">
            <a class="btn btn-primary btn-lg" href="<?php echo $page['link'] ?>" target="_self">Pokaż całość</a>
        </div>
    </div>
</div>
