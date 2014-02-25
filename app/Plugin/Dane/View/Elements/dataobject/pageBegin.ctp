<?
$object = $this->viewVars['object'];
$objectOptions = $this->viewVars['objectOptions'];
$menu = $this->viewVars['menu'];

$buttons = isset($objectOptions['buttons']) ? $objectOptions['buttons'] : array('shoutIt');
?>
<?php $this->Combinator->add_libs('css', $this->Less->css('dataobject', array('plugin' => 'Dane'))) ?>
<?php $this->Combinator->add_libs('css', $this->Less->css('dataobjectpage', array('plugin' => 'Dane'))) ?>
<?php $this->Combinator->add_libs('css', $this->Less->css('naglosnij', array('plugin' => 'Dane'))) ?>

<?php $this->Combinator->add_libs('js', 'Dane.naglosnij'); ?>
<div class="objectsPage">

    <div class="objectPageHeaderContainer">
        <div class="container">
            <div class="row">
                <div class="col-md-9">
                    <div class="objectPageHeader">
                        <?php                                           
	                        echo $this->Dataobject->render($object, 'page', $objectOptions);
                        ?>
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
                            <div
                                class="objectsPageContent main<? if (isset($showRelated) && $showRelated) { ?> hide<? } ?>">
                                <? } ?>

                                <? } elseif ($menuMode == 'horizontal') { ?>
                                <div class="objectsPageWindow">
                                    <div class="container">
                                        <div class="row">

                                            <?= $this->Element('dataobject/pageMenu'); ?>
                                            <div
                                                class="objectsPageContent main<? if (isset($showRelated) && $showRelated) { ?> hide<? } ?>">
                                                <? } ?>
					
