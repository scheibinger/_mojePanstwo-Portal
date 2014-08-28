<?
	if( !empty($items) ) {
?>
		<ul<? if(!$i) {?> class="first"<?}?>>
		<? foreach( $items as $item ) { ?>
			<li>
			
				<?
					$tag = 'span';
					if( $i==0 )
						$tag = 'h3';
				?>
				
				<a href="/dane/administracja_publiczna/<?= $item['id'] ?>"><<?= $tag ?>><? if( $item['folder']=='1' ) {?><span class="glyphicon glyphicon-folder-open"></span> <? } ?><?= $item['nazwa'] ?></<?= $tag ?>></a>
				<?
					if( isset($item['items']) && !empty($items) )
						echo $this->Element('Dane.objects/administracja_publiczna/list', array(
				    		'items' => $item['items'],
				    		'i' => $i+1,
				    	));
			    ?>
			</li>
		<? } ?>
		</ul>	
<?
	}
?>