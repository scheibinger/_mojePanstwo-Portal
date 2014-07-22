<?php $this->Combinator->add_libs('js', 'toolbar'); ?>
<?
	
	if( $document->getVersion()=='2' ) {
		
		$this->Combinator->add_libs('css', $this->Less->css('htmlex'));
		
	} else {
		
		$this->Combinator->add_libs('css', $this->Less->css('htmlexDocMain'));
		$this->Combinator->add_libs('css', $this->Less->css('htmlexDoc', array('plugin' => 'Dane')));
		
	}


	echo $this->Html->css($document->getCSSLocation());
?>

<div class="htmlexDoc" data-packages="<?php echo $document->getPackagesCount(); ?>"
     data-current-package="<?php echo $documentPackage; ?>"
     data-pages="<?php echo $document->getPagesCount(); ?>" 
     data-document-id="<?php echo $document->getId(); ?>">
	
	
	<? echo $this->Element('toolbar'); ?>

    <div class="canvas">
        <?php echo $document->loadHtml($documentPackage) ?>
    </div>
    <div class="loadMoreDocumentContent <?php if ($document->getPackagesCount() > 1) {
        echo 'show';
    } else {
        echo 'hide';
    } ?>">
    </div>
 
</div>