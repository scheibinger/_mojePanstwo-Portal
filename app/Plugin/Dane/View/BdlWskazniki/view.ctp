<?php // $this->Combinator->add_libs('css', $this->Less->css('view-bdl-wskazniki', array('plugin' => 'Dane'))); ?>

<?= $this->Element('dataobject/pageBegin'); ?>
        <?= $this->Element('bdl_select', array('expanded_dim' => $expanded_dim, 'dims' => $dims)); ?>
    <div class="object">
        

<?

	if( isset( $dims[ $expanded_dim ] ) && isset( $dims[ $expanded_dim ]['options'] ) )
	{
    	foreach( $dims[ $expanded_dim ]['options'] as $option )
    	{
    		
    		$temp_dimmensions_array = $dimmensions_array;
    		$temp_dimmensions_array[ $expanded_dim ] = (int) $option['id'];	    		
    		$dim_str = implode(',', $temp_dimmensions_array);
?>

		<p data-dim="<?= $dim_str ?>"><a href="<?= $this->here ?>?dim=<?= $dim_str ?>"><?= $option['value'] ?></a></p>

<?
    	}
	}
?>
    
        
    </div>
<?= $this->Element('dataobject/pageEnd'); ?>