<?

	$this->Combinator->add_libs('css', $this->Less->css('view-prawo', array('plugin' => 'Dane')));
	
	echo $this->Element('dataobject/pageBegin');
	echo $this->Element('Dane.dataobject/menuTabs', array(
		'menu' => $_menu,
	));
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
                    
                    

                    <? if( $object->getData('data_wydania') ) {?>
                    <li class="dataHighlight">
                        <p class="_label">Data wydania</p>
                        <p class="_value"><?= $this->Czas->dataSlownie($object->getData('data_wydania')); ?></p>
                    </li>
                    <? } ?>

                    <? if( $object->getData('data_publikacji') ) {?>
                    <li class="dataHighlight">
                        <p class="_label">Data publikacji</p>
                        <p class="_value"><?= $this->Czas->dataSlownie($object->getData('data_publikacji')); ?></p>
                    </li>
                    <? } ?>

                    <? if( $object->getData('data_wejscia_w_zycie') ) {?>
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
	            
	            
	            <?= $this->Document->place( $document ) ?>
	            	
	
	        </div>
	    </div>
    </div>


<?=	$this->Element('dataobject/pageEnd'); ?>