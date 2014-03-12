<?php $this->Combinator->add_libs('css', $this->Less->css('view-gminy', array('plugin' => 'Dane'))); ?>
<?php $this->Combinator->add_libs('css', $this->Less->css('dataobjectslider', array('plugin' => 'Dane'))) ?>

<?php $this->Combinator->add_libs('js', 'Dane.view-gminy'); ?>

<?= $this->Element('dataobject/pageBegin'); ?>

<div class="gminy row">
<div class="col-md-2">
    <div class="objectMenu vertical">
        <ul class="nav nav-pills nav-stacked row">
            <li class="active">
                <a href="#info" class="normalizeText">Info</a>
            </li>
            <? foreach ($_menu as $m) { ?>
                <li>
                    <a class="normalizeText" href="#<?= $m['id'] ?>"><?= $m['label'] ?></a>
                </li>
            <? } ?>
        </ul>
    </div>
</div>

<div class="col-md-10">
<div class="objectsPageContent main">
    <div class="object">
        <div id="info" class="profile_baner" data-adres="<?= urlencode($object->getData('adres')) ?>">
            <div class="bg">
                <img
                    src="http://maps.googleapis.com/maps/api/staticmap?center=<?= urlencode($object->getData('adres')) ?>&markers=<?= urlencode($object->getData('adres')) ?>&zoom=13&sensor=false&size=640x140&scale=2&feature:road"/>

                <div class="content">
                    <?
                    $adres = $object->getData('adres');
                    $adres = preg_replace('/([0-9]{2})\-([0-9]{3})/i', "<br/>$1-$2", $adres);
                    ?>
                    <h2><?= $object->getData('nazwa_urzedu') ?></h2>

                    <p><?= $adres ?></p>
                    <button class="btn btn-info"><?= __d('dane', 'LC_DANE_VIEW_KRSPODMIOTY_OTWORZ_MAPE') ?></button>
                </div>
            </div>

            <div id="googleMap">
                <script>
                    var googleMapAdres = '<?= $object->getData('adres') ?>';
                </script>
            </div>
        </div>
        <!-- profile_baner END -->

        <? if ($object->getId() == 903) { ?>
            <div id="rada" class="block">
                <div class="block-header">
                    <h2 class="pull-left">Posiedzenia rady miasta</h2>
                    <a class="btn btn-default btn-sm pull-right" href="/dane/gminy/<?= $object->getId() ?>/posiedzenia">Zobacz
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

            <div id="prawo" class="block bg">
                <div class="block-header">
                    <h2 class="pull-left">Najnowsze prawo lokalne</h2>
                    <a class="btn btn-default btn-sm pull-right" href="/dane/gminy/<?= $object->getId() ?>/prawo">Zobacz
                        wszystkie</a>
                </div>

                <div class="content">
                    <div class="dataobjectsSliderRow row">
                        <div>
                            <?php echo $this->dataobjectsSlider->render($prawo_lokalne, array(
                                'perGroup' => 3,
                                'rowNumber' => 1,
                                'descriptionMode' => 'none',
                            )) ?>
                        </div>
                    </div>
                </div>
            </div>

            <div id="materialy" class="block">
                <div class="block-header">
                    <h2 class="pull-left">Materiały na posiedzenia rady miasta</h2>
                    <a class="btn btn-default btn-sm pull-right" href="/dane/gminy/<?= $object->getId() ?>/druki">Zobacz
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

        <? } ?>

        <div id="rada" class="block bg">
            <div class="block-header">
                <h2 class="pull-left"><?php echo __d('dane', 'LC_GMINY_WYNIKI_WYBOROW'); ?></h2>
                <a class="btn btn-default btn-sm pull-right" href="/dane/gminy/<?= $object->getId() ?>/radni">Zobacz
                    wszystkich radnych</a>
            </div>

            <div class="content wynikiWyborow">
                <?php foreach ($object->getLayer('rada_komitety') as $rada) { ?>
                    <div class="wynik">
                        <a href="/dane/gminy/<?= $object->getId() ?>/radni?komitet_id=<?= $rada['pl_gminy_radni']['komitet_id'] ?>">
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

            <? if ($object->getId() == 903) { ?>
                <div class="darczyncy">
                    <a class="btn btn-default" href="/dane/gminy/903/darczyncy">Lista wpłat dla komitetów
                        wyborczych</a>
                </div>
            <? } ?>
        </div>

        <div id="zamowienia_publiczne" class="block">
            <div class="block-header">
                <h2 class="pull-left">Zamówienia publiczne</h2>
                <a class="btn btn-default btn-sm pull-right" href="/dane/gminy/<?= $object->getId() ?>/zamowienia">Zobacz
                    wszystkie</a>
            </div>

            <div class="content">
                <div class="dataobjectsSliderRow row">
                    <div>
                        <?php echo $this->dataobjectsSlider->render($zamowienia, array(
                            'perGroup' => 3,
                            'rowNumber' => 1,
                            'labelMode' => 'none',
                            'dfFields' => array('data_publikacji'),
                        )) ?>
                    </div>
                </div>
            </div>
        </div>

        <div id="dotacje_unijne" class="block bg">
            <div class="block-header">
                <h2 class="pull-left">Dotacje unijne</h2>
                <a class="btn btn-default btn-sm pull-right" href="/dane/gminy/<?= $object->getId() ?>/dotacje_ue">Zobacz
                    wszystkie</a>
            </div>

            <div class="content">
                <div class="dataobjectsSliderRow row">
                    <div>
                        <?php echo $this->dataobjectsSlider->render($dotacje_ue, array(
                            'perGroup' => 3,
                            'rowNumber' => 1,
                            'labelMode' => 'none',
                            'dfFields' => array('data_podpisania'),
                        )) ?>
                    </div>
                </div>
            </div>
        </div>

        <div id="organizacje" class="block">
            <div class="block-header">
                <h2 class="pull-left">Organizacje w tej gminie</h2>
                <a class="btn btn-default btn-sm pull-right" href="/dane/gminy/<?= $object->getId() ?>/organizacje">Zobacz
                    wszystkie</a>
            </div>

            <div class="content">
                <div class="dataobjectsSliderRow row">
                    <div>
                        <?php echo $this->dataobjectsSlider->render($organizacje, array(
                            'perGroup' => 3,
                            'rowNumber' => 1
                        )) ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- object END -->
</div>
<!-- objectsPageContent END -->
<? if ($object->getId() == '903') { ?>
    <div class="customObject krakow903 col-md-12">
        <div class="row">
            <div class="logo col-md-4 pull-left">
                <img align="left" alt="Przejrzysty Kraków"
                     src="//sejmometr.pl/g/customObject/krakow/logo_pkrk.jpg">
            </div>
            <div class="textline col-md-6">
                Program Przejrzysty Kraków, prowadzony przez Fundację Stańczyka, ma na celu wieloaspektowy
                monitoring
                życia publicznego w Krakowie. W ramach programu prowadzony jest obecnie monitoring Rady
                Miasta i
                Dzielnic Krakowa.
            </div>
            <div class="logo col-md-2 pull-right">
                <img align="right" alt="Fundacja Stańczyk"
                     src="//sejmometr.pl/g/customObject/krakow/logo_fundacja_stanczyk.jpg">
            </div>
        </div>
    </div>
<? } ?>
</div>
</div>

<?= $this->Element('dataobject/pageEnd'); ?>

<?php /* echo $this->Element('dataobject/pageBegin'); ?>
    <div class="object">
        <? $wsk_groups = array_chunk($wskazniki, 5); ?>
        <div class="wskazniki">
            <? foreach ($wsk_groups as $wskazniki) { ?>
                <div class="wskaznikiLine">
                    <? foreach ($wskazniki as $wskaznik) { ?>
                        <div class="wskaznik text-center">
                            <small><?php echo $wskaznik['pl_wskazniki']['tytul']; ?></small>
                            <strong><?php echo $this->Number->toReadableQuantity($wskaznik['pl_wskazniki_gminy']['lv'], 2, $wskaznik['pl_wskazniki']['jednostka'] == '%'); ?> <?php echo $wskaznik['pl_wskazniki']['jednostka']; ?></strong>
                        </div>
                    <? } ?>
                </div>
            <? } ?>
        </div>

        <div class="col-lg-12">
            <h2><?= $object->getData('nazwa_urzedu'); ?></h2>

            <div class="textblock">
                <p><?php echo $object->getData('adres'); ?></p>

                <p>
                    <a href="<?php echo (preg_match('/http\:\/\/|https\:\/\//', $object->getData('bip_www'))) ? $object->getData('bip_www') : 'http://' . $object->getData('bip_www'); ?>"
                       target="_blank"><?php echo __d('dane', 'LC_DANE_BIP'); ?></a>
                </p>

                <p>
                    <a href="mailto:<?php echo $object->getData('email'); ?>"><?php echo __d('dane', 'LC_DANE_ADRES_EMAIL'); ?></a>
                </p>

                <p><?php echo __d('dane', 'LC_DANE_TELEFON'); ?>
                    : <?php echo $object->getData('telefon'); ?></p>

                <p><?php echo __d('dane', 'LC_DANE_FAX'); ?>: <?php echo $object->getData('fax'); ?></p>
            </div>

            <? if ($object->getId() == '903') { ?>
                <h2>
                    <a href="/dane/gminy/<?= $object->getId() ?>/rady_posiedzenia"><?php echo __d('dane', 'LC_GMINY_POSIEDZENIA_GMINY'); ?></a>
                </h2>
                <div
                    class="radyPosiedzenia"><? echo $this->dataobjectsSlider->render($rady_posiedzenia, array('perGroup' => 2, 'theme' => 'rada-gminy-posiedzenie-start')); ?></div>
                <p class="well well-sm">Zobacz też <a href="/dane/gminy/<?= $object->getId() ?>/rady_gmin_debaty">listę
                        debat</a> oraz <a href="/dane/gminy/<?= $object->getId() ?>/rady_gmin_wystapienia">listę
                        wystąpień</a> na wszystkich posiedzeniach rady miasta <?= $object->getData('nazwa') ?>.</p>

                <h2>
                    <a href="/dane/gminy/<?= $object->getId() ?>/prawo_lokalne"><?php echo __d('dane', 'LC_GMINY_NAJNOWSZE_PRAWO_LOKALNE'); ?></a>
                </h2>
                <div
                    class="prawoLokalne"><? echo $this->dataobjectsSlider->render($prawo_lokalne, array('perGroup' => 2)); ?></div>
            <? } ?>

            <? if ($object->getId() == '903') { ?>
                <h2>
                    <a href="/dane/gminy/<?= $object->getId() ?>/rady_druki"><?php echo __d('dane', 'LC_GMINY_MATERIALY_PRACACH'); ?></a>
                </h2>
                <div
                    class="radyDruki"><? echo $this->dataobjectsSlider->render($rady_druki, array('perGroup' => 4)); ?>
                </div>
            <? } ?>

            <h2><a href="/dane/gminy/<?= $object->getId() ?>/radni"><?php echo __d('dane', 'LC_GMINY_RADNI'); ?></a>
            </h2>

            <div class="radniGminy"><? echo $this->dataobjectsSlider->render($radni, array(
                    'perGroup' => 4,
                    'theme' => 'gmina'
                )); ?>
            </div>

            

            <? if ($object->getId() == '903') { ?>
                <div class="jumbotron">
                    <p><?php echo __d('dane', 'LC_GMINY_LISTA_DARCZYNCOW'); ?></p>

                    <p><a href="/dane/gminy/<?= $object->getId() ?>/darczyncy" class="btn btn-primary">Zobacz</a></p>
                </div>
            <? } ?>

            <h2>
                <a href="/dane/gminy/<?= $object->getId() ?>/zamowienia_publiczne"><?php echo __d('dane', 'LC_GMINY_ZAMOWIENIA_PUBLICZNE'); ?></a>
            </h2>

            <div class="zamowieniaPubliczne"><? echo $this->dataobjectsSlider->render($zamowienia_publiczne, array(
                    'perGroup' => 4,
                )); ?>
            </div>
        </div>
    </div>

<? if ($object->getId() == '903') { ?>
    <div class="customObject krakow903 col-md-12">
        <div class="row">
            <div class="logo col-md-4 pull-left">
                <img align="left" alt="Przejrzysty Kraków" src="//sejmometr.pl/g/customObject/krakow/logo_pkrk.jpg">
            </div>
            <div class="textline col-md-6">
                Program Przejrzysty Kraków, prowadzony przez Fundację Stańczyka, ma na celu wieloaspektowy monitoring
                życia publicznego w Krakowie. W ramach programu prowadzony jest obecnie monitoring Rady Miasta i
                Dzielnic Krakowa.
            </div>
            <div class="logo col-md-2 pull-right">
                <img align="right" alt="Fundacja Stańczyk"
                     src="//sejmometr.pl/g/customObject/krakow/logo_fundacja_stanczyk.jpg">
            </div>
        </div>
    </div>
<? } ?>
<?php echo $this->Element('dataobject/pageEnd'); */
?>
