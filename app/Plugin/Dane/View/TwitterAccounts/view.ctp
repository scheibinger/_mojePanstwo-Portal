<?
$this->Combinator->add_libs('css', $this->Less->css('view-twitteraccounts', array('plugin' => 'Dane')));
$this->Combinator->add_libs('css', $this->Less->css('dataobjectslider', array('plugin' => 'Dane')));

$this->Combinator->add_libs('js', '../plugins/highcharts/js/highcharts');
$this->Combinator->add_libs('js', '../plugins/highcharts/locals');
$this->Combinator->add_libs('js', 'Dane.view-twitteraccounts');

echo $this->Element('dataobject/pageBegin');
?>	

<div class="row">
    
    <div class="col-lg-3 objectSide">
        <div class="objectSideInner">
            <ul class="dataHighlights side">
                <li class="dataHighlight big">
                    <p class="_label">Liczba obserwujacych</p>

                    <p class="_value"><?= _number($object->getData('liczba_obserwujacych')); ?></p>
                </li>
                <li class="dataHighlight inl">
                    <p class="_label">Liczba tweetów</p>

                    <p class="_value"><?= _number($object->getData('liczba_tweetow')); ?></p>
                </li>
                <li class="dataHighlight inl">
                    <p class="_label">Liczba retweetów</p>

                    <p class="_value"><?= _number($object->getData('liczba_retweetow_wlasnych')); ?></p>
                </li>
                <li class="dataHighlight inl">
                    <p class="_label">Liczba wzmianek</p>

                    <p class="_value"><?= _number($object->getData('liczba_wzmianek_rts')); ?></p>
                </li>
                <li class="dataHighlight inl">
                    <p class="_label">Liczba odpowiedzi</p>

                    <p class="_value"><?= _number($object->getData('liczba_odpowiedzi_rts')); ?></p>
                </li>
            </ul>

            <p class="text-center showHideSide">
                <a class="a-more">Więcej &darr;</a>
                <a class="a-less hide">Mniej &uarr;</a>
            </p>

            <ul class="dataHighlights side hide">
            <li class="dataHighlight inl topborder">
                    <p class="_label">Liczba tweetów w 2013 r.</p>

                    <p class="_value"><?= _number($object->getData('liczba_tweetow_wlasnych_2013')); ?></p>
                </li>
                <li class="dataHighlight inl">
                    <p class="_label">Liczba retweetów w 2013 r.</p>

                    <p class="_value"><?= _number($object->getData('liczba_retweetow_wlasnych_2013')); ?></p>
                </li>
                <li class="dataHighlight inl">
                    <p class="_label">Liczba wzmianek w 2013 r.</p>

                    <p class="_value"><?= _number($object->getData('liczba_wzmianek_rts_2013')); ?></p>
                </li>
                <li class="dataHighlight inl">
                    <p class="_label">Liczba odpowiedzi w 2013 r.</p>

                    <p class="_value"><?= _number($object->getData('liczba_odpowiedzi_rts_2013')); ?></p>
                </li>
            </ul>
        </div>
    </div>
    
    <div class="col-lg-9 objectMain">
        <div class="object mpanel">
            <div class="block-group">
                <div class="block">
                    <div class="block-header">
                        <h2 class="pull-left label">Ostatnie twitty</h2>
                        <a class="btn btn-default btn-sm pull-right"
                           href="/dane/twitter_accounts/<?= $object->getId() ?>/twitts">Zobacz wszystkie</a>
                    </div>
                    <div class="content">
                        <div class="dataobjectsSliderRow row">
                            <div>
                                <?php echo $this->dataobjectsSlider->render($twitts, array(
                                    'perGroup' => 3,
                                    'rowNumber' => 1,
                                    'labelMode' => 'none',
                                    'file' => 'twitter_min',
                                )) ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="block">
                    <div class="block-header">
                        <h2 class="pull-left label">Liczba obserwujących</h2>
                    </div>
                    <div class="content followers"
                         data-json='<?php echo json_encode($object->getLayer('followers_chart')) ?>'>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
</div>

<?= $this->Element('dataobject/pageEnd'); ?>