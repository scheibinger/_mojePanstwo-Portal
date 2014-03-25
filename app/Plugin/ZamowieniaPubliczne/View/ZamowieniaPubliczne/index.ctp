<?php $this->Combinator->add_libs('css', $this->Less->css('dataobject', array('plugin' => 'Dane'))) ?>
<?php $this->Combinator->add_libs('css', $this->Less->css('dataobjectslider', array('plugin' => 'Dane'))) ?>
<?php $this->Combinator->add_libs('css', $this->Less->css('zamowienia', array('plugin' => 'ZamowieniaPubliczne'))) ?>

<?php $this->Combinator->add_libs('js', '../plugins/highstock/js/highstock'); ?>
<?php $this->Combinator->add_libs('js', '../plugins/highstock/locals'); ?>
<?php $this->Combinator->add_libs('js', 'ZamowieniaPubliczne.zamowieniapubliczne') ?>
<?php $this->Combinator->add_libs('js', 'Dane.dataobjectsslider') ?>

<div class="container" id="zamowienia">

    <div class="banner">
        <h1><?php echo __d('zamowienia_publiczne', "LC_ZAMOWIENIA_PUBLICZNE_HEADLINE"); ?></h1>

        <p><?php echo __d('zamowienia_publiczne', "LC_ZAMOWIENIA_PUBLICZNE_SUBHEADLINE"); ?></p>
    </div>

    <div id="highchartContainer">
        <script type="text/javascript">
            var chartData = <?= json_encode( $stats['days'] ) ?>;
        </script>
    </div>

    <div class="searchDiv">
        <div class="col-lg-10 col-lg-offset-1">
            <form action="/dane/zamowienia_publiczne">
                <div class="input-group main_input">
                    <input name="q" type="text"
                           placeholder="<?= __d('zamowienia_publiczne', 'LC_SEARCH_ALL_TENDERS') ?>"
                           class="form-control input-lg">
				            <span class="input-group-btn">
                                  <button class="btn btn-success btn-lg" type="submit" data-icon="&#xe600;"></button>
				            </span>
                </div>
            </form>
        </div>
    </div>

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


</div>