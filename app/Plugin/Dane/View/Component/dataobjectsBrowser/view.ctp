<?

$this->Combinator->add_libs('css', $this->Less->css('dataobject', array('plugin' => 'Dane')));
$this->Combinator->add_libs('js', 'Dane.dataobjects-ajax');
$this->Combinator->add_libs('js', 'Dane.filters');

if (isset($originalViewPath))
    include($originalViewPath);

$__mode = false;
if (isset($object) && method_exists($object, 'getId') && $object->getId())
    $__mode = 'object';
?>


<?
if ($__mode == 'object')
    echo $this->Element('dataobject/pageBegin');
?>

<div class="container dataBrowser">

<? if ($page['noResultsTitle'] && !$pagination['total']) {
    ?>

    <p class="msg"><?= $page['noResultsTitle'] ?></p>

<?
} else {
    ?>

    <div class="row">

        <div class="col-xs-12 col-sm-3 dataFilters">

            <? if ($page['showTitle']) { ?>
            <div class="header">
                <<?= $page['titleTag'] ?>><? if (!empty($this->request->query)) { ?><a
                    href="<?= $page['href'] ?>"><? } ?><?= $page['title'] ?><? if (!empty($this->request->query)) { ?></a><? } ?>
            </<?= $page['titleTag'] ?>>
        </div>
        <? } ?>

        <?php echo $this->Filter->generateFilters($filters, $switchers, $facets, $page); ?>
    </div>
    <div class="col-xs-12 col-sm-9 dataObjects">
        <div class="dataInfo">
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
        </div>
        <div class="innerContainer">
            <?
            if (empty($objects)) {
                echo '<p class="noResults">' . __d('dane', 'LC_DANE_BRAK_WYNIKOW') . '</p>';
            } else {
                ?>

                <ul class="list-group list-dataobjects">
                    <?
                    $bg = false;
                    foreach ($objects as $object) {
                        echo $this->Dataobject->render($object['Dataobject'], 'default', array(
                            'bg' => $bg,
                            'hlFields' => $dataBrowser->hlFields,
                            'routes' => $dataBrowser->routes,
                        ));
                        $bg = !$bg;
                    }
                    ?>
                </ul>

            <? } ?>
        </div>

        <div class="paginationList col-xs-12">
            <ul class="pagination pagination-sm">
                <?
                echo $this->Paginator->numbers(array(
                    'tag' => 'li',
                    'currentTag' => 'a',
                    'currentClass' => 'active',
                    'separator' => false,
                    'escape' => false,
                ));
                ?>
            </ul>
        </div>

    </div>
    </div>
<? } ?>
    </div>

<?
if ($__mode == 'object')
    echo $this->Element('dataobject/pageEnd');
?>