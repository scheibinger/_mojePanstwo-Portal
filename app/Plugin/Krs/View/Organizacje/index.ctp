<?php $this->Combinator->add_libs('css', $this->Less->css('krs', array('plugin' => 'Krs'))) ?>
<?php $this->Combinator->add_libs('js', 'Krs.index.js') ?>

<div id="krs">

	<div class="appHeader">
	    <div class="container innerContent">
	        <h1><?php echo __d('krs', 'LC_KRS_HEADLINE'); ?></h1>
	
	        <div class="col-xs-12 col-sm-8 col-sm-offset-2">
	            <form class="searchInput" class="searchKRSForm" action="/krs">
	                <div class="searchKRS input-group main_input">
	                    <input name="q" value="" type="text"
	                           placeholder="<?php echo __d('krs', 'LC_KRS_SEARCH_PLACEHOLDER'); ?>"
	                           class="form-control input-lg">
		                <span class="input-group-btn">
		                      <button class="btn btn-success btn-lg" type="submit" data-icon="&#xe600;"></button>
		                </span>
	                </div>
	            </form>
	        </div>
	        
	    </div>
	</div>

    <div class="resultsList">
        <div class="container">

            <div id="groupsAndResults" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner">
                    <?php foreach ($groups as $index => $group) { ?>
                        <div class="item<?php if ($index == 0) {
                            echo ' active';
                        } ?>">
                            <h2 class="carousel-title"><?= $group['label'] ?></h2>
                            <ul>
                                <?php foreach ($group['content'] as $result)
                                {
	                                $title = trim($result['nazwa']);
	                                $titleLen = strlen( $title );
	                                
	                                $strs = array(
		                                'SPÓŁKA Z OGRANICZONĄ ODPOWIEDZIALNOŚCIĄ W LIKWIDACJI',
	                                	'SPÓŁKA Z OGRANICZONĄ ODPOWIEDZIALNOŚCIĄ',
		                            );
	                                
	                                foreach( $strs as $str )
	                                {
		                                if( endsWith($title, $str) )
		                                {
		                                	$title = substr($title, 0, $titleLen - strlen($str));
		                                	break;
		                                }
		                            }
		                            
	                                	
	                                $title = trim( $title );
                                ?>
                                    <li>
                                        <p class="title">
	                                        <a href="<?php if ($result['type'] == 'organization') {
	                                            echo('/dane/krs_podmioty/' . $result['id']);
	                                        } elseif ($result['type'] == 'person') {
	                                            echo('/dane/krs_osoby/' . $result['id']);
	                                        } ?>" target="_self"><?php echo $title ?>
	                                        </a>
                                        </p>
                                        <p class="subtitle">
                                        	<?
                                        		
                                        		$parts= array(
                                        			$result['miejscowosc']
                                        		);
                                        		
                                        		if( $result['kapital_zakladowy'] )
                                        		{
                                        			setlocale(LC_MONETARY, 'pl_PL');
	                                        		$parts[] = money_format('%i', $result['kapital_zakladowy']);
                                        		}
                                        		
                                        		$wiek = pl_wiek($result['data_rejestracji']);
                                        		
                                        		if( $wiek )
                                        			$parts[] = pl_dopelniacz($wiek, 'rok', 'lata', 'lat');
                                        		else
                                        			$parts[] = $this->Czas->dataSlownie( $result['data_rejestracji'] );
                                        		
                                        		echo implode(' <span class="separator">|</span> ', $parts);                                  		
			    							?>                                        	
                                        </p>
                                    </li>
                                <?php } ?>
                            </ul>
                        </div>
                    <? } ?>
                </div>

                <ol class="carousel-indicators">
                    <?php for ($i = 0; $i < count($groups); $i++) { ?>
                        <li data-target="#groupsAndResults"
                            data-slide-to="<?= $i ?>"<? if ($i == 0) { ?> class="active"<? } ?>>
                        </li>
                    <?php } ?>
                </ol>

                <a class="left carousel-control" href="#groupsAndResults" data-slide="prev">
                    <span class="glyphicon glyphicon-chevron-left"></span>
                </a>
                <a class="right carousel-control" href="#groupsAndResults" data-slide="next">
                    <span class="glyphicon glyphicon-chevron-right"></span>
                </a>
            </div>
        </div>
    </div>

    <? /*
    <div class="poslowie">
        <div class="container">
            <h3><?= __d('krs', 'LC_KRS_POSLOWIE_HEADLINE') ?></h3>

            <div class="row">
                <div class="blockInfo col-xs-6 col-md-3">
                    <div class="logo">
                        <img class="main" src="http://resources.sejmometr.pl/s_kluby/1_t.png"
                             alt="Platforma Obywatelska"/>
                    </div>
                    <div class="name">Platforma Obywatelska</div>
                    <div class="info">122 NGO / 314 biznes</div>
                    <div class="link">
                        <a href="#"><?= __d('krs', 'LC_KRS_POSLOWIE_BLOCK_LINK') ?></a>
                    </div>
                </div>
                <div class="blockInfo col-xs-6 col-md-3">
                    <div class="logo">
                        <img class="main" src="http://resources.sejmometr.pl/s_kluby/1_t.png"
                             alt="Platforma Obywatelska"/>
                    </div>
                    <div class="name">Platforma Obywatelska</div>
                    <div class="info">122 NGO / 314 biznes</div>
                    <div class="link">
                        <a href="#"><?= __d('krs', 'LC_KRS_POSLOWIE_BLOCK_LINK') ?></a>
                    </div>
                </div>
                <div class="blockInfo col-xs-6 col-md-3">
                    <div class="logo">
                        <img class="main" src="http://resources.sejmometr.pl/s_kluby/1_t.png"
                             alt="Platforma Obywatelska"/>
                    </div>
                    <div class="name">Platforma Obywatelska</div>
                    <div class="info">122 NGO / 314 biznes</div>
                    <div class="link">
                        <a href="#"><?= __d('krs', 'LC_KRS_POSLOWIE_BLOCK_LINK') ?></a>
                    </div>
                </div>
                <div class="blockInfo col-xs-6 col-md-3">
                    <div class="logo">
                        <img class="main" src="http://resources.sejmometr.pl/s_kluby/1_t.png"
                             alt="Platforma Obywatelska"/>
                    </div>
                    <div class="name">Platforma Obywatelska</div>
                    <div class="info">122 NGO / 314 biznes</div>
                    <div class="link">
                        <a href="#"><?= __d('krs', 'LC_KRS_POSLOWIE_BLOCK_LINK') ?></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="poslowieDetails">
        <div class="container">
            <div class="row">
                <div class="blockInfo col-xs-6 col-md-3">
                    <div class="logo">
                        <div class="circle">
                            <img class="main" src="http://resources.sejmometr.pl/s_kluby/1_t.png"
                                 alt="Platforma Obywatelska"/>
                        </div>
                        <img class="addon" src="http://resources.sejmometr.pl/s_kluby/1_a.png"
                             alt="Platforma Obywatelska"/>
                    </div>
                    <div class="name">Platforma Obywatelska</div>
                    <div class="info">122 NGO / 314 biznes</div>
                    <div class="link">
                        <a href="#" target="_self"><?= __d('krs', 'LC_KRS_POSLOWIE_BLOCK_LINK') ?></a>
                    </div>
                </div>
                <div class="blockInfo col-xs-6 col-md-3">
                    <div class="logo">
                        <div class="circle">
                            <img class="main" src="http://resources.sejmometr.pl/s_kluby/1_t.png"
                                 alt="Platforma Obywatelska"/>
                        </div>
                        <img class="addon" src="http://resources.sejmometr.pl/s_kluby/1_a.png"
                             alt="Platforma Obywatelska"/>
                    </div>
                    <div class="name">Platforma Obywatelska</div>
                    <div class="info">122 NGO / 314 biznes</div>
                    <div class="link">
                        <a href="#" target="_self"><?= __d('krs', 'LC_KRS_POSLOWIE_BLOCK_LINK') ?></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    */
    ?>
</div>