<?php $this->Combinator->add_libs('css', $this->Less->css('view-bdl-wskazniki', array('plugin' => 'Dane'))); ?>
<?php $this->Combinator->add_libs('js', 'Dane.view-bdl-wskazniki'); ?>

<?= $this->Element('dataobject/pageBegin'); ?>

    <div id="bdl-wskazniki">
        <?= $this->Element('bdl_select', array('expanded_dim' => $expanded_dim, 'dims' => $dims)); ?>

        <div class="object">
            <? if (isset($dims[$expanded_dim]) && isset($dims[$expanded_dim]['options'])) {
                foreach ($dims[$expanded_dim]['options'] as $option) {
                    $temp_dimmensions_array = $dimmensions_array;
                    $temp_dimmensions_array[$expanded_dim] = (int)$option['id'];
                    $dim_str = implode(',', $temp_dimmensions_array);
                    ?>

                    <div class="wskaznik" data-dim="<?= $dim_str ?>">
                        <h2>
                            <a href="<?= $this->here ?>?dim=<?= $dim_str ?>">
                                <?= $option['value'] ?>
                            </a>
                        </h2>
                        <table cellspacing="0" cellpadding="0" border="0">
                            <tbody>
                            <tr>
                                <td class="map">
                                    <div class="image">
                                        <a href="<?= $this->here ?>?dim=<?= $dim_str ?>">
                                            <img width="216" height="200"
                                                 src="http://resources.sejmometr.pl/bdl_wymiary_kombinacje/bdl_wymiary_kombinacje_28965.png"
                                                 class="imageInside"/>
                                        </a>
                                    </div>
                                </td>
                                <td class="charts">
                                    <div class="index">
                                        <div class="head">
                                            <p class="vp">
                                                <span class="v">1 217 020,00</span>
                                                <span class="u">[osoba]</span>
                                                <span class="y">w 2012 r.</span>
                                            </p>

                                            <p class="fp">
                                                <span class="factor d">↓ -0,1 %</span>
                                                <span class="i">w stosunku do 2011 r.</span>
                                            </p>
                                        </div>
                                        <div class="chart">
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                <?
                }
            }
            ?>
        </div>
    </div>

<?= $this->Element('dataobject/pageEnd'); ?>