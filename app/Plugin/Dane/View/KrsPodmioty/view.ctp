<?
	
	echo $this->Element('dataobject/pageBegin');
	echo $this->Html->script('Dane.d3/d3', array('block' => 'scriptBlock'));

	$this->Combinator->add_libs('css', $this->Less->css('view-krspodmioty', array('plugin' => 'Dane')));
	$this->Combinator->add_libs('js', 'Dane.view-krspodmioty');
	
?>
<div class="krsPodmioty row">
    
	
	<div class="col-lg-3 objectSide">
	        
    	<? /* 
	        <div class="block">
	            <?php echo $this->Dataobject->hlTableForObject($object, array(
	                'krs', 'nip', 'regon', 
	                'wartosc_czesc_kapitalu_wplaconego', 'wartosc_kapital_docelowy', 'wartosc_kapital_zakladowy', 'wartosc_nominalna_akcji', 'wartosc_nominalna_podwyzszenia_kapitalu', 
	                
	                'data_rejestracji', 'data_dokonania_wpisu',
	                
	                'email', 'www',
	                
	                
	            ), array(
	                'col_width' => 3,
	                'display' => 'firstRow',
	            )); ?>
	        </div>
	    */ ?>
	        
        <div class="objectSideInner">
            <ul class="dataHighlights side">
                
                <? if( $object->getData('krs') ) {?>
                <li class="dataHighlight big">
                    <p class="_label">Numer KRS</p>

                    <p class="_value"><?= $object->getData('krs'); ?></p>
                </li>
                <? } ?>
                
                <? if( $object->getData('nip') ) {?>
                <li class="dataHighlight big">
                    <p class="_label">Numer NIP</p>

                    <p class="_value"><?= $object->getData('nip'); ?></p>
                </li>
                <? } ?>
                
                <? if( $object->getData('regon') ) {?>
                <li class="dataHighlight big">
                    <p class="_label">Numer REGON</p>

                    <p class="_value"><?= $object->getData('regon'); ?></p>
                </li>
                <? } ?>
                
                
                
                <? if( $object->getData('data_rejestracji') ) {?>
                <li class="dataHighlight inl topborder">
                    <p class="_label">Data rejestracji</p>

                    <p class="_value"><?= $this->Czas->dataSlownie($object->getData('data_rejestracji')); ?></p>
                </li>
                <? } ?>
                
                <? if( $object->getData('data_dokonania_wpisu') ) {?>
                <li class="dataHighlight inl">
                    <p class="_label">Data ostatniego wpisu</p>

                    <p class="_value"><?= $this->Czas->dataSlownie($object->getData('data_dokonania_wpisu')); ?></p>
                </li>
                <? } ?>               
                
                <? if( $object->getData('forma_prawna_str') ) {?>
                <li class="dataHighlight inl topborder">
                    <p class="_label">Forma prawna</p>

                    <p class="_value"><?= $object->getData('forma_prawna_str'); ?></p>
                </li>
                <? } ?>
                
                <? if( $object->getData('oznaczenie_sadu') ) {?>
                <li class="dataHighlight">
                    <p class="_label">Oznaczenie sądu</p>

                    <p class="_value"><?= $object->getData('oznaczenie_sadu'); ?></p>
                </li>
                <? } ?>
                
                <? if( $object->getData('sygnatura_akt') ) {?>
                <li class="dataHighlight">
                    <p class="_label">Sygnatura akt</p>

                    <p class="_value"><?= $object->getData('sygnatura_akt'); ?></p>
                </li>
                <? } ?>
                
                <? if( $object->getData('wczesniejsza_rejestracja_str') ) {?>
                <li class="dataHighlight inl">
                    <p class="_label">Wcześniejsza rejestracja</p>

                    <p class="_value"><?= $object->getData('wczesniejsza_rejestracja_str'); ?></p>
                </li>
                <? } ?>
                
                
            </ul>

            
        
        </div>
                        
    </div>
    
    
    <div class="col-lg-9 objectMain">
        <div class="object mpanel">
            
            <?
	        $adres = $object->getData('adres_ulica');
	        $adres .= ' ' . $object->getData('adres_numer');
	        $adres .= ', ' . $object->getData('adres_miejscowosc');
	        $adres .= ', Polska';
	        ?>
	
	        <div class="profile_baner" data-adres="<?= urlencode($adres) ?>">
	            <div class="bg">
	                <img src="http://maps.googleapis.com/maps/api/staticmap?center=<?= urlencode($adres) ?>&markers=<?= urlencode($adres) ?>&zoom=15&sensor=false&size=640x140&scale=2&feature:road"/>
	
	                <div class="content">
	                    <p>
	                        ul. <?= $object->getData('adres_ulica') ?> <?= $object->getData('adres_numer') ?><? if ($object->getData('adres_lokal')) { ?>/<?= $object->getData('adres_lokal') ?><? } ?></p>
	                    <? if ($object->getData('adres_poczta') != $object->getData('adres_miejscowosc')) { ?>
	                        <p><?= $object->getData('adres_miejscowosc') ?></p><? } ?>
	                    <p><?= $object->getData('adres_kod_pocztowy') ?> <?= $object->getData('adres_poczta') ?></p>
	
	                    <p><?= $object->getData('adres_kraj') ?></p>
	                    <button class="btn btn-info"><?= __d('dane', 'LC_DANE_VIEW_KRSPODMIOTY_OTWORZ_MAPE') ?></button>
	                </div>
	            </div>
	            <div id="googleMap">
	                <script>
	                    var googleMapAdres = '<?= $adres ?>';
	                </script>
	            </div>
	        </div>

			
			<div class="block-group">
			
				
			<? if ($object->getData('cel_dzialania')) { ?>
		        <div class="dzialanie block">
		            <h2>Cel działania</h2>
		
		            <div class="content normalizeText textBlock">
		                <?= $object->getData('cel_dzialania') ?>
		            </div>
		        </div>
		    <? } ?>
				
	        <? if ($object->getData('sposob_reprezentacji')) { ?>
	            <div class="reprezentacja block">
	                <h2>Sposób reprezentacji</h2>
	
	                <div class="content normalizeText textBlock">
	                    <?= $object->getData('sposob_reprezentacji') ?>
	                </div>
	            </div>
	        <? } ?>				
		
			    <div class="graph block">
			        <h2>Powiązania</h2>
			
			        <div id="connectionGraph" class="col-xs-12" data-id="<?php echo $object->getId() ?>">
			            <script>var connectionGraphObject = <?php echo json_encode($object) ?>;</script>
			        </div>
			    </div>
		
		    
		
		    <? if ($dzialalnosci) { ?>
		        <div class="dzialalnosci block">
		            <h2 id="<?= $dzialalnosci['idTag'] ?>"><?= $dzialalnosci['title'] ?></h2>
		
		            <div class="content normalizeText">
		                <div class="list-group less-borders">
		                    <? foreach ($dzialalnosci['content'] as $d) { ?>
		                        <li class="list-group-item"><?= $d['str'] ?></li>
		                    <? } ?>
		                </div>
		            </div>
		        </div>
		    <? } ?>
			
			</div>
			
	    </div>
    </div>
    
    
</div>

<?= $this->Element('dataobject/pageEnd'); ?>