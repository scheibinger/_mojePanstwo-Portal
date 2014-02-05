<?
$object = $this->viewVars['object'];
$objectOptions = $this->viewVars['objectOptions'];
$menu = $this->viewVars['menu'];
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
                        <?= $this->Dataobject->render($object, 'page', array(
                        	'hlFields' => $objectOptions['hlFields'],
                        )) ?>
                    </div>
                </div>
                <div class="col-md-3">
                    <ul class="objectButtons">
                        <li>
                            <div class="shoutIt hide">
                                <button class="btn btn-primary shoutItButton"
                                        type="button"><?php echo __d('dane', 'LC_DANE_NAGLOSNIJ'); ?></button>

                                <div class="shoutItContent">
                                    <div class="facebookBox">
                                        <div class="fb-like" data-href="<?php echo Router::url($this->here, true); ?>"
                                             data-send="false"
                                             data-layout="button_count"
                                             data-action="<?php if (Configure::read('Config.language') == 'pol') {
                                                 echo('recommend');
                                             } else {
                                                 echo('like');
                                             } ?>"
                                             data-width="85"
                                             data-show-faces="false">
                                        </div>
                                    </div>
                                    <div class="twitterBox">
                                        <div class="tweet">
                                            <a href="https://twitter.com/share" class="twitter-share-button"
                                               data-url="<?php echo Router::url($this->here, true); ?>"
                                               data-lang="<?php if (Configure::read('Config.language') == 'pol') {
                                                   echo('pl');
                                               } else {
                                                   echo('en');
                                               } ?>">Tweet</a>
                                        </div>
                                    </div>
                                    <div class="wykopBox">
                                        <div class="wykop-button"
                                             data-href="<?php echo Router::url($this->here, true); ?>"></div>
                                    </div>
                                </div>
                            </div>
                        </li>
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
					
