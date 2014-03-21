<?php $this->Combinator->add_libs('css', $this->Less->css('dataobject', array('plugin' => 'Dane'))) ?>
<?php $this->Combinator->add_libs('css', $this->Less->css('dataobjectslider', array('plugin' => 'Dane'))) ?>
<?php $this->Combinator->add_libs('css', $this->Less->css('sejmometr', array('plugin' => 'Sejmometr'))) ?>
<?php $this->Combinator->add_libs('js', 'Sejmometr.sejmometr.js'); ?>
<?php echo $this->Html->script('timelinejs/storyjs-embed.js', array('block' => 'scriptBlock')); ?>




<div id="sejmometr">

    <div id="timeline-embed" data-source="1"></div>


   <div class="container">
	
		<? /*
	    <div class="searchDiv">
	        <div class="col-lg-10 col-lg-offset-1">
	            <form action="/dane/zamowienia_publiczne">
	                <div class="input-group main_input">
	                    <input name="q" type="text"
	                           placeholder="<?= __d('zamowienia_publiczne', 'LC_SEARCH_ALL_TENDERS') ?>"
	                           class="form-control input-lg">
					            <span class="input-group-btn">
					                  <input type="submit" class="btn btn-success input-lg" value="<?= __('LC_SEARCH') ?>"/>
					            </span>
	                </div>
	            </form>
	        </div>
	    </div>
	    */ ?>
	
	    <div class="dataobjectsSliderRow">
	        <div class="row header">
	            <div class="col-xs-12 col-sm-6 left">
	                <h2>
	                    <a href="#">Projekty przyjęte na ostatnim posiedzeniu</a>
	                </h2>
	            </div>
	            <div class="col-xs-6 col-xs-offset-6 col-sm-6 col-sm-offset-0 right">
	
	            </div>
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