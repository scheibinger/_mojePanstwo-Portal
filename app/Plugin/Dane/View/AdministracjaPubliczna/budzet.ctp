<?
$this->Combinator->add_libs('css', $this->Less->css('view-administracjapubliczna', array('plugin' => 'Dane')));
echo $this->Element('dataobject/pageBegin');

if( $budzet = $object->getLayer('budzet') ) {
?>


    <div id="budzet" class="block mpanel">
        
        <? /*
        <p>W 2014 roku, <?= $object->getTitle() ?> planuje wydać:</p>
        
        <p>123 234 złotych</p>
        */ ?>
        
        <? if( isset($budzet['wydatki_dzialy']) && $budzet['wydatki_dzialy'] ) { ?>
	    	

		
			<p class="disclaimer">Poniżej widzisz planowane wydatki instytucji, według klasyfikacji budżetowych. Wszystkie kwoty są podane w milionach złotych.</p>

			<div class="budzet">
				
				<div class="row row-header">
					<div class="col nazwa">
						&nbsp;
					</div>
					<div class="col plan">
						Plan
					</div>
					<div class="col ztego">
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
						<div class="col nazwa">
							<a href="/dane/budzet_wydatki_dzialy/<?= $dzial['data']['id'] ?>"><?= $dzial['data']['nazwa'] ?></a>
						</div>
						<div class="col plan">
							<?= __currency($dzial['calc']['plan']) ?>
						</div>
						<div class="col ztego">
							<div class="col">
								<?= __currency($dzial['calc']['dotacje_i_subwencje']) ?>
							</div>
							<div class="col">
								<?= __currency($dzial['calc']['swiadczenia_na_rzecz_osob_fizycznych']) ?>
							</div>
							<div class="col">
								<?= __currency($dzial['calc']['wydatki_biezace_jednostek_budzetowych']) ?>
							</div>
							<div class="col">
								<?= __currency($dzial['calc']['wydatki_majatkowe']) ?>
							</div>
							<div class="col">
								<?= __currency($dzial['calc']['wydatki_na_obsluge_dlugu']) ?>
							</div>
							<div class="col">
								<?= __currency($dzial['calc']['srodki_wlasne_ue']) ?>
							</div>
							<div class="col">
								<?= __currency($dzial['calc']['wspolfinansowanie_ue']) ?>
							</div>
						</div>
					</div>
					
					<?
						if( !empty($dzial['items']) ) {
							foreach( $dzial['items'] as $item ) {
																
					?>
					
						<div class="row row-sub">
							<div class="col nazwa">
								<a href="/dane/budzet_wydatki_rozdzialy/<?= $dzial['data']['id'] ?>"><?= $item['rozdzial_nazwa'] ?></a>
							</div>
							<div class="col plan">
								<?= __currency($item['plan']) ?>
							</div>
							<div class="col ztego">
								<div class="col">
									<?= __currency($item['dotacje_i_subwencje']) ?>
								</div>
								<div class="col">
									<?= __currency($item['swiadczenia_na_rzecz_osob_fizycznych']) ?>
								</div>
								<div class="col">
									<?= __currency($item['wydatki_biezace_jednostek_budzetowych']) ?>
								</div>
								<div class="col">
									<?= __currency($item['wydatki_majatkowe']) ?>
								</div>
								<div class="col">
									<?= __currency($item['wydatki_na_obsluge_dlugu']) ?>
								</div>
								<div class="col">
									<?= __currency($item['srodki_wlasne_ue']) ?>
								</div>
								<div class="col">
									<?= __currency($item['wspolfinansowanie_ue']) ?>
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