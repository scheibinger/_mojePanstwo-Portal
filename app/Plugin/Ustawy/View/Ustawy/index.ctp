<?php $this->Combinator->add_libs('css', $this->Less->css('ustawy', array('plugin' => 'Ustawy'))) ?>

<div class="appHeader">
	<div class="container innerContent">
	    <h1><?php echo __d('ustawy', 'LC_USTAWY_HEADLINE'); ?></h1>
	
	    <div class="col-xs-12 col-sm-8 col-sm-offset-2">
	        <form action="/ustawy">
	            <div class="input-group main_input">
	                <input name="q" value="" type="text"
	                       placeholder="<?php echo __d('ustawy', 'LC_USTAWY_SZUKAJ_ORGANIZACJI'); ?>"
	                       class="form-control input-lg">
	                <span class="input-group-btn">
	                      <input type="submit" class="btn btn-success input-lg"
	                             value="<?= __d('ustawy', 'LC_USTAWY_SZUKAJ') ?>"/>
	                </span>
	            </div>
	        </form>
	
	
	        <div id="shortcuts">
	            <ul>
	                <li style="display: none;"><a href="dane/ustawy" target="_self">Wyniki wyszukiwania</a></li>
	                <li><a href="dane/ustawy" target="_self">Najnowsze</a></li>
	                <li><a href="dane/ustawy?typ_id[]=3" target="_self"><?php echo __d('ustawy', 'LC_USTAWY_WIECEJ_KODEKSY'); ?></a></li>
	                <li><a href="dane/ustawy?typ_id[]=2" target="_self"><?php echo __d('ustawy', 'LC_USTAWY_WIECEJ_KONSTYTUCJE'); ?></a></li>
	               
	            </ul>
	        </div>
			
	    </div>
	</div>
</div>

<div class="container">
	<div class="col-lg-10 col-lg-offset-1">
	
		<div id="najnowsze" style="display: none;">
			
			<div class="row">
				<div class="col-lg-6">
					<h2>Niedawno weszły w życie:</h2>
					
					<ul>
					<?
					foreach( $data['niedawno_weszly'] as $obj )
					{
						debug($obj->getData());
					}
					?>
					</ul>
				</div>
				<div class="col-lg-6">
					<h2>Niedługo wejdą w życie:</h2>
					
					<ul>
					<?
					foreach( $data['niedlugo_wejda'] as $obj )
					{
						debug($obj->getData());
					}
					?>
					</ul>
				</div>
			</div>
			
		</div>
		
		<div id="kodeksy" style="display: none;">
						
			<ul>
			<?
			foreach( $data['kodeksy'] as $obj )
			{
				debug($obj->getData());
			}
			?>
			</ul>
							
		</div>
		
		<div id="konstytucja" style="display: none;">
						
			<ul>
			<?
			foreach( $data['konstytucje'] as $obj )
			{
				debug($obj->getData());
			}
			?>
			</ul>
							
		</div>
	
	</div>
</div>