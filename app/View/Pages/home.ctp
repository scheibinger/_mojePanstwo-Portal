<?php echo $this->Html->css( '../plugins/gridster.js/dist/jquery.gridster.css', array( 'block' => 'cssBlock' ) ); ?>
<?php echo $this->Html->script( '../plugins/gridster.js/dist/jquery.gridster.js', array( 'block' => 'scriptBlock' ) ); ?>

<?php $this->Combinator->add_libs( 'css', $this->Less->css( 'home' ) ) ?>
<?php $this->Combinator->add_libs( 'js', 'home' ) ?>

<div id="home" style="background-image: url('./img/home-background-default.png')">
	<div class="gridster">
		<ul>
			<li data-row="1" data-col="1" data-sizex="1" data-sizey="1">
				<header>|||</header>
			</li>
			<li data-row="2" data-col="1" data-sizex="1" data-sizey="1">
				<header>|||</header>
			</li>
			<li data-row="3" data-col="1" data-sizex="1" data-sizey="1">
				<header>|||</header>
			</li>

			<li data-row="1" data-col="2" data-sizex="2" data-sizey="1">
				<header>|||</header>
			</li>
			<li data-row="2" data-col="2" data-sizex="2" data-sizey="2">
				<header>|||</header>
			</li>
		</ul>
	</div>
	<div class="options">
		<ul>
			<li><a href="#" target="_self">O Portalu</a></li>
			<li><a href="#" target="_self">API</a></li>
			<li><a href="#" target="_self">Regulamin</a></li>
			<li><a href="#" target="_self">Zgłoś błąd</a></li>
			<li class="last"><a href="#" target="_self">Personalizuj</a></li>
		</ul>
	</div>
</div>