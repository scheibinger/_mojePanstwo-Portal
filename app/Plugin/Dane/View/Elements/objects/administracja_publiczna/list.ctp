<?
	if( !empty($items) ) {
?>
	<ul>
	<? foreach( $items as $item ) { ?>
		<li>
			<p class="nazwa"><a href="/dane/administracja_publiczna/<?= $item['id'] ?>"><?= $item['nazwa'] ?></a></p>
			<?
				if( isset($item['items']) && !empty($items) )
					echo $this->Element('Dane.objects/administracja_publiczna/list', array(
			    		'items' => $item['items'],
			    	));
		    ?>
		</li>
	<? } ?>
	</ul>	
<?
	}
?>