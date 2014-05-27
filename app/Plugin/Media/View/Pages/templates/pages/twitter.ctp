<div id="twitter" class="chapter">
    
    <? /*
    <div class="col-md-12 header-row">
        <div class="container">
            <h2><?= __d('media', 'LC_PANSTWOINTERNET_TWITTER_HEADLINE') ?></h2>
        </div>
    </div>
    */ ?>

    <div id="twitter" class="container innerContent">
        
        <? /*
        <div class="col-md-12">
            <div class="desc">
                <p><?= __d('media', 'LC_PANSTWOINTERNET_TWITTER_TOPIC') ?></p>
            </div>
        </div>
        */ ?>
		
		<div class="range text-center">
			<ul class="pagination">
				<li<? if( $range == '24h' ){?> class="active" <?}?>><a href="?range=24h">24h</a></li>
				<li<? if( $range == '3d' ){?> class="active" <?}?>><a href="?range=3d">3d</a></li>
				<li<? if( $range == '7d' ){?> class="active" <?}?>><a href="?range=7d">7d</a></li>
				<li<? if( $range == '1m' ){?> class="active" <?}?>><a href="?range=1m">1m</a></li>
				<li<? if( $range == '1y' ){?> class="active" <?}?>><a href="?range=1y">1y</a></li>
			</ul>
		</div>
		
        <div class="ranks">
            <? foreach ($ranks as $rank) { ?>
                <div id="twitter-<?= $rank['name'] ?>" class="rank-row-block">
                    <h3><?= $rank['title'] ?></h3>
                    <? foreach ($rank['groups'] as $group) { ?>
                        <? if (isset($group['desc'])) { ?>
                            <p class="desc"><?= $group['desc'] ?></p>
                        <? } ?>
                        <? include('twitter/row.ctp'); ?>
                    <? } ?>
                </div>
            <? } ?>
        </div>
    </div>
</div>