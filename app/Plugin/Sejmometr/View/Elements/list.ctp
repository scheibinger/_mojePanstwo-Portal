<div id="<?= $page['anchor'] ?>" class="detailBlock list <?php echo $page['class'] ?>">
    <h3><?php echo $page['title'] ?></h3>

    <div class="text"><?php echo $page['text'] ?></div>

    <div class="poslowieList">
        <ul>
            <?php foreach ($items as $item) { ?>
                <li class="col-xs-6 col-sm-4 col-md-hack-20">
                <a href="<?= $item['url'] ?>" target="_self">
                        <img class="avatar" src="<?= $item['posel_img_src'] ?>"
                             alt="<?= $item['nazwisko'] . ' ' . $item['imie'] ?>"/>

                        <div class="poselLabel">
                            <?= $item['nazwisko'] . ' ' . $item['imie'] ?>
                            <img class="club" src="<?= $item['klub_img_src'] ?>"
                                 alt="<?php echo $item['klub'] ?>"/>
                        </div>
                        <div class="poselInfo">
                            <?php echo $item['number'] ?> wystąpień <?php /* ADD PLURALIZE */ ?>
                        </div>
                    </a>
                </li>
            <?php } ?>
        </ul>

        <div class="checkIt text-center">
            <a class="btn btn-primary" href="<?php echo $page['link'] ?>" target="_self">Zobacz pełen ranking</a>
        </div>
    </div>
</div>