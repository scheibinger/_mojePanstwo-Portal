<?php
$this->Combinator->add_libs('css', $this->Less->css('view-kodypocztowe', array('plugin' => 'Dane')));

echo $this->Html->script('//maps.googleapis.com/maps/api/js?libraries=geometry&sensor=false', array('block' => 'scriptBlock'));
echo $this->Html->script('scriptaculous/lib/prototype', array('block' => 'scriptBlock'));
$this->Combinator->add_libs('js', 'Dane.view-kodypocztowe');
?>

<?php echo $this->Element('dataobject/pageBegin'); ?>
    <div class="object">
        <div class="col-md-7">
            <div class="hint">
                <p><?php echo __d('dane', __('LC_DANE_VIEW_KODYPOCZTOWE_HINT_TEXT')) . ' <strong>' . $object->getData('kod') . '</strong>.' ?></p>

                <p><?php echo __d('dane', __('LC_DANE_VIEW_KODYPOCZTOWE_HINT_GMINA')) ?></p>

                <p><?php echo __d('dane', __('LC_DANE_VIEW_KODYPOCZTOWE_HINT_MIEJSCOWOSC')) ?></p>
            </div>


            <?php foreach ($obszary as $obszar) { ?>
                <ul id="obszary">
                    <li class="gminy" _gs="<?php echo $obszar['pl_gminy']['gmina_nazwa']; ?>">
                        <h2>
                            <a href="<?php echo $this->Html->url(array('plugin' => 'Dane', 'controller' => 'gminy', 'action' => 'view', 'id' => $obszar['pl_gminy']['gmina_id'])); ?>"><?php echo $obszar['pl_gminy']['gmina_nazwa']; ?></a>
                        </h2>
                        <?php if (!empty($obszar['pnas'])) { ?>
                            <ul class="pnaUl">
                                <?php foreach ($obszar['pnas'] as $pnas) { ?>
                                    <li class="pnaLi"><?php echo $pnas['miejscowosc'];
                                        if ($pnas['ulica'] != '') {
                                            echo ', ' . $pnas['ulica'];
                                        } ?></li>
                                <?php } ?>
                            </ul>
                        <?php } ?>
                    </li>
                </ul>
            <?php } ?>
        </div>
        <div class="col-md-5 maps">
            <div id="mapa"></div>
        </div>
    </div>
<?php echo $this->Element('dataobject/pageEnd'); ?>