<?php
$this->Combinator->add_libs('css', $this->Less->css('kto_tu_rzadzi', array('plugin' => 'KtoTuRzadzi')));

echo $this->Html->script('//maps.googleapis.com/maps/api/js?libraries=geometry&sensor=false', array('block' => 'scriptBlock'));
echo $this->Html->script('plugins/scriptaculous/lib/prototype', array('block' => 'scriptBlock'));
echo $this->Html->script('plugins/scriptaculous/src/scriptaculous', array('block' => 'scriptBlock'));

$this->Combinator->add_libs('js', 'KtoTuRzadzi.kto_tu_rzadzi.js');
?>

<div class="container" id="ktoTuRzadzi">
    <div class="row">
        <div class="col-md-12 col-lg-10 col-lg-offset-1">
            <h1><?php echo __d('kto_tu_rzadzi', "LC_KTO_TU_RZADZI_HEADLINE") ?></h1>
        </div>
    </div>

    <div class="locationBrowser dataContent content col-xs-12">
        <div class="mapsContent col-md-12 col-lg-10 col-lg-offset-1">
            <button id="localizeMe"
                    data-icon="&#xe607;"><?php echo __d('kto_tu_rzadzi', "LC_KTO_TU_RZADZI_LOCALIZATOR") ?></button>
            <div id="PLBrowser"></div>
        </div>
    </div>
</div>