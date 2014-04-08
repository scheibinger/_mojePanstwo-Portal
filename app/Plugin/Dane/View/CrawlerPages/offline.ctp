<?php $this->Combinator->add_libs('css', $this->Less->css('view-crawlerpages', array('plugin' => 'Dane'))) ?>
<?php echo $this->Element('dataobject/pageBegin'); ?>

<div class="offline_content mpanel">
<?php
	$html = $offline['html'];
	
	$tags_to_strip = array('script', 'style', 'link');
	
	foreach ($tags_to_strip as $tag)  
	{ 
	    $html = preg_replace("/<\/?" . $tag . "(.|\s)*?>/", '', $html); 
	
	} 

	echo $html;
?>
</div>

<?php echo $this->Element('dataobject/pageEnd'); ?>