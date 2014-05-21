<?php $this->Combinator->add_libs('css', $this->Less->css('dataobject', array('plugin' => 'Dane'))) ?>
<?php $this->Combinator->add_libs('css', $this->Less->css('dataobjectslider', array('plugin' => 'Dane'))) ?>
<?php $this->Combinator->add_libs('css', $this->Less->css('zamowienia', array('plugin' => 'ZamowieniaPubliczne'))) ?>

<?php $this->Combinator->add_libs('js', '../plugins/highstock/js/highstock'); ?>
<?php $this->Combinator->add_libs('js', '../plugins/highstock/locals'); ?>
<?php $this->Combinator->add_libs('js', 'ZamowieniaPubliczne.zamowieniapubliczne') ?>
<?php $this->Combinator->add_libs('js', 'Dane.dataobjectsslider') ?>

<div class="container" id="zamowienia">
	
	<div class="banner">
		<p>W ciągu ostatniego miesiąca, Twoje Państwo udzieliło zamówień na </p>

		<p class="number"><?= $this->Waluta->slownie($stats['zamowienia']['total']) ?></p>
		
		<p>w tym:</p>
	</div>
	
	<div class="row">
		
		<? foreach( $stats['zamowienia']['rodzaje'] as $rodzaj ) { ?>
		<div class="col-lg-4">
			
			<p class="number small"><?= $this->Waluta->slownie($rodzaj['total']) ?></p>

			<h2><span>na</span> <?= $rodzaj['nazwa'] ?></h2>
			
			<h3>Najwięcej zamówili:</h3>
			
			<ul>
			<? foreach( $rodzaj['zamawiajacy'] as $zamawiajacy ) {?>
				<li>
					<p><?= $zamawiajacy['nazwa'] ?></p>
					<p><?= pl_dopelniacz($zamawiajacy['liczba_zamowien'], 'zamówienie', 'zamówienia', 'zamówień') ?> na kwotę <?= $this->Waluta->slownie($zamawiajacy['wartosc']) ?></p>
				</li>
			<?}?>
			</ul>			
						
		</div>
		<? } ?>
		
	</div>
	
	
	
	
	
	<? /*
    <div class="banner">
        <h1><?php echo __d('zamowienia_publiczne', "LC_ZAMOWIENIA_PUBLICZNE_HEADLINE"); ?></h1>

        <p><?php echo __d('zamowienia_publiczne', "LC_ZAMOWIENIA_PUBLICZNE_SUBHEADLINE"); ?></p>
    </div>
	*/ ?>
    
	
	<? /*
    <div class="dataobjectsSliderRow">
        <div class="row header">
            <div class="col-xs-12 col-sm-6 left">
                <h2>
                    <a href="/dane/zamowienia_publiczne?rodzaj_id=2"><?php echo __d('zamowienia_publiczne', "LC_ZAMOWIENIA_PUBLICZNE_USLUGI"); ?></a>
                </h2>
            </div>
            <div class="col-xs-6 col-xs-offset-6 col-sm-6 col-sm-offset-0 right">

            </div>
        </div>
        <div class="blockContent">
            <?php echo $this->dataobjectsSlider->render($uslugi, array('rowNumber' => 1)); ?>
        </div>
    </div>

    <div class="dataobjectsSliderRow">
        <div class="row header">
            <div class="col-xs-12 col-sm-6 left">
                <h2>
                    <a href="/dane/zamowienia_publiczne?rodzaj_id=3"><?php echo __d('zamowienia_publiczne', "LC_ZAMOWIENIA_PUBLICZNE_DOSTAWY_SPRZETU_I_MATERIALOW"); ?></a>
                </h2>
            </div>
            <div class="col-xs-6 col-xs-offset-6 col-sm-6 col-sm-offset-0 right">

            </div>
        </div>
        <div class="blockContent">
            <?php echo $this->dataobjectsSlider->render($dostawy, array('rowNumber' => 1)); ?>
        </div>
    </div>

    <div class="dataobjectsSliderRow">
        <div class="row header">
            <div class="col-xs-12 col-sm-6 left">
                <h2>
                    <a href="/dane/zamowienia_publiczne?rodzaj_id=1"><?php echo __d('zamowienia_publiczne', "LC_ZAMOWIENIA_PUBLICZNE_ROBOTY_BUDOWLANE"); ?></a>
                </h2>
            </div>
            <div class="col-xs-6 col-xs-offset-6 col-sm-6 col-sm-offset-0 right">

            </div>
        </div>
        <div class="blockContent">
            <?php echo $this->dataobjectsSlider->render($roboty, array('rowNumber' => 1)); ?>
        </div>
    </div>
    */ ?>


</div>