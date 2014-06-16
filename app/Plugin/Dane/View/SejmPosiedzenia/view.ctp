<?
$this->Combinator->add_libs('css', $this->Less->css('dataobjectslider', array('plugin' => 'Dane')));
$this->Combinator->add_libs('css', $this->Less->css('view-sejmposiedzenia', array('plugin' => 'Dane')));
echo $this->Element('dataobject/pageBegin');
?>


    <div class="poslowie row">

        <div class="col-md-2">
            <div class="objectMenu vertical">
                <ul class="nav nav-pills nav-stacked row">
                    <? foreach ($_menu as $m) { ?>
                        <li class="active">
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

						<? /*
                        <div class="block">
                            <?php echo $this->Dataobject->hlTable($hldata, array(
                                'col_width' => 3,
                            )); ?>
                        </div>
                        */ ?>


                        <? if ($punkty) { ?>
                            <div class="block">
                                <div class="block-header">
                                    <h2>Punkty porządku dziennego</h2>
                                </div>

                                <div class="content">
                                    
									<ul id="punkty">
										<? foreach( $punkty as $punkt ) {?>
										<li class="row">
											<div class="col-md-1 counter text-center">
											
												<p class="">#<?= $punkt->getData('numer') ?></p>
											
											</div><div class="col-md-9 display">
											
											
												<h3><a href="/dane/sejm_posiedzenia/<?= $punkt->getId() ?>"><?= $punkt->getData('tytul') ?></a></h3>
												
												<p class="stats">
															<? if( $punkt->getData('liczba_wystapien') ) {?><img src="http://resources.sejmometr.pl/stenogramy/punkty/<?= $punkt->getId() ?>.jpg" /><?}?>
															<?= $punkt->getData('stats_str') ?>
														</p>
												
												
																									
											
											</div><div class="col-md-2">
												
												<p class="status"><?= $punkt->getData('opis') ?></p>
												
											</div>
										</li>
										<? } ?>
									</ul>
                                    
                                </div>
                            </div>
                        <? } ?>


                    </div>

                </div>
            </div>
        </div>

    </div>


<?= $this->Element('dataobject/pageEnd'); ?>