<?php $this->Combinator->add_libs('css', $this->Less->css('view-gminy', array('plugin' => 'Dane'))); ?>
<?php $this->Combinator->add_libs('css', $this->Less->css('dataobjectslider', array('plugin' => 'Dane'))) ?>

<?php echo $this->Element('dataobject/pageBegin'); ?>
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

            <h2><?php echo __d('dane', 'LC_GMINY_WYNIKI_WYBOROW'); ?></h2>

            <div class="wynikiWyborow">
                <?php foreach ($rada_komitety as $rada) { ?>
                    <div class="wynik">
                        <strong>
                            <a href="/dane/gminy/<?= $object->getId() ?>/radni?komitet_id=<?= $rada['pl_gminy_radni']['komitet_id'] ?>">
                                <?php echo $rada['pkw_komitety']['nazwa']; ?>
                            </a>
                            <small>(<?php echo $rada['percent']; ?>%)</small>
                        </strong>

                        <div class="progress">
                            <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="73.3"
                                 aria-valuemin="0" aria-valuemax="100"
                                 style="width: <?php echo $rada['percent']; ?>%">
                            </div>
                        </div>
                    </div>
                <?php } ?>
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
<?php echo $this->Element('dataobject/pageEnd'); ?>