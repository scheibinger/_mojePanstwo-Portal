<?
	if( !empty($projekty) ) {
?>
	<ul>
<?
		foreach( $projekty as $projekt ) {
?>
		<li>
		
			<p class="title"><a href="/dane/prawo_projekty/<?= $projekt['id'] ?>"><?= $projekt['tytul'] ?></a></p>
			<p class="desc"><?= $projekt['opis'] ?></p>
		
		</li>	
<?
		}
?>
	</ul>
<?
	}
?>