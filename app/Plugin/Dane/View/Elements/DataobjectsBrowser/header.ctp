<div class="col-xs-12 col-sm-4 dataStats">
    <?=
    pl_dopelniacz($pagination['total'], 'wynik', 'wyniki', 'wyników', array(
        'numberTag' => 'strong',
    )) ?>
</div>
<div class="col-xs-12 col-sm-8 dataSortings">
    <div class="row">

        <form method="get" action="<?= $page['href'] ?>">

            <?php echo $this->Form->submit(__d('dane', 'LC_DANE_SORTUJ'), array('name' => 'search', 'class' => 'sortingButton btn btn-primary input-sm hidden-xs')); ?>

            <?
            $_query = $this->request->query;
            unset($_query['order']);
            unset($_query['search']);

            foreach ($_query as $key => $value) {
                if (is_array($value)) {
                    foreach ($value as $_value) {
                        if ($_value != '')
                            echo '<input type="hidden" name="' . $key . '[]" value="' . htmlspecialchars($_value) . '" />';
                    }
                } else {
                    if ($value != '')
                        echo '<input type="hidden" name="' . $key . '" value="' . htmlspecialchars($value) . '" />';
                }
            }
            ?>

            <select id="DatasetSort" class="form-control input-sm" name="order">
                <?
                foreach ($orders as $order) {
                    if ($order['sorting']['field'] == 'score') {
                        ?>
                        <optgroup data-special="result">
                            <option<? if (isset($order['selected_direction'])) { ?> selected="selected"<? } ?>
                                value="<?= $order['sorting']['field'] ?> desc"
                                title="<?= $order['sorting']['label'] ?>"><?= $order['sorting']['label'] ?>
                            </option>
                        </optgroup>
                    <?
                    } else {
                        ?>
                        <optgroup label="<?= $order['sorting']['label'] ?>">
                            <option<? if (isset($order['selected_direction']) && $order['selected_direction'] == 'desc') { ?> selected="selected"<? } ?>
                                value="<?= $order['sorting']['field'] ?> desc"
                                title="<?= $order['sorting']['label'] . ' (' . __d('dane', 'LC_DANE_SORTOWANIE_MALEJACO') . ')' ?>"><?= __d('dane', 'LC_DANE_SORTOWANIE_MALEJACO') ?>
                            </option>
                            <option<? if (isset($order['selected_direction']) && $order['selected_direction'] == 'asc') { ?> selected="selected"<? } ?>
                                value="<?= $order['sorting']['field'] ?> asc"
                                title="<?= $order['sorting']['label'] . ' (' . __d('dane', 'LC_DANE_SORTOWANIE_ROSNACO') . ')' ?>"><?= __d('dane', 'LC_DANE_SORTOWANIE_ROSNACO') ?>
                            </option>
                        </optgroup>
                    <?
                    }
                }
                ?>
            </select>

            <strong class="sortingName hidden-xs">
                <?php echo __d('dane', 'LC_DANE_SORTOWANIE'); ?>
            </strong>

        </form>
    </div>
</div>