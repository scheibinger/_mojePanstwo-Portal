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
            <ul class="nav nav-pills nav-stacked">
                <? foreach ($dimension['levels'] as $level) { ?>
                    <li<? if (isset($level['selected'])) { ?> class="active" <? } ?>>
                        <a href="/dane/bdl_wskazniki/<?= $object->getId() . DS . $option['data']['id'] . DS . $level['id'] ?>">
                            <?= $level["label"] ?>
                        </a>
                    </li>
                <? } ?>
            </ul>
        </div>
        <div class="content col-md-9">
            <? if (isset($local_data)) { ?>
                <div class="input-group localDataSearch">
                    <span class="input-group-addon" data-icon="&#xe600;"></span>
                    <input type="text" class="form-control"
                           placeholder="<?= __d('dane', 'LC_BDL_WSKAZNIKI_SEARCH_PLACEHOLDER') ?>">
                    <span class="input-group-btn">
                        <button class="btn btn-info"
                                type="button"><?= __d('dane', 'LC_BDL_WSKAZNIKI_SEARCH_CLEAN') ?></button>
                    </span>
                </div>
                <table class="localDataTable table table-striped">
                <thead>
                    <tr>
                        <th>
                                <span class="ay-sort sortString"
                                      data-ay-sort-index="0"><?= __d('dane', 'LC_BDL_WSKAZNIKI_NAZWA') ?>
                        </th>
                        <th>
                            <span class="ay-sort sortNumber"
                                  data-ay-sort-index="1"><?= __d('dane', 'LC_BDL_WSKAZNIKI_WARTOSC') ?></span>
                            /
                            <span class="ay-sort sortNumber"
                                  data-ay-sort-index="2"><?= __d('dane', 'LC_BDL_WSKAZNIKI_ROK') ?></span>
                        </th>
                        <? /*
                            <th>
                                <span class="ay-sort sortNumber" data-ay-sort-index="3"><?= __d('dane','LC_BDL_WSKAZNIKI_PRZYROST') ?></span>
                                /
                                <span class="ay-sort sortNumber" data-ay-sort-index="4"><?= __d('dane','LC_BDL_WSKAZNIKI_ROK') ?></span>
                            </th>
                            */
                        ?>
                    </tr>
                    </thead>
                    <tbody>
                    <? foreach ($local_data as $local) { ?>
                        <tr class="wskaznikStatic" data-dim_id="<?= $option['data']['id'] ?>" data-local_type="2"
                            data-local_id="<?= $local["local_id"] ?>">
                            <td>
                                <div class="holder">
                                    <a class="sortOption"
                                       href="<?= $this->here ?>/<?= $local['local_id'] ?>"><?= $local['local_name'] ?></a>

                                    <div class="wskaznikChart">
                                        <div class="progress progress-striped active">
                                            <div class="progress-bar" role="progressbar" aria-valuenow="45"
                                                 aria-valuemin="0" aria-valuemax="100" style="width: 15%"></div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <span class="sortOption"
                                      data-ay-sort-weight="<?= $local['lv'] ?>"><?= number_format($local['lv'], 2, ',', ' ') ?></span>
                                <span class="sortOption"
                                      data-ay-sort-weight="<?= $local['ly'] ?>"><?= __d('dane', 'LC_BDL_WSKAZNIKI_LASTYEAR', array($local['ly'])) ?></span>
                            </td>
                            <? /*
                            <td>
                                <span class="sortOption factor <? if (intval($local['dv']) < 0) {echo "d";} else {echo "u";} ?>" data-ay-sort-weight="<?= $local['dv'] ?>"><?= $local['dv'] ?> %</span>
                                <span class="sortOption" data-ay-sort-weight="<?= $local['ply'] ?>"><?= __d('dane', 'LC_BDL_WSKAZNIKI_PREVLASTYEAR', array($local['ply'])) ?></span>
                            </td>
                            */
                            ?>
                        </tr>
                    <? } ?>
                    </tbody>
                </table>
            <? } ?>
        </div>
    </div>

<?= $this->Element('dataobject/pageEnd'); ?>