<?php $this->Combinator->add_libs('css', $this->Less->css('dataobjectslider', array('plugin' => 'Dane'))) ?>
<?php $this->Combinator->add_libs('css', $this->Less->css('view-sejmposiedzeniapunkty', array('plugin' => 'Dane'))); ?>

<?php echo $this->Element('dataobject/pageBegin'); ?>
    <div class="object">
        
        
        
        
        <div class="block">
		
			<h2>Debaty w tym punkcie</h2>
			
			<div class="content">
				<div class="dataobjectsSliderRow debaty row">
                    <div>
                        <?php echo $this->dataobjectsSlider->render($debaty, array(
                            'perGroup' => 4,
                            'rowNumber' => 1,
                            'labelMode' => 'none',
                            'file' => 'sejm_debaty-punkty',
                            'dfFields' => array('liczba_wystapien', 'liczba_glosowan'),
                        )) ?>
                    </div>
                </div>
			</div>
			
		</div>
        
        
        
        
    </div>
<?php echo $this->Element('dataobject/pageEnd'); ?>