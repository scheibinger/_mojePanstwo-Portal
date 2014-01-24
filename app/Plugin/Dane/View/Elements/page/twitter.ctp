<? // debug($object->getData()); ?>

<h1>
    <?php echo $item['data']['html'] ?>
</h1>


<div class="buttons_div dimmed">
    <div class="row">

        <? /*
		
	    <div class="col-md-2 button_div">
		    
		    <a target="_blank" href="https://twitter.com/<?= $object->getData('twitter_accounts.twitter_name') ?>/status/<?= $object->getData('twitt_id') ?>">Źródło</a>
	    
	    </div>
	    <div class="col-md-2 button_div details">
	    
	    	<a href="/dane/twitter/<?= $object->getId() ?>">Szczegóły</a>
	    
	    </div>
	    <? if( $object->getData('in_reply_to_tweet_id') ) {?>
	    <div class="col-md-2 button_div">
	    
	    	<a href="/dane/twitter/<?= $object->getData('in_reply_to_tweet_id') ?>">Dyskusja</a>
	    
	    
	    </div>
	    <? }?>
	    <? */
        ?>

        <? if ($object->getData('liczba_retweetow')) { ?>
            <div class="col-md-2 button_div">

                <?= pl_dopelniacz($object->getData('liczba_retweetow'), 'retweet', 'retweety', 'retweetów') ?>

            </div>
        <? } ?>

        <? if ($object->getData('liczba_odpowiedzi')) { ?>
            <div class="col-md-2 button_div">

                <?= pl_dopelniacz($object->getData('liczba_odpowiedzi'), 'odpowiedź', 'odpowiedzi', 'odpowiedzi') ?>

            </div>
        <? } ?>

    </div>
</div>


