<?php $this->Combinator->add_libs('css', $this->Less->css('view-sejmdebaty', array('plugin' => 'Dane'))); ?>

<?
$object = $this->viewVars['object'];
$objectOptions = $this->viewVars['objectOptions'];
$menu = $this->viewVars['menu'];

$buttons = isset($objectOptions['buttons']) ? $objectOptions['buttons'] : array('shoutIt');
?>
<?php $this->Combinator->add_libs('css', $this->Less->css('dataobject', array('plugin' => 'Dane'))) ?>
<?php $this->Combinator->add_libs('css', $this->Less->css('dataobjectpage', array('plugin' => 'Dane'))) ?>
<?php $this->Combinator->add_libs('css', $this->Less->css('naglosnij', array('plugin' => 'Dane'))) ?>

<?php $this->Combinator->add_libs('js', array('Dane.naglosnij', 'Dane.related-tabs')); ?>
<div class="objectsPage">
<?php if (isset($_ALERT_QUERIES)) {
    $alertArray = array();
    foreach ($_ALERT_QUERIES as $alert) {
        preg_match_all("'<em>(.*?)</em>'si", $alert['hl'], $match);
        foreach ($match[1] as $word) {
            $alertArray[] = $word;
        }
        $alertArray = array_unique($alertArray);
    }

    echo $this->Element('dataobject/searchInPage', array(
        'alerts' => $alertArray
    ));
}?>
    <div class="objectPageHeaderContainer">
        <div class="container">
            <div class="col-md-9">
                <div class="objectPageHeader">

                    <?
                    $nav = $object->getLayer('nav');
                    $posiedzenie = $nav['posiedzenie'];
                    $punkty = $posiedzenie['punkty'];
                    ?>

                    <div id="collapseDVR3" class="panel-collapse collapse in">
                        <div class="tree ">
                            <ul>
                                <li class="posiedzenie"><a
                                        href="#"><span>Posiedzenie Sejmu #<?= $posiedzenie['tytul'] ?></span></a>
                                    <ul>
                                        <? foreach ($punkty as $punkt) { ?>
                                            <li class="punkt"><span>Punkt #<?= $punkt['numer'] ?></span>
                                                <i><?= $punkt['tytul'] ?></i>
                                                <ul>
                                                    <?
                                                    $debaty = $punkt['debaty'];
                                                    foreach ($debaty as $debata) {

                                                        if ($debata['id'] == $object->getId()) {
                                                            ?>
                                                            <li class="debata active"><p class="label">
                                                                    <span>Debata</i> </span> <? if ($debata['liczba_wystapien']) { ?>
                                                                        <img
                                                                        src="http://resources.sejmometr.pl/stenogramy/subpunkty/<?= $debata['id'] ?>.jpg" /><? } ?>
                                                                    <i><?= $debata['opis'] ?></i></p></li>
                                                        <?
                                                        } else {
                                                            ?>
                                                            <li class="debata"><a class="label"
                                                                                  href="/dane/sejm_debaty/<?= $debata['id'] ?>"><span>Debata</i> </span> <? if ($debata['liczba_wystapien']) { ?>
                                                                        <img
                                                                        src="http://resources.sejmometr.pl/stenogramy/subpunkty/<?= $debata['id'] ?>.jpg" /><? } ?>
                                                                    <i><?= $debata['opis'] ?></i></a></li>
                                                        <?
                                                        }
                                                    }
                                                    ?>
                                                </ul>
                                            </li>
                                        <? } ?>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                    </div>

                </div>
            </div>
            <div class="col-md-3">
                <ul class="objectButtons">
                    <? foreach ($buttons as $button) { ?>
                        <li><?=
                            $this->Element('dataobject/buttons/' . $button, array(
                                'base_url' => '/dane/' . $object->getDataset() . '/' . $object->getId(),
                            )); ?></li>
                    <? } ?>
                </ul>
            </div>
        </div>
    </div>


<? if ($menuMode == 'vertical') { ?>
    <div class="objectsPageWindow">
    <div class="container">
    <div class="row">
    <? if (count($menu)) { ?>
    <div class="col-md-2">
        <?= $this->Element('dataobject/pageMenu'); ?>
    </div>
    <div class="col-md-10">
    <?= $this->Element('dataobject/pageRelated'); ?>
    <div class="objectsPageContent main<? if (isset($showRelated) && $showRelated) { ?> hide<? } ?>">
    <? } else { ?>
    <div class="col-md-12">
    <?= $this->Element('dataobject/pageRelated'); ?>
    <div class="objectsPageContent main<? if (isset($showRelated) && $showRelated) { ?> hide<? } ?>">
    <? } ?>

    <? } elseif ($menuMode == 'horizontal') { ?>
    <div class="objectsPageWindow">
    <div class="container">
    <div class="row">
    <?= $this->Element('dataobject/pageMenu'); ?>
    <div class="objectsPageContent main">
<? } ?>

<?php echo $this->Element('dataobject/pageRelated', array(
    'showRelated' => isset($showRelated) ? (boolean)$showRelated : false,
)); ?>
    <div class="col-md-12 row">

        <div class="object mpanel">
            <?php foreach ($stenogram['wystapienia'] as $wpis) { ?>

                <a class="wystapienie" href="/dane/sejm_wystapienia/<?= $wpis['id'] ?>">

                    <?php if ($wpis['marszalek'] == '1') { ?>
                        <div class="marszalek col-md-10 col-md-offset-1">
                            <div class="col-md-11">
                                <blockquote class="pull-right text-info">
                                    <small><?= $wpis['mowca_nazwa'] ?>, <?= $wpis['funkcja_nazwa'] ?></small>
                                    <?= $wpis['p_txt'] ?>
                                </blockquote>
                            </div>
                            <div class="col-md-1">
                                <img
                                    src="http://resources.sejmometr.pl/mowcy/a/1/<?= $wpis['mowca_id']; ?>.jpg"/>
                            </div>
                        </div>
                    <?php } else { ?>
                        <div class="col-md-10 col-md-offset-1">
                            <div class="col-md-1">
                                <img
                                    src="http://resources.sejmometr.pl/mowcy/a/1/<?= $wpis['mowca_id'] ?>.jpg"/>
                            </div>
                            <div class="col-md-11">
                                <blockquote>
                                    <small><?= $wpis['mowca_nazwa']; ?>, <?= $wpis['funkcja_nazwa'] ?></small>
                                    <?= $wpis['p_txt'] ?>
                                </blockquote>
                            </div>
                        </div>
                    <?php } ?>

                </a>

            <?php } ?>
        </div>
    </div>
<?php echo $this->Element('dataobject/pageEnd'); ?>