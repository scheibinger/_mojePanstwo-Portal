<?php // $this->Combinator->add_libs('css', $this->Less->css('view-bdl-wskazniki', array('plugin' => 'Dane'))); ?>

<?= $this->Element('dataobject/pageBegin'); ?>
        <?= $this->Element('bdl_select', array('expand_dimension' => $expand_dimension, 'dims' => $dims)); ?>
    <div class="object">
        

<?	
	if( !empty($expanded_dimension) )
	{
    	foreach( $expanded_dimension['options'] as $option )
    	{
?>
		<div>
			<p data-dim_id="<?= $option['data']['id'] ?>"><a href="<?= $this->here ?>?dim_id=<?= $option['data']['id'] ?>"><?= $option['value'] ?></a></p>
			<p><? debug( $option['data'] ); ?></p>
		</div>

<?
    	}
	}
?>
    
        
    </div>
<?= $this->Element('dataobject/pageEnd'); ?>