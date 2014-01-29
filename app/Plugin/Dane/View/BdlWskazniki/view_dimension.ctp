<?php $this->Combinator->add_libs('css', $this->Less->css('view-bdl-wskazniki', array('plugin' => 'Dane'))); ?>
<?php $this->Combinator->add_libs('js', 'Dane.view-bdl-wskazniki'); ?>

<?= $this->Element('dataobject/pageBegin'); ?>
<?= $this->Element('bdl_select', array('expand_dimension' => $expand_dimension, 'dims' => $dims)); ?>

<div id="bdl-wskazniki">
    <div class="object">
        

<?	
	if( !empty($expanded_dimension) )
	{
    	foreach( $expanded_dimension['options'] as $option )
    	{
?>
		
		<div class="wskaznik" data-dim_id="<?= $option['data']['id'] ?>">
            <h2>
                <a href="<?= $this->here ?>?dim_id=<?= $option['data']['id'] ?>">
                    <?= $option['value'] ?>
                </a>
            </h2>
            <table cellspacing="0" cellpadding="0" border="0">
                <tbody>
                <tr>
                    <td class="map">
                        <div class="image">
                            <a href="<?= $this->here ?>?dim_id=<?= $option['data']['id'] ?>">
                                <img width="216" height="200"
                                     src="http://resources.sejmometr.pl/bdl_wymiary_kombinacje/bdl_wymiary_kombinacje_<?= $option['data']['id'] ?>.png"
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
                            	<? debug($option['data']); ?>
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