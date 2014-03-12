<?
$this->Combinator->add_libs('css', $this->Less->css('dataobjectslider', array('plugin' => 'Dane')));
echo $this->Element('dataobject/pageBegin');
?>


    <div class="poslowie row">

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

                    <div class="block-group">


                        <div class="block">
                            <?php echo $this->Dataobject->hlTable($hldata, array(
                                'col_width' => 3,
                            )); ?>
                        </div>


                        <? if ($punkty) { ?>
                            <div id="wystapienia" class="block">
                                <div class="block-header">
                                    <h2 class="pull-left">Punkty porządku dziennego</h2>
                                    <a class="btn btn-default btn-sm pull-right"
                                       href="/dane/sejm_posiedzenia/<?= $object->getId() ?>/punkty">Zobacz wszystkie</a>
                                </div>

                                <div class="content">
                                    <div class="dataobjectsSliderRow row">
                                        <div>
                                            <?php echo $this->dataobjectsSlider->render($punkty, array(
                                                'perGroup' => 3,
                                                'rowNumber' => 1,
                                                'labelMode' => 'none',
                                            )) ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <? } ?>


                    </div>

                </div>
            </div>
        </div>

    </div>


<?= $this->Element('dataobject/pageEnd'); ?>