<p class="header-a">
<? if( $object->getData('twitter_account_id') ) {?>
	<a href="/dane/twitter_accounts/<?= $object->getData('twitter_account_id') ?>"><b><?= $object->getData('twitter_accounts.name') ?></b></a> <span class="label label-<?= $object->getAccountTypeClass() ?>"><?= $object->getAccountTypeName() ?></span>
<?} else {?>
	<a target="_blank" href="https://twitter.com/<?= $object->getData('twitter_user_screenname') ?>"><b><?= $object->getData('twitter_user_name') ?></b></a>
<?}?>
</p>

<blockquote class="_">
    <?= $object->getData('html') ?>
</blockquote>

</div>
</div>

<div>
    <div>