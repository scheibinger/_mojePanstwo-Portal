<?
	$this->Combinator->add_libs('css', $this->Less->css('view-poslowie', array('plugin' => 'Dane')));
	$this->Combinator->add_libs('css', $this->Less->css('dataobjectslider', array('plugin' => 'Dane')));
	$this->Combinator->add_libs('js', 'Dane.view-poslowie.js');
	
	echo $this->Element('dataobject/pageBegin');
?>


    <div class="poslowie row">
        <div class="col-md-2">
            <div class="objectMenu vertical">
                <ul class="nav nav-pills nav-stacked row">
                    <li class="active">
                        <a href="#info" class="normalizeText">Info</a>
                    </li>
                    <? foreach ($_menu as $m) { ?>
                        <li>
                            <a class="normalizeText" href="#<?= $m['id'] ?>"><?= $m['label'] ?></a>
                        </li>
                    <? } ?>
                </ul>
            </div>
        </div>

        <div class="col-md-10">
		    <div class="objectsPageContent main">
			    <div class="object">
			    
			    	<div class="block-group">
			    
	                    <div id="wystapienia" class="block">
	                    <div class="block-header">
								<h2 class="pull-left">Wystąpienia w Sejmie</h2>
								<a class="btn btn-default btn-sm pull-right" href="/dane/poslowie/<?= $object->getId() ?>/wystapienia">Zobacz wszystkie</a>
							</div>
							
							<div class="content">
								<div class="dataobjectsSliderRow row">
			                        <div>
		                                <?php echo $this->dataobjectsSlider->render($wystapienia, array(
		                                    'perGroup' => 3,
		                                    'rowNumber' => 1,
		                                    'labelMode' => 'none',
		                                    'dfFields' => array('data'),
		                                )) ?>
		                            </div>
		                        </div>
							</div>
				    	</div>
	
	                    <div id="interpelacje" class="block bg">
	                    <div class="block-header">
								<h2 class="pull-left">Interpelacje</h2>
								<a class="btn btn-default btn-sm pull-right" href="/dane/poslowie/<?= $object->getId() ?>/interpelacje">Zobacz wszystkie</a>
							</div>
							
							<div class="content">
								<div class="dataobjectsSliderRow row">
			                        <div>
		                                <?php echo $this->dataobjectsSlider->render($interpelacje, array(
		                                    'perGroup' => 3,
		                                    'rowNumber' => 1,
		                                    'labelMode' => 'none',
		                                    'dfFields' => array('data_wplywu'),
		                                )) ?>
		                            </div>
		                        </div>
							</div>
				    	</div>
	
	                    <div id="wystapienia" class="block">
	                    <div class="block-header">
								<h2 class="pull-left">Podpisane projekty ustaw</h2>
								<a class="btn btn-default btn-sm pull-right" href="/dane/poslowie/<?= $object->getId() ?>/projekty_ustaw">Zobacz wszystkie</a>
							</div>
							
							<div class="content">
								<div class="dataobjectsSliderRow row">
			                        <div>
		                                <?php echo $this->dataobjectsSlider->render($projekty_ustaw, array(
		                                    'perGroup' => 3,
		                                    'rowNumber' => 1,
		                                    'labelMode' => 'none',
		                                    'dfFields' => array('data'),
		                                )) ?>
		                            </div>
		                        </div>
							</div>
				    	
				    	</div>
	
	                    <div id="glosowania" class="block bg">
	                    <div class="block-header">
								<h2 class="pull-left">Wyniki głosowań</h2>
								<a class="btn btn-default btn-sm pull-right" href="/dane/poslowie/<?= $object->getId() ?>/glosowania">Zobacz wszystkie</a>
							</div>
							
							<div class="content">
								<div class="dataobjectsSliderRow row">
			                        <div>
		                                <?php echo $this->dataobjectsSlider->render($glosowania, array(
		                                    'perGroup' => 3,
		                                    'rowNumber' => 1,
		                                    'labelMode' => 'none',
		                                    'dfFields' => array('sejm_glosowania.czas'),
		                                    'file' => 'poslowie_glosy-poslowie',
		                                )) ?>
		                            </div>
		                        </div>
							</div>
				    	</div>
			    	
			    	</div>
			    	
			    </div>
		    </div>
		</div>
	    
    </div>


<?= $this->Element('dataobject/pageEnd'); ?>