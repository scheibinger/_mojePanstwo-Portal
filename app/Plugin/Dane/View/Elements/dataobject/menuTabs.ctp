<ul class="nav nav-tabs" style="margin-bottom: 15px;">
<?
	foreach( $menu['items'] as $m ) {
?>
	<li<? if( $m['id'] == $menu['selected'] ){?> class="active"<?}?>><a href="<?= $m['href'] ?>"><?= $m['label'] ?></a></li>
<?
	}
?>
</ul>