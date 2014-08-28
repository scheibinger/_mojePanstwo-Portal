<?

	$this->Combinator->add_libs('css', $this->Less->css('view-prawo', array('plugin' => 'Dane')));
	echo $this->Element('dataobject/pageBegin');
			
?>


	<div class="prawo row">
	    <div class="col-lg-2 objectSide">
	        <div class="objectSideInner">
	            <ul class="dataHighlights side">
	            
	                
			
                    <? if( $object->getData('isap_status_str') ) {?>
                    <li class="dataHighlight">
                        <p class="_label">Status</p>
                        <p class="_value"><?= $object->getData('isap_status_str'); ?></p>
                    </li>
                    <? } ?>
                    
                    

                    <? if( $object->getData('data_wydania') && ( $object->getData('data_wydania')!='0000-00-00' ) ) {?>
                    <li class="dataHighlight">
                        <p class="_label">Data wydania</p>
                        <p class="_value"><?= $this->Czas->dataSlownie($object->getData('data_wydania')); ?></p>
                    </li>
                    <? } ?>

                    <? if( $object->getData('data_publikacji') && ( $object->getData('data_publikacji')!='0000-00-00' ) ) {?>
                    <li class="dataHighlight">
                        <p class="_label">Data publikacji</p>
                        <p class="_value"><?= $this->Czas->dataSlownie($object->getData('data_publikacji')); ?></p>
                    </li>
                    <? } ?>

                    <? if( $object->getData('data_wejscia_w_zycie') && ( $object->getData('data_wejscia_w_zycie')!='0000-00-00' ) ) {?>
                    <li class="dataHighlight">
                        <p class="_label">Data wejścia w życie</p>
                        <p class="_value"><?= $this->Czas->dataSlownie($object->getData('data_wejscia_w_zycie')); ?></p>
                    </li>
                    <? } ?>
                    
                    <? if( $tags = $object->getLayer('tags') ) {  $t = 0;?>
                    
                    <li class="dataHighlight topborder">
                        <p class="_label">Tematy</p>
                        <ul class="_value tags">
	                    <? foreach( $tags as $tag ) {?>
	                    	<li><a title="<?= addslashes( $tag['q'] ) ?>" class="label label-default" href="/dane/prawo/?haslo_id=<?= $tag['id'] ?>"><?= $tag['q'] ?></a></li>
	                    <? $t++; if($t==10) break;} ?>
                        </ul>
                    </li>
                    
                    <? } ?>
                    
                    <? if( $object->getData('sygnatura') ) {?>
                    <li class="dataHighlight topborder">
                        <p class="_label">Sygnatura</p>
                        <p class="_value"><?= $object->getData('sygnatura'); ?></p>
                    </li>
                    <? } ?>

                    
                    
                    
	            </ul>
	            	            
	        </div>
	    </div>
	
	
	    <div class="col-lg-10 objectMain">
	        <div class="object">
	            	            
	            <? if( 
	            	( $object->getData('typ_id')==1 ) && 
	            	( isset($counters_dictionary) ) && 
	            	( isset($counters_dictionary['akty_zmieniajace']) ) && 
	            	( $counters_dictionary['akty_zmieniajace'] )
	            ) { ?>
	            
	            <div class="alert alert-dismissable alert-info text-center">
					<button type="button" class="close" data-dismiss="alert">×</button>
					<h4>Uwaga!</h4>
					<p>Poniżej widzisz treść ustawy, aktualną w momencie publikacji. Od tamtej pory, <a href="/dane/prawo/<?= $object->getId() ?>/akty_zmieniajace">tekst zmienił się <?= pl_dopelniacz($counters_dictionary['akty_zmieniajace'], 'raz', 'razy', 'razy') ?></a>.<br/> <a class="btn btn-xs btn-primary" href="/dane/prawo/<?= $object->getId() ?>/tekst_aktualny">Zobacz aktualną wersję tej ustawy &raquo;</a></p>
				</div>
				
				<? } ?>
	            
	            <?= $this->Document->place( $document ) ?>
	            	
	
	        </div>
	    </div>
    </div>


<?=	$this->Element('dataobject/pageEnd'); ?>