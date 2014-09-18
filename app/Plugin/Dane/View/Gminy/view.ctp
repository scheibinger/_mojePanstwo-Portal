<?php $this->Combinator->add_libs('js', 'jquery-tags-cloud-min'); ?>
<?php $this->Combinator->add_libs('css', $this->Less->css('view-gminy', array('plugin' => 'Dane'))); ?>
<?php $this->Combinator->add_libs('css', $this->Less->css('dataobjectslider', array('plugin' => 'Dane'))) ?>
<?php if ($object->getId() == '903') $this->Combinator->add_libs('css', $this->Less->css('view-gminy-krakow', array('plugin' => 'Dane'))); ?>

<?php $this->Combinator->add_libs('js', '../plugins/highcharts/js/highcharts'); ?>
<?php $this->Combinator->add_libs('js', '../plugins/highcharts/locals'); ?>
<?php $this->Combinator->add_libs('js', 'Dane.view-gminy'); ?>
<?
echo $this->Element('dataobject/pageBegin');
?>

<div class="gminy row">
<div class="col-lg-3 objectSide">

    <div class="objectSideInner">

        <ul class="dataHighlights side">


            <li class="dataHighlight big">
                <p class="_label">Liczba ludności</p>

                <div>
                    <p class="_value"><?= number_format_h($object->getData('liczba_ludnosci')); ?></p>
                </div>
            </li>

            <li class="dataHighlight big">
                <p class="_label">Powierzchnia</p>

                <div>
                    <p class="_value"><?= number_format($object->getData('powierzchnia'), 0); ?> km<sup>2</sup></p>
                </div>
            </li>


            <li class="dataHighlight topborder">
                <p class="_label">Dochody roczne gminy</p>

                <div>
                    <p class="_value"><?= number_format_h($object->getData('dochody_roczne')); ?> PLN</p>
                </div>
            </li>

            <li class="dataHighlight">
                <p class="_label">Wydatki roczne gminy</p>

                <div>
                    <p class="_value"><?= number_format_h($object->getData('wydatki_roczne')); ?> PLN</p>
                </div>
            </li>

            <li class="dataHighlight">
                <p class="_label">Deficyt roczny gminy</p>

                <div>
                    <p class="_value"><?= number_format_h($object->getData('zadluzenie_roczne')); ?> PLN</p>
                </div>
            </li>


        </ul>

        <ul class="dataHighlights side hide">

            <li class="dataHighlight">
                <p class="_label">Kod TERYT</p>

                <div>
                    <p class="_value"><?= $object->getData('teryt'); ?></p>
                </div>
            </li>

            <li class="dataHighlight">
                <p class="_label">Kod NTS</p>

                <div>
                    <p class="_value"><?= $object->getData('nts'); ?></p>
                </div>
            </li>

            <li class="dataHighlight topborder">
                <p class="_label">Biuletyn Informacji Publicznej</p>

                <div>
                    <p class="_value"><?= $object->getData('bip_www'); ?></p>
                </div>
            </li>

        </ul>

        <p style="display: none;" class="text-center showHideSide">
            <a class="a-more">Więcej &darr;</a>
            <a class="a-less hide">Mniej &uarr;</a>
        </p>

    </div>
</div>


<div class="col-lg-9 objectMain">

<?php if ($object->getId() == '903') { ?>
<div class="objectSearch">
	<div class="input-group">
	    <form method="get" action="/dane/gminy/<?= $object->getId() ?>/szukaj">
	        <input type="text" placeholder="Szukaj w Przejrzystym Krakowie..." autocomplete="off" class="form-control ui-autocomplete-input" name="q">
	        <input type="submit" style="display: none;" name="submit" value="search">
	        <span class="input-group-btn">
	            <button data-icon="" type="button" class="btn btn-success btn-lg"></button>
	        </span>
	    </form>
	</div>
</div>
<? } ?>

<div class="object mpanel">

