<?php $this->Combinator->add_libs('css', $this->Less->css('view-zamowieniapubliczne', array('plugin' => 'Dane'))); ?>
<?php $this->Combinator->add_libs('js', 'Dane.view-zamowieniapubliczne'); ?>


<?= $this->Element('dataobject/pageBegin'); ?>

    <div class="row">
        <div class="col-lg-9 objectMain">

            <div class="object mpanel">
				
				<div class="block-group">
				
				<?
					foreach( $object->getLayer('details') as $key => $value ) { if( $value ) {
				?>
				
				
				
				
                <div class="block">
                    <div class="block-header">
	                    <h2 class="pull-left label"><?php echo __d('dane', __('LC_DANE_VIEW_ZAMOWIENIAPUBLICZNE_' . $key)); ?></h2>
                    </div>

                    <div class="content">

                        <div class="textBlock"><?php echo( nl2br($value) ); ?></div>

                    </div>
                </div>
                
                <? } } ?>
                
				</div>

            </div>

        </div>
        <div class="col-lg-3 objectSide">
			<div class="objectSideInner">
			
	
                <ul class="dataHighlights side">
                	<li class="dataHighlight big">
                		<p class="_label">Wartość udzielonego zamówienia</p>
                		<p class="_value"><?= _currency( $object->getData('wartosc_cena') ); ?></p>
                	</li>
                	<li class="dataHighlight" style="display: none;">
                		<p class="_label">Wartość szacowana przez zamawiającego</p>
                		<p class="_value"><?= _currency( $object->getData('wartosc_szacowana') ); ?></p>
                	</li>
                	<li class="dataHighlight">
                		<p class="_label">Zamawiający</p>
                		<p class="_value"><a href="/dane/zamowienia_publiczne_zamawiajacy/<?= $object->getData('zamawiajacy_id'); ?>"><?= $object->getData('zamawiajacy_nazwa'); ?></a></p>
                	</li>
                	<?
                	
                		$czesci = $object->getLayer('czesci');
                		if( count($czesci)==1 ) {
	                		$czesc = $czesci[0];
	                ?>
	                <li class="dataHighlight topborder">
                		<p class="_label">Wykonawca</p>
                		<? foreach($czesc['wykonawcy'] as $wykonawca) {?>
                		<p class="_value"><a href="/dane/zamowienia_publiczne_wykonawcy/<?= $wykonawca['id'] ?>"><?= $wykonawca['nazwa']; ?></a></p>
                		<? } ?>
                	</li>
                	<li class="dataHighlight">
                		<p class="_label">Data udzielenia zamówienia</p>
                		<p class="_value"><?= $czesc['data_zam']; ?></p>
                	</li>
                	<li class="dataHighlight">
                		<p class="_label">Cena minimalna</p>
                		<p class="_value"><?= _currency( $czesc['cena_min'] ); ?></p>
                	</li>
                	<li class="dataHighlight">
                		<p class="_label">Cena maksymalna</p>
                		<p class="_value"><?= _currency( $czesc['cena_max'] ); ?></p>
                	</li>
                	<li class="dataHighlight inl">
                		<p class="_label">Liczba ofert</p>
                		<p class="_value"><?= $czesc['liczba_ofert']; ?></p>
                	</li>	
                	<li class="dataHighlight inl">
                		<p class="_label">Liczba odrzuconych ofert</p>
                		<p class="_value"><?= $czesc['liczba_odrzuconych_ofert']; ?></p>
                	</li>	                
	                <?		
                		} else {
                		
                		foreach($czesci as $czesc) {
                	?>
                		
                		<h2><span>#<?= $czesc['numer'] ?></span> <span><?= $czesc['nazwa'] ?></span></h2>
                		
                		<li class="dataHighlight">
	                		<p class="_label">Wykonawca</p>
	                		<? foreach($czesc['wykonawcy'] as $wykonawca) {?>
	                		<p class="_value"><a href="/dane/zamowienia_publiczne_wykonawcy/<?= $wykonawca['id'] ?>"><?= $wykonawca['nazwa']; ?></a></p>
	                		<? } ?>
	                	</li>
	                	<li class="dataHighlight inl" style="display: none;">
	                		<p class="_label">Data udzielenia zamówienia</p>
	                		<p class="_value"><?= $czesc['data_zam']; ?></p>
	                	</li>
	                	<li class="dataHighlight inl">
	                		<p class="_label">Cena</p>
	                		<p class="_value"><?= _currency( $czesc['cena'] ); ?></p>
	                	</li>
	                	<li class="dataHighlight inl" style="display: none;">
	                		<p class="_label">Cena minimalna</p>
	                		<p class="_value"><?= _currency( $czesc['cena_min'] ); ?></p>
	                	</li>
	                	<li class="dataHighlight inl" style="display: none;">
	                		<p class="_label">Cena maksymalna</p>
	                		<p class="_value"><?= _currency( $czesc['cena_max'] ); ?></p>
	                	</li>
	                	<li class="dataHighlight inl">
	                		<p class="_label">Liczba ofert</p>
	                		<p class="_value"><?= $czesc['liczba_ofert']; ?></p>
	                	</li>	
	                	<li class="dataHighlight inl" style="display: none;">
	                		<p class="_label">Liczba odrzuconych ofert</p>
	                		<p class="_value"><?= $czesc['liczba_odrzuconych_ofert']; ?></p>
	                	</li>
                	
                	
                	<? } } ?>
                	<li class="dataHighlight topborder">
                		<p class="_label">Źródło</p>
                		<p class="_value" id="sources"></p>
                	</li>	
                </ul>
                                                
                <? /*
                <h2><?php echo __d('dane', __('LC_DANE_VIEW_ZAMOWIENIAPUBLICZNE_ZAMAWIAJACY')); ?></h2>

                <div class="content">
                    <ul>
                        <li class="title"><?php echo $object->getData('zamawiajacy_nazwa'); ?></li>
                        <li>
                            <a href="<?php echo (preg_match('/http\:\/\//', $object->getData('zamawiajacy_www'))) ? $object->getData('zamawiajacy_www') : 'http://' . $object->getData('zamawiajacy_www'); ?>"
                               target="_blank"><?php echo $object->getData('zamawiajacy_www'); ?></a></li>
                        <li>
                            <a href="mailto:<?php echo $object->getData('zamawiajacy_email'); ?>"><?php echo $object->getData('zamawiajacy_email'); ?></a>
                        </li>
                    </ul>
                </div>
				*/ ?>
            
	            
            
			</div>
        </div>
    </div>

<? /*
    <div class="object">
        <div class="documentMain col-md-8">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h2><?php echo __d('dane', __('LC_DANE_VIEW_ZAMOWIENIAPUBLICZNE_PRZEDMIOT')); ?></h2>
                </div>
                <div class="panel-body">
                    <?php echo($details['przedmiot']); ?>
                </div>
            </div>
        </div>
        <div class="documentInfo col-md-4">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h2><?php echo __d('dane', __('LC_DANE_VIEW_ZAMOWIENIAPUBLICZNE_ZAMAWIAJACY')); ?></h2>
                </div>
                <div class="panel-body">
                    
                </div>
            </div>
        </div>
    </div>
    */
?>

<?= $this->Element('dataobject/pageEnd'); ?>

<script type="text/javascript">
	var sources = <?= json_encode( $object->getLayer('sources') ) ?>;
</script>