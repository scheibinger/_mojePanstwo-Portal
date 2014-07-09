<?php $this->Combinator->add_libs('css', $this->Less->css('adminitracja', array('plugin' => 'Administracja'))) ?>
<?php // $this->Combinator->add_libs('js', 'Krs.krs.js') ?>

<div id="administracja">
    
    <? /*
    <div class="appHeader">
        <div class="container innerContent">
            <h1><?php echo __d('administracja', 'LC_ADMINISTRACJA_HEADLINE'); ?></h1>

            <div class="col-xs-12 col-sm-8 col-sm-offset-2">
                <form class="searchInput" class="searchKRSForm" action="/krs">
                    <div class="searchKRS input-group main_input">
                        <input name="q" value="" autocomplete="off" type="text"
                               placeholder="<?php echo __d('administracja', 'LC_ADMINISTRACJA_SEARCH_PLACEHOLDER'); ?>"
                               class="form-control input-lg">
		                <span class="input-group-btn">
		                      <button class="btn btn-success btn-lg" type="submit" data-icon="&#xe600;"></button>
		                </span>
                    </div>
                </form>
            </div>

        </div>
    </div>
    */ ?>

    <div class="container">


        	
	<? if( $items = $data['files'] ) {?>
		
		        	
    	<div class="content">   
    		
    		<? /*
    		<div class="header text-center">
	    		<p>Kliknij, aby dowiedzieć się więcej</p>
    		</div>
    		*/ ?>
    		
    		<h2>Państwowe instytucje publiczne</h2>    
    		 
	        <div class="row items">
	        <? foreach( $items as $item ) {?>
	        
	        	<div class="col-md-<?= $item['width'] ?>">
	        		<div class="item" data-id="<?=$item['id']?>">
		        		<a href="/dane/administracja_publiczna/<?= $item['id'] ?>" class="inner">
			        		<p class="nazwa"><?= $item['nazwa'] ?></p>
			        		<p class="desc"><?= pl_dopelniacz($item['childsCount'], 'instytucja', 'instytucje', 'instytucji') ?></p>
		        		</a>
	        		</div>
	        	</div>
	        
	        <? } ?>
	        </div>
	        
	        
	        <h2>Instytucje wykonujące zadania publiczne</h2>  
    	</div>
	<? }?>
	
	

        
    </div>

</div>