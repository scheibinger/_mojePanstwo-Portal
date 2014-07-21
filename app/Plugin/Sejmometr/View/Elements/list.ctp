<div id="<?= $page['anchor'] ?>" class="detailBlock list <?php echo $page['class'] ?>">
    <h3><?php echo $page['title'] ?></h3>

    <div class="text"><?php echo $page['text'] ?></div>

    <div class="poslowieList">
        <ul>
            <?php foreach ($items as $item) { ?>
                <li class="col-xs-6 col-sm-4 col-md-hack-20">
                	<div class="a_cont">
		                <a href="<?= $item['url'] ?><?if( isset($page['item_path']) ){?>/<?= $page['item_path'] ?><?}?>" target="_self">
			                <img class="avatar" src="<?= $item['posel_img_src'] ?>" alt="<?= $item['nazwisko'] . ' ' . $item['imie'] ?>"/>
							
							<div class="poselInfo">
			                    <?php echo $item['display'] ?>
			                </div>
		                </a>
		                <a href="<?= $item['url'] ?>" target="_self">
	                        <div class="poselLabel">
	                            <span><?= $item['nazwisko'] . ' ' . $item['imie'] ?>
                                    <? if( $item['klub_id']!='7' ) {?>
	                            <img class="club" src="<?= $item['klub_img_src'] ?>"
	                                 alt="<?php echo $item['klub'] ?>"/>
                                    <? } ?></span>
                            </div>
		                </a>
                	</div>
                </li>
            <?php } ?>
        </ul>

        <div class="checkIt text-center">
            <a class="btn btn-primary" href="<?php echo $page['link'] ?>" target="_self">Zobacz pełen ranking</a>
        </div>
    </div>
</div>