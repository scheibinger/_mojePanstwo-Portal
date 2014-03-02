<?= $this->Element('dataobject/pageBegin'); ?>

<?php
/*echo $this->Html->script('Dane.arbor/lib/arbor', array('block' => 'scriptBlock'));
echo $this->Html->script('Dane.arbor/lib/arbor-tween', array('block' => 'scriptBlock'));
echo $this->Html->script('Dane.arbor/lib/arbor-graphic', array('block' => 'scriptBlock'));*/
?>

<?php $this->Combinator->add_libs('css', $this->Less->css('view-krspodmioty', array('plugin' => 'Dane'))); ?>
<?php $this->Combinator->add_libs('js', 'Dane.view-krspodmioty'); ?>



    <div class="krsPodmioty row">
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

        <?
        $adres = $object->getData('adres_ulica');
        $adres .= ' ' . $object->getData('adres_numer');
        $adres .= ', ' . $object->getData('adres_miejscowosc');
        $adres .= ', Polska';
        ?>
		
		 <div class="profile_baner" data-adres="<?= urlencode($adres) ?>">
            <div class="bg">
                <img
                    src="http://maps.googleapis.com/maps/api/staticmap?center=<?= urlencode($adres) ?>&markers=<?= urlencode($adres) ?>&zoom=15&sensor=false&size=640x140&scale=2&feature:road"/>

                <div class="content">
                    <p>
                        ul. <?= $object->getData('adres_ulica') ?> <?= $object->getData('adres_numer') ?><? if ($object->getData('adres_lokal')) { ?>/<?= $object->getData('adres_lokal') ?><? } ?></p>
                    <? if ($object->getData('adres_poczta') != $object->getData('adres_miejscowosc')) { ?>
                        <p><?= $object->getData('adres_miejscowosc') ?></p><? } ?>
                    <p><?= $object->getData('adres_kod_pocztowy') ?> <?= $object->getData('adres_poczta') ?></p>

                    <p><?= $object->getData('adres_kraj') ?></p>
                    <button class="btn btn-info"><?= __d('dane', 'LC_DANE_VIEW_KRSPODMIOTY_OTWORZ_MAPE') ?></button>
                </div>
            </div>
            <div id="googleMap">
                <script>
                    var googleMapAdres = '<?= $adres ?>';
                </script>
            </div>
        </div>
        
        <div class="block">
            <?php echo $this->Dataobject->hlTableForObject($object, array(
				'krs', 'nip', 'regon', 'wartosc_czesc_kapitalu_wplaconego', 'wartosc_kapital_docelowy', 'wartosc_kapital_zakladowy', 'wartosc_nominalna_akcji', 'wartosc_nominalna_podwyzszenia_kapitalu', 'data_rejestracji', 'data_dokonania_wpisu', 'email', 'www', 'forma_prawna_str', 'oznaczenie_sadu', 'sygnatura_akt', 'wczesniejsza_rejestracja_str'
			), array(
				'col_width' => 3,
				'display' => 'firstRow',
			)); ?>
        </div>       

        <? if ($object->getData('sposob_reprezentacji')) { ?>
            <div class="reprezentacja block bg">
                <h2>Sposób reprezentacji</h2>

                <div class="content normalizeText textBlock">
                    <?= $object->getData('sposob_reprezentacji') ?>
                </div>
            </div>
        <? } ?>

        <div class="organy">
            <? $organy_count = count($organy);
            if ($organy_count) {
            if ($organy_count < 5)
                $column_width = 12 / $organy_count;
            else
                $column_width = 3;
            ?>
            <? foreach ($organy as $organ) { ?>
            <div class="col-lg-<?= $column_width ?>">
                <div class="block small">
                    <h2 id="<?= $organ['idTag'] ?>" class="normalizeText"><?= $organ['title'] ?></h2>
                    <? if (isset($organ['label']) && $organ['label']) { ?>
                        <p class="label label-primary"><?= $organ['label'] ?></p>
                    <? } ?>

                    <? if ($organ['content']) { ?>
                    <div class="list-group less-borders">
                        <? foreach ($organ['content'] as $osoba) { ?>
                        <? if (@$osoba['osoba_id']) { ?>
                        <a class="list-group-item" href="/dane/krs_osoby/<?= $osoba['osoba_id'] ?>">
                            <? } else { ?>
                            <div class="list-group-item">
                                <? } ?>

                                <h4 class="list-group-item-heading">
                                    <?= $osoba['nazwa'] ?><? if (isset($osoba['wiek']) && $osoba['wiek']) { ?>
                                        <span class="wiek">,
                                            <?= pl_dopelniacz($osoba['wiek'], 'rok', 'lata', 'lat') ?>
                                                        </span>
                                    <? } ?>
                                </h4>

                                <? if (isset($osoba['funkcja']) && $osoba['funkcja']) { ?>
                                    <p class="list-group-item-text normalizeText">
                                        <?= $osoba['funkcja'] ?>
                                    </p>
                                <? } ?>

                                <? if (@$osoba['osoba_id']) { ?>
                        </a>
                        <? } else { ?>
                    </div>
                <? } ?>
                <? } ?>
                </div>
                <? } ?>
            </div>
        </div>
    <? } ?>
    <? } ?>
    </div>

    <!--<div class="graph block">
        <h2>Powiązania</h2>

        <canvas id="connectionGraph" class="col-xs-12">
            http://mojepanstwo/dane/krs_podmioty/114/graph.json
        </canvas>
    </div>-->

    <? if ($object->getData('cel_dzialania')) { ?>
        <div class="dzialanie block bg">
            <h2>Cel działania</h2>

            <div class="content normalizeText">
                <?= $object->getData('cel_dzialania') ?>
            </div>
        </div>
    <? } ?>

    <? if ($dzialalnosci) { ?>
        <div class="dzialalnosci block bg">
            <h2 id="<?= $dzialalnosci['idTag'] ?>"><?= $dzialalnosci['title'] ?></h2>

            <div class="content normalizeText">
                <div class="list-group less-borders">
                    <? foreach ($dzialalnosci['content'] as $d) { ?>
                        <li class="list-group-item"><?= $d['str'] ?></li>
                    <? } ?>
                </div>
            </div>
        </div>
    <? } ?>

    <? /*
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <?php echo __d('dane', __('LC_DANE_VIEW_KRSPODMIOTY_INFORMACJE')) ?>
                    </div>
                    <table class="table stripped">
                        <tr>
                            <th><?php echo __d('dane', __('LC_DANE_VIEW_KRSPODMIOTY_FIRMA')) ?></th>
                            <td><?php echo $object->getData('firma'); ?></td>
                        </tr>
                        <tr>
                            <th><?php echo __d('dane', __('LC_DANE_VIEW_KRSPODMIOTY_KRS')) ?></th>
                            <td><?php echo $object->getData('krs'); ?></td>
                        </tr>
                        <tr>
                            <th><?php echo __d('dane', __('LC_DANE_VIEW_KRSPODMIOTY_SIEDZIBA')) ?></th>
                            <td><?php echo $object->getData('siedziba'); ?></td>
                        </tr>
                        <tr>
                            <th><?php echo __d('dane', __('LC_DANE_VIEW_KRSPODMIOTY_NAZWA')) ?></th>
                            <td><?php echo $object->getData('nazwa'); ?>  (
                                <small><?php echo $object->getData('nazwa_skrocona'); ?></small>
                                )
                            </td>
                        </tr>
                        <tr>
                            <th><?php echo __d('dane', __('LC_DANE_VIEW_KRSPODMIOTY_FORMA_PRAWNA')) ?></th>
                            <td><?php echo $object->getData('forma_prawna_str'); ?></td>
                        </tr>
                        <tr>
                            <th><?php echo __d('dane', __('LC_DANE_VIEW_KRSPODMIOTY_STATUS')) ?></th>
                            <td>
                                <input type="checkbox" readonly="" <?php echo ((bool)$object->getData('nazwa')) ? 'checked' : null; ?>/> OPP
                            </td>
                        </tr>
                        <tr>
                            <th><?php echo __d('dane', __('LC_DANE_VIEW_KRSPODMIOTY_REJESTRACJI')) ?></th>
                            <td><?php echo $object->getData('data_rejestracji'); ?></td>
                        </tr>
                        <tr>
                            <th><?php echo __d('dane', __('LC_DANE_VIEW_KRSPODMIOTY_WPIS')) ?></th>
                            <td><?php echo $object->getData('data_dokonania_wpisu'); ?></td>
                        </tr>
                        <tr>
                            <th><?php echo __d('dane', __('LC_DANE_VIEW_KRSPODMIOTY_SPRAWDZENIA')) ?></th>
                            <td><?php echo $object->getData('data_sprawdzenia'); ?></td>
                        </tr>
                    </table>
                </div>

                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <?php echo __d('dane', __('LC_DANE_VIEW_KRSPODMIOTY_KONTAKT')) ?>
                    </div>
                    <table class="table stripped">
                        <tr>
                            <th><?php echo __d('dane', __('LC_DANE_VIEW_KRSPODMIOTY_ADRES')) ?></th>
                            <td><?php echo $object->getData('adres'); ?></td>
                        </tr>
                        <tr>
                            <th><?php echo __d('dane', __('LC_DANE_VIEW_KRSPODMIOTY_KOD')) ?></th>
                            <td>
                                <a href="<?php echo $this->Html->url(array('plugin' => 'Dane', 'controller' => 'kody_pocztowe', 'action' => 'view', 'id' => $object->getData('kod_pocztowy_id'))); ?>"><?php echo $object->getData('adres_kod_pocztowy'); ?></a>
                            </td>
                        </tr>
                        <tr>
                            <th><?php echo __d('dane', __('LC_DANE_VIEW_KRSPODMIOTY_MIEJSCOWOSC')) ?></th>
                            <td>
                                <a href="<?php echo $this->Html->url(array('plugin' => 'Dane', 'controller' => 'miejscowosci', 'action' => 'view', 'id' => $obszar['Miejscowosc']['id'])); ?>">
                                    <?php echo $obszar['Miejscowosc']['nazwa']; ?>
                                </a>
                                    (
                                        <strong><?php echo __d('dane', __('LC_DANE_VIEW_KRSPODMIOTY_GMINA')) ?></strong>:
                                            <a href="<?php echo $this->Html->url(array('plugin' => 'Dane', 'controller' => 'gminy', 'action' => 'view', 'id' => $obszar['Gmina']['id'])); ?>">
                                                <?php echo $obszar['Gmina']['nazwa']; ?>
                                            </a>,
                                        <strong><?php echo __d('dane', __('LC_DANE_VIEW_KRSPODMIOTY_POWIAT')) ?></strong>: <?php echo $obszar['Powiat']['nazwa']; ?>,
                                        <strong><?php echo __d('dane', __('LC_DANE_VIEW_KRSPODMIOTY_WOJEWODZTWO')) ?></strong>: <?php echo $obszar['Wojewodztwo']['nazwa']; ?>
                                    )
                            </td>
                        </tr>
                        <tr>
                            <th><?php echo __d('dane', __('LC_DANE_VIEW_KRSPODMIOTY_EMAIL')) ?></th>
                            <td><?php echo $object->getData('email'); ?></td>
                        </tr>
                        <tr>
                            <th><?php echo __d('dane', __('LC_DANE_VIEW_KRSPODMIOTY_WWW')) ?></th>
                            <td><?php echo $object->getData('www'); ?></td>
                        </tr>
                    </table>
                </div>

                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <?php echo __d('dane', __('LC_DANE_VIEW_KRSPODMIOTY_SADOWE')) ?>
                    </div>
                    <table class="table stripped">
                        <tr>
                            <th><?php echo __d('dane', __('LC_DANE_VIEW_KRSPODMIOTY_OZNACZENIA')) ?></th>
                            <td><?php echo $object->getData('oznaczenie_sadu'); ?></td>
                        </tr>
                        <tr>
                            <th><?php echo __d('dane', __('LC_DANE_VIEW_KRSPODMIOTY_SYGNATURA')) ?></th>
                            <td><?php echo $object->getData('sygnatura_akt'); ?></td>
                        </tr>
                    </table>
                </div>
            */
    ?>
    </div>
    </div>
    </div>

<?= $this->Element('dataobject/pageEnd'); ?>