<div class="block-group">
<?php if ( ($object->getId() == '903') && ($posiedzenie = $object->getLayer('ostatnie_posiedzenie')) && !empty($posiedzenie['data']) && !empty($posiedzenie['terms']) ) { ?>
	
	<div id="prawo" class="block">
        <div class="block-header">
            <h2 class="pull-left label">Tematy na <a href="/dane/gminy/903/posiedzenia/<?= $posiedzenie['data']['id'] ?>">ostatnim posiedzeniu Rady Miasta</a></h2>
            <a class="btn btn-default btn-sm pull-right"
               href="<?= Router::url(array('action' => 'posiedzenia', 'id' => $object->getId())) ?>">
                Wszystkie posiedzenia</a>
        </div>

        <div class="content">
            
            <ul class="objectTagsCloud row">
		        <?
		        
		        $font = array(
		            'min' => 15,
		            'max' => 100,
		        );
		        $font['diff'] = $font['max'] - $font['min'];
		
				$terms = $posiedzenie['terms'];
				
				
				foreach( $terms as &$term )
					$term['size'] = $font['min'] + $font['diff'] * $term['norm_score'];
				
									
		        shuffle( $terms );
		        
		        foreach ($terms as $term) {
		            $href = '/dane/gminy/903/posiedzenia/' . $posiedzenie['data']['id'] . '/punkty?q=' . addslashes( $term['key'] );
		        ?>
		            <li style="font-size: <?= $term['size'] ?>px;"><a href="<?= $href ?>"><?= $term['key'] ?></a></li>
		        <? } ?>
		    </ul>
            
        </div>
    </div>
	
    <div class="special banner">
        <a title="Zobacz umowy podpisywane przez Komitet Konkursowy Kraków 2022" href="/dane/krs_podmioty/481129/umowy">
            <img src="/Dane/img/krakow_special_banner.png" width="885" height="85"/>
        </a>
    </div>
<?php } ?>

<div class="row bottomborder">
    <div class="col-md-4">
		
        <div id="rada" class="block nobottomborder">
            <div class="block-header">
                <h2 class="label">Urząd gminy</h2>
            </div>

            <div class="content">
                <?
                $adres = $object->getData('adres');
                $adres = preg_replace('/([0-9]{2})\-([0-9]{3})/i', "<br/>$1-$2", $adres);
                ?>

                <p><?= $adres ?></p>

                <? if ($szef = $object->getLayer('szef')) { ?>
                    <div id="szef" class="dataHighlights">
                        <div class="dataHighlight big">
                            <p class="_label"><?= $szef['stanowisko'] ?>:</p>

                            <p class="_value"><?= $szef['nazwa'] ?></p>
                        </div>
                    </div>
                <? } ?>
            </div>

        </div>

    </div>
    <div class="col-md-8">
        <div id="rada" class="block nobottomborder">
            <div class="block-header">
                <h2 class="pull-left label"><?php echo __d('dane', 'LC_GMINY_WYNIKI_WYBOROW'); ?></h2>
                <a class="btn btn-default btn-sm pull-right"
                   href="<?= Router::url(array('action' => 'radni', 'id' => $object->getId())) ?>">Zobacz
                    wszystkich radnych</a>
            </div>

            <script type="text/javascript">
                var wyniki_wyborow = <?= json_encode($object->getLayer('rada_komitety')); ?>;
            </script>
            <div id="komitety_chart">

            </div>


        </div>
    </div>
</div>


