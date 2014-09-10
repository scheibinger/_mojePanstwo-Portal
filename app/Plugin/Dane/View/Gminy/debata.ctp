<?
echo $this->Combinator->add_libs('css', $this->Less->css('view-gminy', array('plugin' => 'Dane')));
if ($object->getId() == '903') $this->Combinator->add_libs('css', $this->Less->css('view-gminy-krakow', array('plugin' => 'Dane')));

$this->Combinator->add_libs('css', $this->Less->css('view-radygmindebaty', array('plugin' => 'Dane')));
$this->Combinator->add_libs('js', 'Dane.view-radygmindebaty');

echo $this->Element('dataobject/pageBegin', array(
    'titleTag' => 'p',
));
?>

<div class="objectPageHeaderContainer subobjectContainer">
    <div style="width: inherit;" class="container">
        <div class="col-md-12">
            <div class="objectPageHeader">
                <div oid="115" class="objectRender col-md-12 krakow_posiedzenia" style="border-bottom: 1px solid #DDD;">
    <div class="row">
    				<div class="formatDate col-md-1 dimmed">
    				<?
    				if ($debata->getData('krakow_posiedzenia.data')) {
						
			            $temp = '<span>{day}</span><p>{month} {year}</p>';
			            			            
			            $ts = strtotime($debata->getData('krakow_posiedzenia.data'));
			
			            $formatting = array(
			                'day' => date('j', $ts),
			                'year' => date('Y', $ts),
			                'month' => __(date('M', $ts), true),
			            );			          
			
			            foreach ($formatting as $key => $partial)
			                $temp = preg_replace('/\{' . $key . '\}/', $partial, $temp);
			
			            echo $temp;
			        }
			        ?>                    
		            </div>
	
                <div class="data col-md-11">
            <div class="row">
                                
                            <div class="content">
                <p class="header">
                    Posiedzenie Rady Miasta                </p>

                <p class="title big">
                                <a title="Sesja <?= $debata->getData('krakow_sesje.str_numer') ?> - Posiedzenie <?= $debata->getData('krakow_posiedzenia.numer') ?>" href="/dane/gminy/903/posiedzenia/<?= $debata->getData('posiedzenie_id') ?>" class="trimTitle">
                                        Sesja <strong><?= $debata->getData('krakow_sesje.str_numer') ?></strong> - Posiedzenie #<strong><?= $debata->getData('krakow_posiedzenia.numer') ?></strong>                                   </a>                         </p>
            
        </div>
        </div>
</div>
</div>
</div>            </div>
        </div>
      
    </div>
</div>

