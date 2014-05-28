<? if ($group['mode'] == 'stats') { ?>
        
    <? if (isset($type['objects']) && is_array($type['objects']) && !empty($type['objects'])) { ?>
        <ul>
            <?
            $i = 0;
            foreach ($type['objects'] as $object) {
                $i++;
                ?>

                <li class="account">
                    <div class="avatar"><a href="/dane/twitter_accounts/<?= $object['id'] ?>">
                            <img src="<?= $object['profile_image_url'] ?>"/></a></div>
                    <div class="info">
                        <p class="name">
                            <a href="/dane/twitter_accounts/<?= $object['id'] ?>"><?= $object['name'] ?></a>
                        </p>
						
						
						<? if( $group['preset'] == 'accounts-activity' ) { ?>
						
							<p class="counter"><?= number_format($object['count'], 0, '.', ' ') ?></p>
						
						<? } elseif( $group['preset'] == 'accounts-retweet' ) { ?>
						
							<p class="counter"><?= number_format($object['count'], 0, '.', ' ') ?></p>
						
						<? } elseif( $group['preset'] == 'accounts-discussions' ) { ?>
						
							<p class="counter"><?= number_format($object['count'], 0, '.', ' ') ?></p>
						
						<? } elseif( $group['preset'] == 'accounts-mentions' ) { ?>
						
							<p class="counter"><?= number_format($object['count'], 0, '.', ' ') ?></p>
						
						<? } ?>
						
						
						
					
								
						
						
						<? /*
                        <?
                        if ($group['field'] == 'liczba_tweetow_wlasnych_2013') {
                            $per_day = $object->getData($group['field']) / 365;
                            ?>
                            <p class="subcounter"><?= pl_dopelniacz(round($per_day), 'tweet', 'tweety', 'tweetów') . ' ' . __d('media', 'LC_PANSTWOINTERNET_PER_DAY') ?></p>
                        <? } ?>
                        */ ?>
                        
                    </div>
                    
                </li>
                <? if ($i > 10)
                    break;
            }
            ?>
        </ul>
    <? } ?>


<? } elseif ($group['mode'] == 'account') { ?>
    
    
    <? if (isset($type['search']) && is_array($type['search']) && !empty($type['search'])) { ?>
        <ul>
            <?
            $i = 0;
            foreach ($type['search'] as $object) {
                $i++;
                
                if( $object['followers_' . $range] == '0' )
                	break;
                
                ?>

                <li class="account">
                    <div class="avatar"><a href="/dane/twitter_accounts/<?= $object['id'] ?>">
                            <img src="<?= $object['profile_image_url'] ?>"/></a></div>
                    <div class="info">
                        <p class="name">
                            <a href="/dane/twitter_accounts/<?= $object['id'] ?>"><?= $object['name'] ?></a>
                        </p>
						
						
						
                        <p class="counter"><? if( $object['followers_delta_' . $range]>0 ) { echo "+"; }?><?= number_format($object['followers_delta_' . $range], 0, '.', ' ') ?></p>
						
						
						
						
						
						
						
						<? /*
                        <?
                        if ($group['field'] == 'liczba_tweetow_wlasnych_2013') {
                            $per_day = $object->getData($group['field']) / 365;
                            ?>
                            <p class="subcounter"><?= pl_dopelniacz(round($per_day), 'tweet', 'tweety', 'tweetów') . ' ' . __d('media', 'LC_PANSTWOINTERNET_PER_DAY') ?></p>
                        <? } ?>
                        */ ?>
                        
                    </div>
                    <div class="tweet_stats">
                        <div class="row">
                            
                            <div class="col-lg-4">
                            	
                            	<p class="_counter small"><span class="glyphicon glyphicon-unchecked"></span> <?= number_format($object['followers_count'], 0, '.', ' ') ?></p>
                            	
                            </div>
                            
                            <div class="col-lg-4">
								

                                <p class="_counter plus small"><span class="glyphicon glyphicon-log-in"></span> <?= number_format($object['followers_add_' . $range], 0, '.', ' ') ?></p>
									
                            </div>
                            <div class="col-lg-4">

                                <p class="_counter minus small"><?= number_format($object['followers_diff_' . $range], 0, '.', ' ') ?> <span class="glyphicon glyphicon-log-out"></span></p>
	
                            </div>
                        </div>
                    </div>
                </li>
                <? if ($i > 10)
                    break;
            }
            ?>
        </ul>
    <? } ?>

    <?
    $params = array(
        'typ_id' => $type['id'],
    );

    if (@$group['order'])
        $params['order'] = $group['order'];

    if (@$group['link']['order'])
        $params['order'] = $group['link']['order'];

    $href = '/dane/' . $group['link']['dataset'] . '?' . http_build_query($params);
    ?>
	
	<!--
    <div class="buttons">
        <a href="<?= $href ?>">Pełny ranking &raquo;</a>
    </div>
    -->

<? } elseif ($group['mode'] == 'tag') { ?>
    <? if (isset($type['objects']) && is_array($type['objects']) && !empty($type['objects'])) { ?>
        <ul>
            <?
            $i = 0;
            foreach ($type['objects'] as $object) {
                $i++;
                $href = '/dane/twitter/?tags=' . $object['id'] . '&twitter_accounts%3Atyp_id=' . $type['id'];
                ?>
                <li class="list-group-item">
                    <span class="badge"><?= number_format($object['count'], 0, '.', ' ') ?></span>
                    <a href="<?= $href ?>">#<?= $object['tag'] ?></a>
                </li>
                <? if ($i >= 5)
                    break;
            }
            ?>
        </ul>
    <? } ?>
<? } elseif ($group['mode'] == 'url') { ?>
    <? if (isset($type['objects']) && is_array($type['objects']) && !empty($type['objects'])) { ?>
        <ul>
            <?
            $i = 0;
            foreach ($type['objects'] as $object) {
                $i++;

                $object['title'] = $object['url'];

                if (stripos($object['title'], 'http://') === 0)
                    $object['title'] = substr($object['title'], 7);

                if (stripos($object['title'], 'https://') === 0)
                    $object['title'] = substr($object['title'], 8);

                if (stripos($object['title'], 'www.') === 0)
                    $object['title'] = substr($object['title'], 4);

                ?>

                <li class="list-group-item">
                    <span class="badge"><?= number_format($object['count'], 0, '.', ' ') ?></span>
                    <a href="<?= $object['url'] ?>" title="<?= $object['title'] ?>"
                       target="_blank"><?= substr($object['title'], 0, 26) ?><? if (strlen($object['title']) > 26) { ?>...<? } ?></a>
                </li>
                <?
                if ($i >= 10)
                    break;
            }
            ?>

        </ul>

    <? } ?>

<? } elseif ($group['mode'] == 'source') { ?>


    <? if (isset($type['objects']) && is_array($type['objects']) && !empty($type['objects'])) { ?>
        <ul>

            <?
            $i = 0;
            foreach ($type['objects'] as $object) {
                $i++;



                ?>

                <li class="list-group-item">

                    <span class="badge"><?= number_format($object['count'], 0, '.', ' ') ?></span>
                    <?= strip_tags($object['name']) ?>

                </li>

                <?
                if ($i >= 10)
                    break;
            }
            ?>

        </ul>

    <? } ?>

<? } elseif ($group['mode'] == 'tweet') { ?>

    <? if (isset($type['objects']) && is_array($type['objects']) && !empty($type['objects'])) { ?>
        <ul>

            <?
            $i = 0;
            foreach ($type['objects'] as $object) {
                $i++;
                ?>

                <li class="tweet" tweet_id="<?= $object->getId() ?>">

                    <div class="tweet_header">
                        <div class="avatar">
                            <p>
                                <img src="<?= $object->getData('twitter_accounts.profile_image_url') ?>"/>
                            </p>
                        </div>
                        <div class="data">

                            <p class="date"><?= $this->Czas->dataSlownie($object->getData('czas_utworzenia')) ?> <?= substr($object->getData('czas_utworzenia'), 11, 5) ?></p>

                            <p class="account"><a href="/dane/twitter_accounts/<?= $object->getData('twitter_accounts.id') ?>"><?= $object->getData('twitter_accounts.name') ?></a></p>

                        </div>
                    </div>

                    <div class="tweet_content">
                        <p><?= $object->getData('html'); ?></p>
                    </div>

                    <div class="tweet_stats">
                        <div class="row">
                            <div class="col-lg-6">
								

                                <p class="_counter"><a href="/dane/twitter/<?= $object->getId() ?>"><span class="glyphicon glyphicon-retweet"></span> <?= number_format($object->getData('liczba_retweetow'), 0, '.', ' ') ?></a></p>
								
                                <? /*<p class="_label"><?= __d('media', 'LC_PANSTWOINTERNET_RETWEET') ?></p> */ ?>

                            </div>
                            <div class="col-lg-6">

                                <p class="_counter"><a href="/dane/twitter/<?= $object->getId() ?>"><span class="glyphicon glyphicon-transfer"></span> <?= $object->getData('liczba_odpowiedzi') ?></a></p>

                                <? /*<p class="_label"><?= __d('media', 'LC_PANSTWOINTERNET_ODPOWIEDZI') ?></p> */ ?>

                            </div>
                        </div>
                    </div>

                </li>


                <?
                if ($i > 10)
                    break;
            }
            ?>

        </ul>

    <? } ?>

    <?
    $params = array(
        'twitter_accounts:typ_id' => $type['id'],
    );

    if (@$group['order'])
        $params['order'] = $group['order'];

    if (@$group['link']['order'])
        $params['order'] = $group['link']['order'];

    $href = '/dane/' . $group['link']['dataset'] . '?' . http_build_query($params);
    ?>
	
	<? /*
    <div class="buttons">
        <a href="<?= $href ?>"><?= __d('media', 'LC_PANSTWOINTERNET_RANKING') ?></a>
    </div>
    */ ?>

<? } ?>