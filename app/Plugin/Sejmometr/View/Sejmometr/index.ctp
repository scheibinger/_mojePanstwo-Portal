<?php $this->Combinator->add_libs('css', $this->Less->css('dataobject', array('plugin' => 'Dane'))) ?>
<?php $this->Combinator->add_libs('css', $this->Less->css('dataobjectslider', array('plugin' => 'Dane'))) ?>
<?php $this->Combinator->add_libs('css', $this->Less->css('sejmometr', array('plugin' => 'Sejmometr'))) ?>

<?php $this->Combinator->add_libs('js', 'highcharts/highcharts'); ?>
<?php $this->Combinator->add_libs('js', 'highcharts/locals'); ?>

<?php $this->Combinator->add_libs('js', 'Sejmometr.sejmometr.js'); ?>


<?php echo $this->Html->script('timelinejs/storyjs-embed.js', array('block' => 'scriptBlock')); ?>




    <div id="sejmometr">

        <div class="innerContent">
            <div class="col-xs-12 col-sm-8 col-sm-offset-2">

                <form class="searchInput" action="/sejmometr/szukaj">
                    <div class="input-group main_input">
                        <input name="q" value="" type="text" autocomplete="off"
                               placeholder="Szukaj w pracach Sejmu..."
                               class="form-control input-lg">
	                <span class="input-group-btn">
	                      <button class="btn btn-success btn-lg" type="submit" data-icon="&#xe600;"></button>
	                </span>
                    </div>
                </form>

                <div id="shortcuts">
                    <ul>
                        <li>
                            <a href="/dane/legislacja_projekty_ustaw">Projekty ustaw</a>
                        </li>
                        <li>
                            <a href="/dane/sejm_druki">Druki sejmowe</a>
                        </li>
                        <li>
                            <a href="/dane/poslowie" target="_self">Posłowie</a>
                        </li>
                        <li>
                            <a href="/dane/sejm_kluby" target="_self">Kluby parlamentarne</a>
                        </li>
                        <li>
                            <a href="/dane/sejm_interpelacje" target="_self">Interpelacje</a>
                        </li>
                    </ul>
                </div>

            </div>
        </div>
		
		<div class="mpanel">
	        <div class="container">
	            <div class="posiedzenie">
	                <div class="row">
	                    <h2><a href="/sejm_posiedzenia">Posiedzenia Sejmu</a></h2>
	                </div>
	            </div>
	        </div>
		</div>

        <div id="timeline-embed" data-source="1"></div>

		
		<div class="mpanel">
			<div class="container">

	            <div class="dataobjectsSliderRow">
	
	                <div class="row header">
	                    <div class="col-xs-12 col-sm-8 left">
	                        <h2>
	                            <a href="#">Najnowsze projekty ustaw</a>
	                        </h2>
	                    </div>
	                    <div class="col-xs-4 col-xs-offset-4 col-sm-4 col-sm-offset-0 right"></div>
	                </div>
	
	                <div class="blockContent">
	                    <?
	                    $group = $posiedzenie->getRelatedGroup('przyjete_ustawy');
	                    echo $this->dataobjectsSlider->render($group['objects'], array(
	                        'rowNumber' => 1,
	                        'perGroup' => 3,
	                    ));
	                    ?>
	                </div>
	
	            </div>
	            
            
	            <div class="row header">
                    <div class="col-xs-12 col-sm-8 left">
                        <h2>
                            <a href="#">Autorzy projektów w Sejmie</a>
                        </h2>
                    </div>
                    <div class="col-xs-4 col-xs-offset-4 col-sm-4 col-sm-offset-0 right"></div>
                </div>
                
                <div class="blockContent">
                	<div id="sejm_projekty_chart"></div>
                </div>
            
	            
	
	        </div>
		</div>
		
        
    </div>


<? /*
<div class="container app">
	
	<div class="mpanel">
	
		<div class="block">
		
			<h2 class="underline">Posiedzenia Sejmu</h2>
			
			<div class="block_content">
				
				<div class="last_session">
					<p>Ostatnie posiedzenie Sejmu odbyło się 13 maja 2014. <a class="btn btn-primary btn-xs" href="#">Szczegóły &raquo;</a></p>
					<p>Rozpatrywano 23 projekty. Przyjęto 5, odrzucono 1.</p>
				</div>
				
				<h3>Projekty przyjęte na ostatnim posiedzeniu</h3>
							
				
			</div>
			
		</div>
		
		<div class="block">
		
			<h2 class="underline">Legislacja</h2>
			
			<div class="block_content">
				
			</div>
			
		</div>
		
		<div class="block">
		
			<h2 class="underline">Posłowie</h2>
			
			<div class="block_content">
				
			</div>
			
		</div>
		
		<div class="block">
		
			<h2 class="underline">Kluby parlamentarne</h2>
			
			<div class="block_content">
				
			</div>
			
		</div>
	
	</div>

</div>
*/