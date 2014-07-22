<?php $this->Combinator->add_libs('css', $this->Less->css('prawo', array('plugin' => 'Prawo'))) ?>
<?php $this->Combinator->add_libs('js', 'Prawo.prawo.js') ?>

<div id="prawo">

	<div class="content row col-xs-12">
		<div id="tagsDiv" class="col-md-3 pull-left">
			
			<div class="input-group">
				<input id="tagsSearchInput" class="form-control" type="text" placeholder="Szukaj w tematach">
				<span class="input-group-btn">
					<button class="btn btn-default btn-primary" type="button">
						<span class="glyphicon glyphicon-search"></span>
					</button>
				</span>
			</div>
			
			<ul class="nav nav-pills nav-stacked">
				<? foreach( $tags as $tag ) {?>
				<li>
					<a href="#"><?= $tag['q'] ?> <span class="badge"><?= $tag['liczba_aktow'] ?></span></a>
				</li>
				<? } ?>
			</ul>
		
		</div>
		<div id="displayDiv" class="col-md-9 pull-right">
		
			RIGHT
		
		</div>
</div>