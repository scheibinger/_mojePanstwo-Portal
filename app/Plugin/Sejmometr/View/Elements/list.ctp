<div class="detailBlock list <?php echo $page['class'] ?>">
    <h3><?php echo $page['title'] ?></h3>

    <p class="text"><?php echo $page['text'] ?></p>

    <div class="poslowieList">
        <ul>
            <?php foreach ($items as $item) { ?>
                <li class="col-xs-6 col-sm-4 col-md-3 col-lg-2">
                    <a href="http://mojepanstwo.pl/dane/poslowie/<?php echo $item['posel_id'] ?>" target="_self">
                        <img class="avatar" src="<?php echo $item['posel_img'] ?>"
                             alt="<?php echo $item['posel_name'] ?>"/>

                        <div class="poselLabel">
                            <?php echo $item['posel_name'] ?>
                            <img class="club" src="<?php echo $item['icon_src'] ?>"
                                 alt="<?php echo $item['icon_name'] ?>"/>
                        </div>
                        <div class="poselInfo">
                            <?php echo $item['number'] ?> wystąpień <?php /* ADD PLURALIZE */ ?>
                        </div>
                    </a>
                </li>
            <?php } ?>
        </ul>

        <div class="checkIt text-center">
            <a class="btn btn-primary btn-lg" href="<?php echo $page['link'] ?>" target="_self">Zobacz pełen ranking</a>
        </div>
    </div>
</div>