<div class="row bottomborder">
    <div class="col-md-6">

        <div id="organizacje" class="block nobottomborder">
            <div class="block-header">
                <h2 title="Największe spółki pod względem kapitału zakładowego" class="pull-left label">Największe
                    spółki</h2>
                <a class="btn btn-default btn-sm pull-right"
                   href="<?= Router::url(array('action' => 'organizacje', 'id' => $object->getId())) ?>">Zobacz
                    wszystkie</a>
            </div>

            <div class="content">

                <ul class="raw">
                    <? foreach ($organizacje as $organizacja) { ?>
                        <li class="list-group-item"><? if ($organizacja->getData('wartosc_kapital_zakladowy')) { ?><span
                                class="badge"><?= number_format_h($organizacja->getData('wartosc_kapital_zakladowy')) ?></span><? } ?>
                            <a href="<?= $organizacja->getUrl() ?>"><?= $this->Text->truncate($organizacja->getShortTitle(), 25); ?></a>
                        </li>
                    <? } ?>
                </ul>

            </div>
        </div>

    </div>
    <div class="col-md-6">

        <div id="organizacje" class="block nobottomborder">
            <div class="block-header">
                <h2 title="Organizacje pozarządowe w gminie" class="pull-left label">Organizacje pozarządowe</h2>
                <a class="btn btn-default btn-sm pull-right"
                   href="<?= Router::url(array('action' => 'organizacje', 'id' => $object->getId())) ?>">Zobacz
                    wszystkie</a>
            </div>

            <div class="content">
                <?
                if (!empty($ngos)) {
                    ?>
                    <ul class="raw">
                        <?
                        $limit = 5;
                        $i = 0;

                        foreach ($ngos as $ngo) {
                            $i++;
                            ?>

                            <li class="list-group-item"><span class="badge"><?= number_format_h($ngo['count']) ?></span><a
                                    href="<?= Router::url(array('action' => 'organizacje', 'id' => $object->getId(), '?' => array('forma_prawna_id' => $ngo['id']))) ?>"
                                    title="<?= addslashes($ngo['label']) ?>"><?= $this->Text->truncate($ngo['label'], 25); ?></a>
                            </li>
                            <?
                            if ($i == $limit)
                                break;
                        }
                        ?>
                    </ul>
                <?
                }
                ?>
            </div>
        </div>

    </div>
</div>



<? if ($object->getId() == 903) { ?>
    
    <? /*
    <div id="rada" class="block">
        <div class="block-header">
            <h2 class="pull-left label">Posiedzenia rady miasta</h2>
            <a class="btn btn-default btn-sm pull-right"
               href="<?= Router::url(array('action' => 'posiedzenia', 'id' => $object->getId())) ?>">Zobacz
                wszystkie</a>
        </div>

        <div class="content">
            <div class="dataobjectsSliderRow row">
                <div>
                    <?php echo $this->dataobjectsSlider->render($rady_posiedzenia, array(
                        'perGroup' => 3,
                        'rowNumber' => 1,
                        'labelMode' => 'none',
                        'file' => 'rady_posiedzenia-gminy',
                    )) ?>
                </div>
            </div>
        </div>
    </div>
    */ ?>

    <div id="prawo" class="block">
        <div class="block-header">
            <h2 class="pull-left label">Najnowsze uchwały rady miasta</h2>
            <a class="btn btn-default btn-sm pull-right"
               href="<?= Router::url(array('action' => 'rada_uchwaly', 'id' => $object->getId())) ?>">Zobacz
                wszystkie</a>
        </div>

        <div class="content">
            <div class="dataobjectsSliderRow row">
                <div>
                    <?php echo $this->dataobjectsSlider->render($prawo_lokalne, array(
                        'perGroup' => 2,
                        'rowNumber' => 1,
                        'descriptionMode' => 'none',
                    )) ?>
                </div>
            </div>
        </div>
    </div>

    <? /*
		            <div id="materialy" class="block">
		                <div class="block-header">
		                    <h2 class="pull-left label">Materiały na posiedzenia rady miasta</h2>
		                    <a class="btn btn-default btn-sm pull-right" href="<?= Router::url(array('action' => 'druki', 'id' => $object->getId())) ?>">Zobacz
		                        wszystkie</a>
		                </div>
		
		                <div class="content">
		                    <div class="dataobjectsSliderRow row">
		                        <div>
		                            <?php echo $this->dataobjectsSlider->render($rady_druki, array(
		                                'perGroup' => 3,
		                                'rowNumber' => 1,
		                                'labelMode' => 'none',
		                                // 'dfFields' => array('data_publikacji'),
		                            )) ?>
		                        </div>
		                    </div>
		                </div>
		            </div>
		            */
    ?>


    <? /*
		            <div class="block">
		            	<div class="row">
			            	<div class="col-lg-6">
			            		
			            		<div id="rada">
						            <div class="block-header">
						                <h2 class="label pull-left"><?php echo __d('dane', 'LC_GMINY_WYNIKI_WYBOROW'); ?></h2>
						                <a class="btn btn-default btn-sm pull-right" href="<?= Router::url(array('action' => 'radni', 'id' => $object->getId())) ?>">Zobacz wszystkich radnych</a>
						            </div>
						
						            <div class="content wynikiWyborow">
						                <?php foreach ($object->getLayer('rada_komitety') as $rada) { ?>
						                    <div class="wynik">
						                        <a href="<?= Router::url(array('action' => 'radni', 'id' => $object->getId(), '?' => array('komitet_id' => $rada['pl_gminy_radni']['komitet_id']))) ?>">
						                            <?php echo $rada['pkw_komitety']['nazwa']; ?>
						                        </a>
						                        <small><?php echo pl_dopelniacz($rada[0]['count'], 'radny', 'radnych', 'radnych'); ?></small>
						
						                        <div class="progress">
						                            <div class="progress-bar progress-bar-default" role="progressbar" aria-valuenow="73.3"
						                                 aria-valuemin="0" aria-valuemax="100"
						                                 style="width: <?php echo $rada['percent']; ?>%">
						                            </div>
						                        </div>
						                    </div>
						                <?php } ?>
						            </div>
						
					                
				
						        </div>
			            		
			            	</div><div class="col-lg-6">
			            		
			            		<div class="block-header">
					                <h2 class="labe pull-left">Radni dzielnic</h2>
					                <a class="btn btn-default btn-sm pull-right" href="<?= Router::url(array('action' => 'radni_dzielnic', 'id' => $object->getId())) ?>">Zobacz wszystkich radnych</a>
					            </div>
					
					            <div class="content dzielnice">
					                
					                <p>Wybierz dzielnicę, aby zobaczyć radnych:</p>
					                
					                <? if( !empty($dzielnice) ) {?>
					                <ul>
					                	<? foreach( $dzielnice as $dzielnica ) {?>
					                	
					                	<li><a href="/dane/dzielnice/<?= $dzielnica->getId() ?>"><?= $dzielnica->getTitle() ?></a></li>
					                	
					                	<? } ?>
					                </ul>
					                <? } ?>
					                
					            </div>
			            		
			            	</div>
		            	</div>
		            
		            
		            </div>
		            <? */
    ?>

<? } ?>




