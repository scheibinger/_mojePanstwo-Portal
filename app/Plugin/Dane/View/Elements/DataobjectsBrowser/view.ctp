<?
	$emptyFilters = empty( $filters ) && empty( $switchers );
?>

<div class="container dataBrowser _dataset_<?= $page['tag'] ?><? if( $emptyFilters ) {?> emptyFilters<?}?>">

    <? /* if ($page['noResultsTitle'] && !$pagination['total']) { ?>

        <p class="msg"><?= $page['noResultsTitle'] ?></p>

    <? } else { */ ?>
		
		
		
        <div class="row">
            
            <? echo $this->element('Dane.DataobjectsBrowser/filters', array(
                'filters' => $filters,
                'switchers' => $switchers,
                'facets' => $facets,
                'page' => $page,
                'conditions' => $conditions,
            )); ?>

	        <div class="col-xs-12 col-sm-9 dataObjects">
				
				<? $config = $dataBrowser->config; ?>
				
	            <div class="dataInfo update-header">
	                <? echo $this->element('Dane.DataobjectsBrowser/header', array(
	                    'pagination' => $pagination,
	                    'orders' => $orders,
	                    'page' => $page,
	                    'controlls' => $config['controlls'],
	                    'didyoumean' => $didyoumean,
	                )); ?>
	            </div>
							
	            <div class="innerContainer update-objects">
	                <? echo $this->element('Dane.DataobjectsBrowser/objects', array(
	                    'objects' => $objects,
	                    'page' => $page,
	                    'defaults' => $config['defaults'],
	                )); ?>
	            </div>
	
	            <div class="paginationList col-xs-12 update-pagination text-center">
	                <? echo $this->element('Dane.DataobjectsBrowser/pagination'); ?>
	            </div>
	
	        </div>
	        
        </div>

    <? // } ?>

</div>