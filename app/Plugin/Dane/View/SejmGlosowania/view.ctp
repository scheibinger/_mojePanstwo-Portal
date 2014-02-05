<?php $this->Combinator->add_libs('js', 'highcharts/highcharts'); ?>
<?php $this->Combinator->add_libs('js', 'highcharts/locals'); ?>
<?php $this->Combinator->add_libs('js', 'Dane.highcharts-sejmglosowania'); ?>
<?php $this->Combinator->add_libs('css', $this->Less->css('view-sejmglosowania', array('plugin' => 'Dane'))); ?>

<?= $this->Element('dataobject/pageBegin') ?>

<?
$wynikiKlubowe = $object->loadLayer('wynikiKlubowe');
$chartData = array(
    array(
        'id' => 'z',
        'count' => $object->getData('z'),
        'label' => 'Za',
    ),
    array(
        'id' => 'p',
        'count' => $object->getData('p'),
        'label' => 'Przeciw',
    ),
    array(
        'id' => 'w',
        'count' => $object->getData('w'),
        'label' => 'Wstrzymania',
    ),
    array(
        'id' => 'n',
        'count' => $object->getData('n'),
        'label' => 'Nieobecności',
    ),
);
$dictionary = array(
    '1' => array('Za', 'z'),
    '2' => array('Przeciw', 'p'),
    '3' => array('Wstrzymanie', 'w'),
    '4' => array('Brak kworum', 'n'),
);
?>

<div class="object glosowanie_stats">
    
    <div class="row">
	    <div class="col-md-6 sejm_glosowania">
	        <p class="wynikGlosowania <?= $dictionary[$object->getData('wynik_id')][1]; ?> label"><?= $dictionary[$object->getData('wynik_id')][0]; ?></p>
	        <div class="highchart" data-wynikiKlubowe='<?= json_encode($chartData) ?>'></div>
	        
	    </div>
	    <div class="col-md-6">
	        <div class="block">
	        	<h2>Wyniki klubowe</h2>
	        	
	        	<div>
	        		<? debug( $object->getLayer('wynikiKlubowe') ); ?>
	        	</div>
	        </div>
	    </div>
    </div>
    
    <div class="col-md-12">
	    <div class="block">
	    	<h2>Wyniki indywidualne</h2>
	    	
	    	<div>
        		<? debug( $object->getLayer('wynikiIndywidualne') ); ?>
        	</div>
	    </div>
    </div>
    
</div>

<?= $this->Element('dataobject/pageEnd') ?>