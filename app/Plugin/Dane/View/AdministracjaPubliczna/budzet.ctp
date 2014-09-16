<?
$this->Combinator->add_libs('css', $this->Less->css('view-administracjapubliczna', array('plugin' => 'Dane')));

echo $this->Element('dataobject/pageBegin');
?>


    <div id="budzet" class="block mpanel">
        
        <? if( isset($info['budzet']) && $info['budzet'] ) { ?>
	        		
			<div class="budzet">
				
				<div class="row row-header">
					<div class="col-md-3">
						&nbsp;
					</div>
					<div class="col-md-1">
						Plan
					</div>
					<div class="col-md-1">
						Dotacje i subwencje
					</div>
					<div class="col-md-1">
						Świadczenia na rzecz osób fizycznych
					</div>
					<div class="col-md-1">
						Wydatki bieżące jednostek budżetowych
					</div>
					<div class="col-md-1">
						Wydatki majątkowe
					</div>
					<div class="col-md-1">
						Wydatki na obsługę długu
					</div>
					<div class="col-md-1">
						Środki własne UE
					</div>
					<div class="col-md-2">
						Współfinansowanie UE
					</div>
				</div>
				
				<? foreach( $info['budzet']['wydatki_dzialy'] as $dzial ) {?>
				
					<div class="row row-main">
						<div class="col-md-4">
							<?= $dzial['data']['nazwa'] ?>
						</div>
						<div class="col-md-1">
							<?= $dzial['calc']['plan'] ?>
						</div>
						<div class="col-md-1">
							<?= $dzial['calc']['dotacje_i_subwencje'] ?>
						</div>
						<div class="col-md-1">
							<?= $dzial['calc']['swiadczenia_na_rzecz_osob_fizycznych'] ?>
						</div>
						<div class="col-md-1">
							<?= $dzial['calc']['wydatki_biezace_jednostek_budzetowych'] ?>
						</div>
						<div class="col-md-1">
							<?= $dzial['calc']['wydatki_majatkowe'] ?>
						</div>
						<div class="col-md-1">
							<?= $dzial['calc']['wydatki_na_obsluge_dlugu'] ?>
						</div>
						<div class="col-md-1">
							<?= $dzial['calc']['srodki_wlasne_ue'] ?>
						</div>
						<div class="col-md-1">
							<?= $dzial['calc']['wspolfinansowanie_ue'] ?>
						</div>
					</div>
				
				<? } ?>
				
			</div>
		<? } ?>
        
    </div>

<?
echo $this->Element('dataobject/pageEnd');
?>