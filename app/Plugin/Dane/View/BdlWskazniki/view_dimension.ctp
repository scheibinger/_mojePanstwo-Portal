<?php $this->Combinator->add_libs('css', $this->Less->css('view-bdl-wskazniki', array('plugin' => 'Dane'))); ?>

<?php $this->Combinator->add_libs('js', 'highcharts/highcharts'); ?>
<?php $this->Combinator->add_libs('js', 'highcharts/locals'); ?>
<?php $this->Combinator->add_libs('js', 'Dane.view-bdl-wskazniki'); ?>

<?= $this->Element('dataobject/pageBegin'); ?>
<?= $this->Element('bdl_select', array('expand_dimension' => $expand_dimension, 'dims' => $dims, 'redirect' => true)); ?>

    <div id="bdl-wskazniki">

        <?
        if (!empty($expanded_dimension)) {
            foreach ($expanded_dimension['options'] as $option) {
                ?>

                <div class="wskaznik" data-dim_id="<?= $option['data']['id'] ?>">
                    <h2>
                        <a href="<?= $this->here ?>/<?= $option['data']['id'] ?>">
                            <?= $option['value'] ?>
                        </a>
                    </h2>

                    <div class="stats">
                        <div class="map">
                            <a href="<?= $this->here ?>/<?= $option['data']['id'] ?>">
                                <img width="216" height="200"
                                     src="http://resources.sejmometr.pl/bdl_wymiary_kombinacje/bdl_wymiary_kombinacje_<?= $option['data']['id'] ?>.png"
                                     class="imageInside"/>
                            </a>
                        </div>
                        <div class="charts">
                            <div class="head">
                                <p class="vp">
                                    <span class="v"><?= number_format($option['data']['lv'], 2, ',', ' ') ?></span>
                                    <span class="u"><?= $option['data']['jednostka'] ?></span>
                                        <span
                                            class="y"><?= __d('dane', 'LC_BDL_WSKAZNIKI_LASTYEAR', array($option['data']['ly'])) ?></span>
                                </p>

                                <p class="fp">
                                        <span class="factor <? if (intval($option['data']['dv']) < 0) {
                                            echo "d";
                                        } else {
                                            echo "u";
                                        } ?>">
                                            <?= $option['data']['dv'] ?> %
                                        </span>
                                        <span class="i">
                                            <?= __d('dane', 'LC_BDL_WSKAZNIKI_PREVLASTYEAR', array($option['data']['ply'])) ?>
                                        </span>
                                </p>
                            </div>
                            <div class="chart" data-chart-background="#EEEEEE">
                                <div class="progress progress-striped active">
                                    <div class="progress-bar" role="progressbar" aria-valuenow="45"
                                         aria-valuemin="0" aria-valuemax="100" style="width: 15%"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?
            }
        }
        ?>

        <div class="menu col-md-3">
            <ul>

            </ul>
            <? debug($dimension['levels']); ?>
        </div>
        <div class="content col-md-9">
            <? if (isset($local_data)) {
                foreach ($local_data as $local) {
                    ?>
                    <div class="wskaznikStatic">
                        <h2>
                            <a href="<?= $this->here ?>/<?= $local['local_id'] ?>">
                                <?= $local['local_name'] ?>
                            </a>
                        </h2>

                        <div class="stats">
                            <div class="charts">
                                <div class="head">
                                    <p class="vp">
                                        <span class="v"><?= number_format($local['lv'], 2, ',', ' ') ?></span>
                                        <? /* <span class="u"><?= $local['jednostka'] ?></span> */ ?>
                                        <span
                                            class="y"><?= __d('dane', 'LC_BDL_WSKAZNIKI_LASTYEAR', array($local['ly'])) ?></span>
                                    </p>

                                    <? /*<p class="fp">
                                        <span class="factor <? if (intval($local['dv']) < 0) {
                                            echo "d";
                                        } else {
                                            echo "u";
                                        } ?>">
                                            <?= $local['dv'] ?> %
                                        </span>
                                        <span class="i">
                                            <?= __d('dane', 'LC_BDL_WSKAZNIKI_PREVLASTYEAR', array($local['ply'])) ?>
                                        </span>
                                    </p>*/
                                    ?>
                                </div>
                                <div class="chart" data-chart-datas='<?= json_encode($local['data']) ?>'>
                                    <div class="progress progress-striped active">
                                        <div class="progress-bar" role="progressbar" aria-valuenow="45"
                                             aria-valuemin="0" aria-valuemax="100" style="width: 15%"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?
                }
            }?>
        </div>
    </div>

<?= $this->Element('dataobject/pageEnd'); ?>