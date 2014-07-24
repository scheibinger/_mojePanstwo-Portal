<?
echo $this->Combinator->add_libs('css', $this->Less->css('view-gminy', array('plugin' => 'Dane')));
if ($object->getId() == '903') $this->Combinator->add_libs('css', $this->Less->css('view-gminy-krakow', array('plugin' => 'Dane')));

echo $this->Element('dataobject/pageBegin', array(
    'titleTag' => 'p',
));

echo $this->Element('Dane.dataobject/menuTabs', array(
    'menu' => $_menu,
));

echo $this->Element('Dane.dataobject/subobject', array(
    'menu' => isset($_submenu) ? $_submenu : false,
    'object' => $radny,
    'objectOptions' => array(
        'hlFields' => array(),
        'bigTitle' => true,
    )
));

?>

    <div class="krsOsoba row">
    <div class="col-lg-3 objectSide">
        <div class="objectSideInner">
            <ul class="dataHighlights side">

                <? if ($radny->getData('aktywny') == '0') { ?>
                    <li class="dataHighlight">
                        <span class="label label-danger">Ta osoba nie jest już radnym</span>
                    </li>
                <? } ?>

                <li class="dataHighlight big">
                    <p class="_label">Liczba głosów</p>

                    <p class="_value pull-left"><?= _number($radny->getData('liczba_glosow')); ?></p>

                    <p class="pull-right nopadding"><a class="btn btn-sm btn-default"
                                                       href="/dane/gminy/<?= $object->getId() ?>/okregi_wyborcze/<?= $radny->getData('okreg_id') ?>">Wyniki
                            w okręgu &raquo;</a></p>
                </li>

                <li class="dataHighlight big">
                    <p class="_label">Poparcie w okręgu</p>

                    <p class="_value"><?= $radny->getData('procent_glosow_w_okregu'); ?>%</p>
                </li>

                <li class="dataHighlight">
                    <p class="_label">Komitet</p>

                    <p class="_value"><?= $radny->getData('rady_gmin_komitety.skrot_nazwy'); ?></p>
                </li>

                <li class="dataHighlight">
                    <p class="_label">Pozycja na liście</p>

                    <p class="_value"><?= $radny->getData('pozycja'); ?></p>
                </li>

                <li class="dataHighlight">
                    <p class="_label">Rok urodzenia</p>

                    <p class="_value"><?= $radny->getData('rok_urodzenia'); ?></p>
                </li>

            </ul>

        </div>
    </div>

    <div class="col-lg-9 objectMain">
        <div class="object mpanel" style="margin-bottom: 20px;">

            <div class="block-group">

                <? if ($radny->getData('aktywny') == '0') { ?>

                    <div id="rezygnacja" class="block">

                        <div class="block-header">
                            <h2 class="label">Data utraty mandatu</h2>
                        </div>

                        <div class="content">
                            <p><?= $this->Czas->dataSlownie($radny->getData('data_rezygnacji')) ?></p>
                        </div>
                    </div>

                    <div id="rezygnacja" class="block">

                        <div class="block-header">
                            <h2 class="label">Przyczyna utraty mandatu</h2>
                        </div>

                        <div class="content">
                            <p><?= ucfirst($radny->getData('rezygnacja_podstawa_prawna')) ?></p>
                        </div>
                    </div>
                <? } ?>

                <?
                if ($object->getId() == '903') {

                    $this->Combinator->add_libs('css', $this->Less->css('dataobjectslider', array('plugin' => 'Dane')));

                    $details = $radny->getLayer('details');
                    $opis = preg_replace('/\<a (.*?)\>(.*?)\<\/a\>/i', '', $details['opis_html']);
                    $opis = str_ireplace(array('- <br>'), '<br/>', $opis);

                    ?>

                    <? if ($details) { ?>
                        <div id="info" class="block">

                            <div class="content">
                                <?= stripslashes($opis) ?>
                            </div>
                        </div>
                    <? } ?>

                    <? if ($d = $radny->getLayer('najblizszy_dyzur')) { ?>
                        <script type="text/javascript" src="http://js.addthisevent.com/atemay.js"></script>
                        <? $this->Combinator->add_libs('css', $this->Less->css('view-gminy-dyzury', array('plugin' => 'Dane'))); ?>
                        <div id="dyzury" class="block">

                            <div class="block-header">
                                <h2 class="label pull-left">Najbliższy dyżur</h2>
                                <a class="btn btn-default btn-sm pull-right"
                                   href="/dane/gminy/<?= $object->getId() ?>/radni/<?= $radny->getId() ?>/dyzury">Zobacz
                                    wszystkie dyżury</a>
                            </div>

                            <div class="content">
                                <ul>
                                    <li style="margin: 15px 0;">
                                        <div class="row">
                                            <div class="col-md-2">
                                                <b><?= $this->Czas->dataSlownie($d['data']) ?></b>
                                            </div>
                                            <div class="col-md-2">
                                                <?= $d['godz_str'] ?>
                                            </div>
                                            <div class="col-md-3">
                                                <?= $d['adres'] ?>
                                            </div>
                                            <div class="col-md-3">
                                                <?= $d['adres_wiecej'] ?>
                                            </div>
                                            <div class="col-md-2">
                                                <a href="http://example.com/link-to-your-event"
                                                   title="Dodaj do kalendarza" class="addthisevent">
                                                    Dodaj do kalendarza
                                                    <? if ($d['timestart'] && ($d['timestart'] != '0000-00-00 00:00:00')) { ?>
                                                        <span class="_start"><?= $d['timestart'] ?></span><? } ?>
                                                    <? if ($d['timestop'] && ($d['timestop'] != '0000-00-00 00:00:00')) { ?>
                                                        <span class="_end"><?= $d['timestop'] ?></span><? } ?>
                                                    <span class="_zonecode">41</span>
                                                    <span
                                                        class="_summary">Dyżur poselski <?= $radny->getData('nazwa') ?></span>
                                                    <span class="_description"><?= $d['godz_str'] ?>
                                                        , <?= $d['adres'] ?></span>
                                                    <span class="_location"><?= $d['adres_wiecej'] ?></span>
                                                    <span class="_organizer"><?= $radny->getData('nazwa') ?></span>
                                                    <span
                                                        class="_organizer_email"><?= $radny->getData('email') ?></span>
                                                    <span
                                                        class="_all_day_event"><? if ($d['timestart'] && ($d['timestart'] != '0000-00-00 00:00:00') && $d['timestop'] && ($d['timestop'] != '0000-00-00 00:00:00')) { ?>false<? } else { ?>true<? } ?></span>
										    <span class="_date_format"><?
                                                $parts = explode('-', $d['data']);
                                                echo $parts[2] . '/' . $parts[1] . '/' . $parts[0];
                                                ?></span>
                                                </a>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    <? } ?>

                <? } ?>




                <? if ($object->getId() == '903') { ?>

                    <? if (isset($wystapienia)) { ?>
                        <div id="wystapienia" class="block">

                            <div class="block-header">
                                <h2 class="label pull-left">Wystąpienia na posiedzeniach rady</h2>
                                <a class="btn btn-default btn-sm pull-right"
                                   href="/dane/gminy/<?= $object->getId() ?>/radni/<?= $radny->getId() ?>/wystapienia">Zobacz
                                    wszystkie</a>
                            </div>


                            <div class="content">
                                <div class="dataobjectsSliderRow row">
                                    <div>
                                        <?php echo $this->dataobjectsSlider->render($wystapienia, array(
                                            'perGroup' => 3,
                                            'rowNumber' => 1,
                                            'labelMode' => 'none',
                                            // 'file' => 'rady_posiedzenia-gminy',
                                        )) ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <? } ?>

                    <? if (isset($interpelacje)) { ?>
                        <div id="interpelacje" class="block">

                            <div class="block-header">
                                <h2 class="label pull-left">Interpelacje</h2>
                                <a class="btn btn-default btn-sm pull-right"
                                   href="/dane/gminy/<?= $object->getId() ?>/radni/<?= $radny->getId() ?>/interpelacje">Zobacz
                                    wszystkie</a>

                            </div>


                            <div class="content">
                                <div class="dataobjectsSliderRow row">
                                    <div>
                                        <?php echo $this->dataobjectsSlider->render($interpelacje, array(
                                            'perGroup' => 2,
                                            'rowNumber' => 1,
                                            'labelMode' => 'none',
                                            // 'file' => 'rady_posiedzenia-gminy',
                                        )) ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <? } ?>


                <? } ?>

                <? if (isset($osoba) && $osoba) {
                    echo $this->Element('Dane.objects/krs_osoby/organizacje', array(
                        'organizacje' => $osoba->getLayer('organizacje'),
                    ));
                } ?>

            </div>

        </div>
    </div>
    </div>

<? echo $this->Element('dataobject/pageEnd');