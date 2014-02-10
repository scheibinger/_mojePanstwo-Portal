<?php
$this->Combinator->add_libs('css', $this->Less->css('kody_pocztowe', array('plugin' => 'KodyPocztowe')));
?>

<div class="appHeader">
	<div class="container details" id="kodyPocztowe">
	    <div class="row">
	        <div class="col-xs-12 col-sm-10 col-md-8 col-sm-offset-1 col-md-offset-2">
	            <div class="kodyPocztoweBlock col-xs-12 col-sm-7 pull-left">
	                <div class="row">
	                    <p><?php echo __d('kody_pocztowe', "LC_KODY_POCZTOWE_SZUKAM_KODU"); ?></p>
	
	                    <p class="subtitle"><?php echo __d('kody_pocztowe', "LC_KODY_POCZTOWE_ZNAM_ADRES"); ?></p>
	                </div>
	                <div class="row">
	                    <form action="/kody_pocztowe" method="get">
	                        <div class="input-group">
	                            <?php 
	                                echo $this->Form->input('miejscowosc', array('label' => false, 'class' => 'form-control input-lg', 'placeholder' => __d('kody_pocztowe', "LC_KODY_POCZTOWE_WPISZ_MIEJSCOWOSC"), 'id' => 'cityv', 'name' => 'mstr', 'value' => ''));
	                            ?>
	                            <span class="input-group-btn">
	                                <button class="btn btn-success btn-lg" type="submit"
	                                        data-icon="&#xe600;"></button>
	                            </span>
	                        </div>
	                    </form>
	                </div>
	            </div>
	            <div class="kodyPocztoweBlock col-xs-12 col-sm-5 pull-right">
	                <div class="row">
	                    <p><?php echo __d('kody_pocztowe', "LC_KODY_POCZTOWE_SZUKAM_ADRESU"); ?></p>
	
	                    <p class="subtitle"><?php echo __d('kody_pocztowe', "LC_KODY_POCZTOWE_ZNAM_KOD"); ?></p>
	                </div>
	                <div class="row">
	                    <form action="/kody_pocztowe" method="get">
	                        <div class="input-group">
	                            <?php
	                                echo $this->Form->input('kod', array('label' => false, 'class' => 'form-control input-lg', 'placeholder' => __d('kody_pocztowe', "LC_KODY_POCZTOWE_WPISZ_KOD"), 'name' => 'kod', 'value' => ''));
	                            ?>
	                            <span class="input-group-btn">
	                                <button class="btn btn-success btn-lg" type="submit"
	                                        data-icon="&#xe600;"></button>
	                            </span>
	                        </div>
	                    </form>
	                </div>
	            </div>
	        </div>
	    </div>
		
		
	    <div class="row full" id="display">
	        <div class="col-xs-12 col-sm-10 col-md-8 col-sm-offset-1 col-md-offset-2">
	                
	                <? debug( $adres->getData() ); ?>
					<? debug( $adres->getLayer('kody') ); ?>
					
					<? /*
	                <? if (isset($adresy) && $adresy) { ?>
	                    
	                    <ul class="addresses col-xs-12 col-sm-10 col-md-8 col-sm-offset-1 col-md-offset-2">
	                        <? foreach ($adresy as $adres) { ?>
	                            <li class="row">
	                                <div class="col-sm-4 ulica">
	                                    <?= $adres['Address']['ulica'] ?>
	                                </div>
	                                <div class="col-sm-6 numery">
	                                    <?= $adres['Address']['numery'] ?>
	                                </div>
	                                <div class="col-sm-2 kod">
	                                    <a class="kod"
	                                       href="/dane/kody_pocztowe/<?= $adres['Address']['kod_id'] ?>"><?= $adres['Address']['kod'] ?></a>
	                                </div>
	                            </li>
	                        <? } ?>
	                    </ul>
	                    
	                <? } ?>
	                
	                */ ?>

	        </div>
	    </div>


	</div>
</div>