<?
echo $this->Element('Dane.dataobject/subobject', array(
    'menu' => isset($_submenu) ? $_submenu : false,
    'object' => $debata,
    'objectOptions' => array(
        // 'hlFields' => array('rady_gmin_posiedzenia.numer', 'numer_punktu'),
        'bigTitle' => true,
    ),
));
?>


	
    <div class="col-md-12">
        <div class="object mpanel">
            
            
            <? if( isset($wystapienia) ) { ?>
            <div class="row">
	            <div class="col-md-7">
	                <div id="ytVideo">
	                    <div id="player" data-youtube="<?php echo $debata->getData('yt_video_id'); ?>"></div>
	                </div>
	            </div>
	            <div class="col-md-5 wystapienia">
	
	                <div class="block">
	
	                    <div class="block-header">
	                        <h2 class="label"><?php echo __d('dane', 'LC_RADYGMINDEBATY_WYSTAPIENIA'); ?></h2>
	                    </div>
	
	                    <div class="content">
	                        <ul class="nav nav-pills nav-stacked">
	                            <?php foreach ($wystapienia as $id => $wystapienie) { ?>
	                                <li>
	                                    <a data-video-position="<?php echo $wystapienie['video_start']; ?>"
	                                       href="#<?php echo $id; ?>">
	                                        <span><?php echo (date('H', $wystapienie['video_start']) - 1) . date(':i:s', $wystapienie['video_start']); ?></span> <?php echo $wystapienie['mowca_str']; ?>
	                                    </a>
	                                </li>
	                            <?php } ?>
	                        </ul>
	                    </div>
	                </div>
	            </div>
            </div>
            <? } ?>
        </div>
    </div>
    
    
    <div class="gminy row">
		<div class="col-lg-3 objectSide">
		
		    <div class="objectSideInner">
		
		        <ul class="dataHighlights side">
					
					
					<? if( $debata->getData('krakow_glosowania.wynik_str') ) {?>
		            <li class="dataHighlight">
		                <p class="_label">Wynik głosowania</p>
		
						<?
							$class = 'default';
							if( $debata->getData('krakow_glosowania.wynik_id')==1 )
								$class = 'success';
							elseif( $debata->getData('krakow_glosowania.wynik_id')==2 )
								$class = 'danger';
						?>
						
		                <div>
		                    <p class="_value"><span class="label label-<?= $class ?>"><?= $debata->getData('krakow_glosowania.wynik_str') ?></span></p>
		                </div>
		            </li>
		            <? } ?>
		            
		            
					
					
					<? if( $debata->getData('krakow_glosowania.liczba_glosow_za') ) {?>
		            <li class="dataHighlight big topborder">
		                <p class="_label">Liczba głosów "Za"</p>
		
		                <div>
		                    <p class="_value"><?= $debata->getData('krakow_glosowania.liczba_glosow_za') ?></p>
		                </div>
		            </li>
		            <? } ?>
		            
		            <? if( $debata->getData('krakow_glosowania.liczba_glosow_przeciw') ) {?>
		            <li class="dataHighlight big">
		                <p class="_label">Liczba głosów "Przeciw"</p>
		
		                <div>
		                    <p class="_value"><?= $debata->getData('krakow_glosowania.liczba_glosow_przeciw') ?></p>
		                </div>
		            </li>
		            <? } ?>
		            
		            <? if( $debata->getData('krakow_glosowania.liczba_glosow_wstrzymanie') ) {?>
		            <li class="dataHighlight big">
		                <p class="_label">Liczba wstrzymań od głosowania</p>
		
		                <div>
		                    <p class="_value"><?= $debata->getData('krakow_glosowania.liczba_glosow_wstrzymanie') ?></p>
		                </div>
		            </li>
		            <? } ?>
		            
		            <? if( $debata->getData('krakow_glosowania.liczba_nieobecni') ) {?>
		            <li class="dataHighlight big">
		                <p class="_label">Liczba nieobecnych</p>
		
		                <div>
		                    <p class="_value"><?= $debata->getData('krakow_glosowania.liczba_nieobecni') ?></p>
		                </div>
		            </li>
		            <? } ?>
		            
		            <? if( $debata->getData('krakow_glosowania.liczba_nieglosowali') ) {?>
		            <li class="dataHighlight big topborder">
		                <p class="_label">Liczba radnych, którzy nie głosowali</p>
		
		                <div>
		                    <p class="_value"><?= $debata->getData('krakow_glosowania.liczba_nieglosowali') ?></p>
		                </div>
		            </li>
		            <? } ?>
		            
					
					
					<? if( $debata->getData('krakow_glosowania.typ_str') ) {?>
		            <li class="dataHighlight topborder">
		                <p class="_label">Typ głosowania</p>
		
		                <div>
		                    <p class="_value"><?= $debata->getData('krakow_glosowania.typ_str') ?></p>
		                </div>
		            </li>
		            <? } ?>
		            
		            <? if( $debata->getData('krakow_glosowania.rodzaj_str') ) {?>
		            <li class="dataHighlight">
		                <p class="_label">Rodzaj głosowania</p>
		
		                <div>
		                    <p class="_value"><?= $debata->getData('krakow_glosowania.rodzaj_str') ?></p>
		                </div>
		            </li>
		            <? } ?>
					
						            
		            <? if( $debata->getData('href') ) {?>
		            <li class="dataHighlight">		
		                <p class="_value" id="sources"><a href="<?=$debata->getData('href')?>">Źródło</a></p>
		            </li>
		            <? } ?>
		            
		
		
		        </ul>
				
		    </div>
		</div>
		
		
		<div class="col-lg-9 objectMain">
			<div class="object mpanel">
		
		
				<div class="block-group">
					
					<? if( $debata->getData('druk_id') ) {?>
					
					<div class="block">
                        <div class="block-header">
                            <h2 class="label"><? if( $debata->getData('glosowanie_id') ) {?>Przedmiot głosowania<? } else {?>Przedmiot obrad<? } ?></h2>
                        </div>

                        <div class="content">
                            
                            <div class="objectRender">
							    <div class="row">
							                    <div class="formatDate col-md-1 dimmed">
							                <span>18</span><p>Mar 2014</p>            </div>
							                <div class="data col-md-11">
							            <div class="row">
							
							                
							                                    <div class="attachment col-md-2 text-center">
							                                                <a href="/dane/rady_druki/<?= $debata->getData('rady_druki.id') ?>" class="thumb_cont">
							                                                        <img src="http://docs.sejmometr.pl/thumb/1/<?= $debata->getData('rady_druki.dokument_id') ?>.png" onerror="imgFixer(this)" class="thumb pull-right">
							                                                    </a>
							                    
							                    </div>
							                    <div class="content col-md-10">
							
							                        						
							                                                  
							                        
							                        <p class="title">
							                                                        <a href="/dane/rady_druki/<?= $debata->getData('rady_druki.id') ?>"><?= $debata->getData('rady_druki.tytul') ?></a>                         </p>
							                        <div class="description">
							                        	<?
							                        		$opis = $debata->getData('rady_druki.opis');
							                        		if( $opis ) {
								                        		
								                        		$p = stripos($opis, ' /');
								                        		if( $p )
								                        			$opis = substr($opis, $p+2);
								                        			
								                        		echo $opis;
								                        		
							                        		}
							                        	?>
							                        </div>
							                        
							                        
							                    </div>
							
							                            </div>
							        </div>
							    </div>
							    </div>
                            
                        </div>
                    </div>
                    
                    <? } ?>
                    
                    <? if( $debata->getData('glosowanie_id') && ( $wyniki = $debata->getLayer('wyniki_glosowania') ) ) {?>
					
					<div class="block">
                        <div class="block-header">
                            <h2 class="label">Indywidualne wyniki głosowania</h2>
                        </div>

                        <div class="content">
                            
                            <ul class="wyniki_glosowania">
                            <? foreach( $wyniki as $wynik ) {?>
                            
                            	<li class="row">
	                            	<div class="col-md-2">
	                            		<a href="/dane/radni_gmin/<?= $wynik['radny_id']?>" class="thumb_cont">
                                            <img src="<? if( $wynik['avatar_id'] ) {?>http://resources.sejmometr.pl/avatars/5/<?= $wynik['avatar_id'] ?>.jpg<? } else { ?>http://resources.sejmometr.pl/avatars/g/m.png<? } ?>"  class="thumb pull-right">
                                        </a>
	                            	</div>
	                            	<div class="col-md-7">
	                            		<p class="title"><a href="/dane/radni_gmin/<?= $wynik['radny_id'] ?>"><?= $wynik['nazwa'] ?></a></p>
	                            		<p class="desc"><?= $wynik['komitet'] ?></p>
	                            	</div>
	                            	
	                            	<? 
	                            	
	                            		$_classes = array(
	                            			'1' => 'success',
	                            			'2' => 'danger',
	                            			'3' => 'primary',
	                            			'4' => 'default'
	                            		);
	                            	
	                            	?>
	                            	
	                            	<div class="col-md-3">
	                            		<p class="label label-<?= $_classes[ $wynik['glos_id'] ] ?>"><?= $wynik['glos_str'] ?></p>
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
    
    

<?
echo $this->Element('dataobject/pageEnd');
?>