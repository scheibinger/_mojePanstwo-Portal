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
    echo $this->element('Dane.dataobject/pageBegin');
?>

<div class="container dataBrowser">

<? if ($page['noResultsTitle'] && !$pagination['total']) {
    ?>

    <p class="msg"><?= $page['noResultsTitle'] ?></p>

<?
} else {
    ?>

    <div class="row">
        <? echo $this->element('Dane.DataobjectsBrowser/filters', array(
            'filters' => $filters,
            'switchers' => $switchers,
            'facets' => $facets,
            'page' => $page,
        )); ?>
    </div>

    <div class="col-xs-12 col-sm-9 dataObjects">

        <div class="dataInfo update-header">
            <? echo $this->element('Dane.DataobjectsBrowser/header', array(
                'pagination' => $pagination,
                'orders' => $orders,
                'page' => $page,
            )); ?>
        </div>

        <div class="innerContainer update-objects">
            <? echo $this->element('Dane.DataobjectsBrowser/objects', array(
                'objects' => $objects,
                'page' => $page,
            )); ?>
        </div>

        <div class="paginationList col-xs-12 update-pagination">
            <? echo $this->element('Dane.DataobjectsBrowser/pagination'); ?>
        </div>

    </div>
    </div>
<? } ?>
    </div>

<?
if ($__mode == 'object')
    echo $this->Element('Dane.dataobject/pageEnd');
?>