<div id="zamowienia_publiczne_otwarte" class="block">
    <div class="block-header">
        <h2 class="pull-left label">Najnowsze ogłoszenia o zamówieniach publicznych</h2>
        <a class="btn btn-default btn-sm pull-right"
           href="<?= Router::url(array('action' => 'zamowienia', 'id' => $object->getId())) ?>">Zobacz
            wszystkie</a>
    </div>

    <div class="content">
        <div class="dataobjectsSliderRow row">
            <div>
                <?php echo $this->dataobjectsSlider->render($zamowienia_otwarte, array(
                    'perGroup' => 2,
                    'rowNumber' => 1,
                    'labelMode' => 'none',
                )) ?>
            </div>
        </div>
    </div>
</div>


<div id="zamowienia_publiczne_zamkniete" class="block">
    <div class="block-header">
        <h2 class="pull-left label">Najnowsze rozstrzygnięcia zamówień publicznych</h2>
        <a class="btn btn-default btn-sm pull-right"
           href="<?= Router::url(array('action' => 'zamowienia', 'id' => $object->getId())) ?>">Zobacz
            wszystkie</a>
    </div>

    <div class="content">
        <div class="dataobjectsSliderRow row">
            <div>
                <?php echo $this->dataobjectsSlider->render($zamowienia_zamkniete, array(
                    'perGroup' => 2,
                    'rowNumber' => 1,
                    'labelMode' => 'none',
                )) ?>
            </div>
        </div>
    </div>
</div>


<? /*
		        <div id="dotacje_unijne" class="block">
		            <div class="block-header">
		                <h2 class="pull-left label">Dotacje unijne</h2>
		                <a class="btn btn-default btn-sm pull-right" href="<?= Router::url(array('action' => 'dotacje_ue', 'id' => $object->getId())) ?>">Zobacz
		                    wszystkie</a>
		            </div>
		
		            <div class="content">
		                <div class="dataobjectsSliderRow row">
		                    <div>
		                        <?php echo $this->dataobjectsSlider->render($dotacje_ue, array(
		                            'perGroup' => 2,
		                            'rowNumber' => 1,
		                            'labelMode' => 'none',
		                        )) ?>
		                    </div>
		                </div>
		            </div>
		        </div>
		        */
?>


</div>

</div>
</div>
</div>

<?= $this->Element('dataobject/pageEnd'); ?>
