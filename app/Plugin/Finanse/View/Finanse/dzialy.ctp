<?php $this->Combinator->add_libs('css', $this->Less->css('sections', array('plugin' => 'Finanse'))) ?>
<?php $this->Combinator->add_libs('js', 'Finanse.dzialy.js') ?>

<?/*
<?php $this->Combinator->add_libs('css', $this->Less->css('dataobject', array('plugin' => 'Dane'))) ?>
<?php $this->Combinator->add_libs('css', $this->Less->css('dataobjectslider', array('plugin' => 'Dane'))) ?>
<?php $this->Combinator->add_libs('css', $this->Less->css('zamowienia', array('plugin' => 'ZamowieniaPubliczne'))) ?>

<?php $this->Combinator->add_libs('js', '../plugins/highstock/js/highstock'); ?>
<?php $this->Combinator->add_libs('js', '../plugins/highstock/locals'); ?>
<?php $this->Combinator->add_libs('js', 'ZamowieniaPubliczne.zamowieniapubliczne') ?>
*/

$this->Combinator->add_libs('js', 'Finanse.dzialy.js');
?>

<div class="container">
	
	<div class="row">
		<div class="col-md-12">
		
			<h1 class="pull-left">Wydatki gmin w Polsce</h1>
			
			<? /*
			<div class="range text-center pull-right">
		        <ul class="pagination">
		            <li class="active"><a href="?range=24h">Q2 2014</a></li>
		            <li><a href="?range=3d">Q1 2014</a></li>
		        </ul>
		    </div>
		    */?>
		    
		</div>
	</div>
	
	
	<div class="col-md-10 col-md-offset-1 text-center">
		<div class="row banner">
			
			<p>W drugim kwartale 2014 r. polskie gminy wydały:</p>
			<p class="number"><?= $this->Waluta->slownie( $data['stats']['sum'] ) ?></p>
						
		</div>
	</div>
	
	
	<div class="col-md-8 col-md-offset-2 text-center">
		<div class="row teryt">
			
			<p>Poniżej widzisz wydatki gmin, według kategorii budżetowych. Możesz też sprawdzić wydatki swojej gminy i zobaczyć je w kontekście wydatków innych gmin, o podobnej liczbie mieszkańców.</p>
			
			<div class="form-group">
				<div class="col-md-8 col-md-offset-2">
					<div class="input-group">
						<input id="teryt_search_input" class="form-control" type="text" placeholder="Szukaj gminy...">
						<span class="input-group-btn">
							<input type="submit" class="btn btn-primary btn-default" value="Szukaj" />
						</span>
					</div>
				</div>
			</div>
						
		</div>
	</div>
	
	
	
			
			
			
			
			
	
	
	<div class="mpanel" id="sections">
		
		<ul id="sections">
		<? foreach( $data['sections'] as $section ) {?>
						
			<li class="section" data-id="<?= $section['id'] ?>">
				
				<div class="row">
					<div class="col-md-2 text-right icon">
						<img src="/finanse/img/sections/<?= $section['id'] ?>.svg" />
					</div>
					
					<div class="col-md-10">
					
						<div class="row row-header">
							<div class="col-md-12">
								
								<div class="col-md-10">
							
									<h3 class="name"><?= $section['nazwa'] ?></h3>
									
									<? /*
									<p class="desc_switcher"><a class="switcher" data-target="<?= $section['dzial.id'] ?>" href="#" onclick="return false;">Więcej &raquo;</a></p>
									<p id="switcher<?= $section['dzial.id'] ?>" class="desc" style="display: none;"><?= $section['dzial.opis'] ?></p>
									*/ ?>
									
								</div>
								<div class="col-md-2 text-center">
									<p class="value"><?= number_format_h( $section['sum_section'] ) ?></p>
								</div>
							</div>
						</div>
						
						<div class="gradient_cont">
							<p class="gradient"></p>
							<ul class="addons">
								<li class="min" style="left: 0;"><p><span class="n"><?= $section['min_nazwa'] ?></span><br/><span class="v"><?= _number($section['min']) ?></span></p></li>
								<li class="max" style="left: 100%;"><p><span class="n"><?= $section['max_nazwa'] ?></span><br/><span class="v"><?= _number($section['max']) ?></span></p></li>
							</ul>
						</div>
					
					</div>
				</div>

				
			</li>
		
		<? } ?>
		</ul>
		
	</div>
</div>