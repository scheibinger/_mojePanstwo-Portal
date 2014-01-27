<?php
$this->Combinator->add_libs('css', $this->Less->css('kody_pocztowe', array('plugin' => 'KodyPocztowe')));
?>

<div class="container<? if ($details) echo " details"; ?>" id="kodyPocztowe">
    <div class="row<? if ($mid) {
        echo 'hide';
    } ?>">
        <div class="col-xs-12 col-sm-10 col-md-8 col-sm-offset-1 col-md-offset-2">
            <div class="kodyPocztoweBlock col-xs-12 col-sm-6 pull-left">
                <div class="row">
                    <p><?php echo __d('kody_pocztowe', "LC_KODY_POCZTOWE_ZNAM_ADRES"); ?></p>

                    <p><?php echo __d('kody_pocztowe', "LC_KODY_POCZTOWE_SZUKAM_KODU"); ?></p>
                </div>
                <div class="row">
                    <form action="/kody_pocztowe" method="get">
                        <div class="input-group">
                            <?php if ($details) {
                                echo $this->Form->input('miejscowosc', array('label' => false, 'class' => 'form-control', 'placeholder' => __d('kody_pocztowe', "LC_KODY_POCZTOWE_WPISZ_MIEJSCOWOSC"), 'id' => 'cityv', 'name' => 'mstr', 'value' => $mstr));
                            } else {
                                echo $this->Form->input('miejscowosc', array('label' => false, 'class' => 'form-control input-lg', 'placeholder' => __d('kody_pocztowe', "LC_KODY_POCZTOWE_WPISZ_MIEJSCOWOSC"), 'id' => 'cityv', 'name' => 'mstr', 'value' => $mstr));
                            }?>
                            <span class="input-group-btn">
                                <button class="btn btn-success<?php if (!$details) echo ' btn-lg' ?>" type="submit"
                                        data-icon="&#xe600;"></button>
                            </span>
                        </div>
                    </form>
                </div>
            </div>
            <div class="kodyPocztoweBlock col-xs-12 col-sm-6 pull-right">
                <div class="row">
                    <p><?php echo __d('kody_pocztowe', "LC_KODY_POCZTOWE_ZNAM_KOD"); ?></p>

                    <p><?php echo __d('kody_pocztowe', "LC_KODY_POCZTOWE_SZUKAM_ADRESU"); ?></p>
                </div>
                <div class="row">
                    <form action="/kody_pocztowe" method="get">
                        <div class="input-group">
                            <?php if ($details) {
                                echo $this->Form->input('kod', array('label' => false, 'class' => 'form-control', 'placeholder' => __d('kody_pocztowe', "LC_KODY_POCZTOWE_WPISZ_KOD"), 'name' => 'kod', 'value' => $kod));
                            } else {
                                echo $this->Form->input('kod', array('label' => false, 'class' => 'form-control input-lg', 'placeholder' => __d('kody_pocztowe', "LC_KODY_POCZTOWE_WPISZ_KOD"), 'name' => 'kod', 'value' => $kod));
                            } ?>
                            <span class="input-group-btn">
                                <button class="btn btn-success<?php if (!$details) echo ' btn-lg' ?>" type="submit"
                                        data-icon="&#xe600;"></button>
                            </span>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="row<? if ($mid) { ?> full<? } ?>" id="display">
        <div class="col-xs-12 col-sm-10 col-md-8 col-sm-offset-1 col-md-offset-2">
            <? if (isset($miejscowosci) && $miejscowosci) { ?>
                <p class="question"><?php echo __d("kody_pocztowe", "LC_KODY_POCZTOWE_QUESTION_CITY"); ?></p>
                <ul class="cities">
                    <? foreach ($miejscowosci as $m) { ?>
                        <?php $m = $m['Dataobject']; ?>
                        <li>
                            <a href="?mid=<?= $m->getData('id'); ?>">
                                <span class="title"><?= $m->getData('nazwa'); ?></span>
                                <span
                                    class="desc"><?= __d("kody_pocztowe", "LC_KODY_POCZTOWE_GMINA") . ' ' . $m->getData('gminy.nazwa'); ?></span>
                            </a>
                        </li>
                    <? } ?>
                </ul>
                <div class="pagination">
                    <?php echo $this->Paginator->numbers(); ?>
                </div>

            <? } elseif (isset($miejscowosc) && $miejscowosc) { ?>
                <h1><?= $miejscowosc['nazwa'] ?></h1>
                <h2><?php echo __d("kody_pocztowe", "LC_KODY_POCZTOWE_CITY_IN_COMMUNITY"); ?>
                    <a href="/dane/gminy/<?= $miejscowosc['gminy.id'] ?>"><?= $miejscowosc['gminy.nazwa'] ?></a></h2>

                <? if (isset($adresy) && $adresy) { ?>
                    <? if (count($adresy) > 9 || $ustr) { ?>
                        <div class="col-xs-12 col-sm-10 col-md-8 col-sm-offset-1 col-md-offset-2">
                            <div class="szukajUlice">
                                <form action="/kody_pocztowe" action="get">
                                    <input type="hidden" name="mid" value="<?= $mid ?>"/>
                                    <input class="form-control" type="text" placeholder="Szukaj ulicy..." name="ustr"
                                           value="<?= $ustr ?>"><input type="submit" class="btn btn-success"
                                                                       value="<?php echo __d('kody_pocztowe', "LC_KODY_POCZTOWE_SZUKAJ"); ?>"/>
                                </form>
                            </div>
                        </div>
                    <? } ?>

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
            <? } ?>
        </div>
    </div>
</div>