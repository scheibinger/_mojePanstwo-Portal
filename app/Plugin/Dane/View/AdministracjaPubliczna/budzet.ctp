<?
$this->Combinator->add_libs('css', $this->Less->css('view-administracjapubliczna', array('plugin' => 'Dane')));
echo $this->Element('dataobject/pageBegin');

if( $budzet = $object->getLayer('budzet') ) {
?>


    <div id="budzet" class="block mpanel">
        
        <? if( isset($budzet['wydatki_dzialy']) && $budzet['wydatki_dzialy'] ) { ?>
	    	
	    	<div class="block-header">
	    		<h2 class="label">Wydatki instytucji w 2014 r.:</h2>
	    	</div>
	    	    		
			<div class="budzet">
				
				<div class="row row-header">
					<div class="col-md-3">
						&nbsp;
					</div>
					<div class="col-md-1">
						Plan
					</div>
					<div class="col-md-8 ztego">
						<div class="col">
							Dotacje i subwencje
						</div>
						<div class="col">
							Świadczenia na rzecz osób fizycznych
						</div>
						<div class="col">
							Wydatki bieżące jednostek budżetowych
						</div>
						<div class="col">
							Wydatki majątkowe
						</div>
						<div class="col">
							Wydatki na obsługę długu
						</div>
						<div class="col">
							Środki własne UE
						</div>
						<div class="col">
							Współfinansowanie UE
						</div>
					</div>
				</div>
				
				<? foreach( $budzet['wydatki_dzialy'] as $dzial ) {?>
				
					<div class="row row-main">
						<div class="col-md-3 nazwa">
							<?= $dzial['data']['nazwa'] ?>
						</div>
						<div class="col-md-1 plan">
							<?= number_format_h($dzial['calc']['plan']*1000) ?>
						</div>
						<div class="col-md-8 ztego">
							<div class="col">
								<?= number_format_h($dzial['calc']['dotacje_i_subwencje']*1000) ?>
							</div>
							<div class="col">
								<?= number_format_h($dzial['calc']['swiadczenia_na_rzecz_osob_fizycznych']*1000) ?>
							</div>
							<div class="col">
								<?= number_format_h($dzial['calc']['wydatki_biezace_jednostek_budzetowych']*1000) ?>
							</div>
							<div class="col">
								<?= number_format_h($dzial['calc']['wydatki_majatkowe']*1000) ?>
							</div>
							<div class="col">
								<?= number_format_h($dzial['calc']['wydatki_na_obsluge_dlugu']*1000) ?>
							</div>
							<div class="col">
								<?= number_format_h($dzial['calc']['srodki_wlasne_ue']*1000) ?>
							</div>
							<div class="col">
								<?= number_format_h($dzial['calc']['wspolfinansowanie_ue']*1000) ?>
							</div>
						</div>
					</div>
					
					<?
						if( !empty($dzial['items']) ) {
							foreach( $dzial['items'] as $item ) {
																
					?>
					
						<div class="row row-sub">
							<div class="col-md-3 nazwa">
								<?= $item['rozdzial_nazwa'] ?>
							</div>
							<div class="col-md-1 plan">
								<?= number_format_h($item['plan']*1000) ?>
							</div>
							<div class="col-md-8 ztego">
								<div class="col">
									<?= number_format_h($item['dotacje_i_subwencje']*1000) ?>
								</div>
								<div class="col">
									<?= number_format_h($item['swiadczenia_na_rzecz_osob_fizycznych']*1000) ?>
								</div>
								<div class="col">
									<?= number_format_h($item['wydatki_biezace_jednostek_budzetowych']*1000) ?>
								</div>
								<div class="col">
									<?= number_format_h($item['wydatki_majatkowe']*1000) ?>
								</div>
								<div class="col">
									<?= number_format_h($item['wydatki_na_obsluge_dlugu']*1000) ?>
								</div>
								<div class="col">
									<?= number_format_h($item['srodki_wlasne_ue']*1000) ?>
								</div>
								<div class="col">
									<?= number_format_h($item['wspolfinansowanie_ue']*1000) ?>
								</div>
							</div>
						</div>
					
					<? 
							}
						}
					?>
					
				
				<? } ?>
				
			</div>
		<? } ?>
        
    </div>

<?
}
echo $this->Element('dataobject/pageEnd');
?>