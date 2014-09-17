<?
$this->Combinator->add_libs('css', $this->Less->css('view-administracjapubliczna', array('plugin' => 'Dane')));
// $this->Combinator->add_libs('css', $this->Less->css('dataobjectslider', array('plugin' => 'Dane')));
$this->Combinator->add_libs('js', 'Dane.view-administracjapubliczna');
?>
<?
$object = $this->viewVars['object'];
$objectOptions = $this->viewVars['objectOptions'];
$menu = $this->viewVars['menu'];

$buttons = isset($objectOptions['buttons']) ? $objectOptions['buttons'] : array('shoutIt');
?>
<?php $this->Combinator->add_libs('css', $this->Less->css('dataobject', array('plugin' => 'Dane'))) ?>
<?php $this->Combinator->add_libs('css', $this->Less->css('dataobjectpage', array('plugin' => 'Dane'))) ?>
<?php $this->Combinator->add_libs('css', $this->Less->css('naglosnij', array('plugin' => 'Dane'))) ?>

<?php $this->Combinator->add_libs('js', array('Dane.naglosnij', 'Dane.related-tabs')); ?>
<div class="objectsPage">
<?php if (isset($_ALERT_QUERIES)) {
    $alertArray = array();
    foreach ($_ALERT_QUERIES as $alert) {
        preg_match_all("'<em>(.*?)</em>'si", $alert['hl'], $match);
        foreach ($match[1] as $word) {
            $alertArray[] = $word;
        }
        $alertArray = array_unique($alertArray);
    }

    echo $this->Element('dataobject/searchInPage', array(
        'alerts' => $alertArray
    ));
}

$info = $object->getLayer('info');
?>
    <div class="objectPageHeaderContainer">
        <div class="container">
            <div class="col-md-10">
                <div class="objectPageHeader">
                    
                    <div id="collapseDVR3" class="panel-collapse collapse in">
				        <div class="tree ">
				        
                    <?
                    	if( $nav = $object->getLayer('nav') ) {
					?>
                    
                    
					        
					        
					        <? foreach( $nav as $n ) { ?>
					        	<ul>
						        	<li>
					        		<a href="/dane/administracja_publiczna/<?= $n['id'] ?>"><span><?= $n['nazwa']; ?></span></a>
					        
					        
					        <? } ?>
					        	
					        	<ul>
					        		<li class="title">
					        			<a href="/dane/administracja_publiczna/<?= $object->getId() ?>"><?= $object->getTitle() ?></a></p>
					        		</li>
					        	</ul>
					        	
					        <? foreach( $nav as $n ) { ?>
					        	
						        	</li>
					        	</ul>				        
					        
					        <? } ?>
					        
					        </ul>
					        
					        							

                    
                    <? } else { ?>
                    	
                    	<ul>
			        		<li class="title alone">
			        			<a href="/dane/administracja_publiczna/<?= $object->getId() ?>"><?= $object->getTitle() ?></a></p>
			        		</li>
			        	</ul>
                    	
                    <? } ?>
                    
				        </div>
				    </div>

                </div>
            </div>
            <div class="nopadding col-md-2">
                <ul class="objectButtons">
                    <? foreach ($buttons as $button) { ?>
                        <li><?=
                            $this->Element('dataobject/buttons/' . $button, array(
                                'base_url' => '/dane/' . $object->getDataset() . '/' . $object->getId(),
                            )); ?></li>
                    <? } ?>
                </ul>
            </div>
        </div>
    </div>
    
    <?
	if( isset($_menu) && !empty($_menu) ) {
?>
<div class="menuTabsCont">
	<div class="container">
<?
		echo $this->Element('Dane.dataobject/menuTabs', array(
			'menu' => $_menu,
		));
?>
	</div>
</div>

<? } ?>


<? if ($menuMode == 'vertical') { ?>
<div class="objectsPageWindow">
    <div class="container">
    <div class="row">
    <? if (count($menu)) { ?>
    <div class="col-md-2">
        <?= $this->Element('dataobject/pageMenu'); ?>
    </div>
    <div class="col-md-10">
    <?= $this->Element('dataobject/pageRelated'); ?>
    <div class="objectsPageContent main<? if (isset($showRelated) && $showRelated) { ?> hide<? } ?>">
    <? } else { ?>
    <div class="col-md-12">
    <?= $this->Element('dataobject/pageRelated'); ?>
    <div class="objectsPageContent main<? if (isset($showRelated) && $showRelated) { ?> hide<? } ?>">
    <? } ?>

    <? } elseif ($menuMode == 'horizontal') { ?>
    <div class="objectsPageWindow">
    <div class="container">
    <div class="row">
    <?= $this->Element('dataobject/pageMenu'); ?>
    <div class="objectsPageContent main">
<? } ?>

<?

echo $this->Element('dataobject/pageRelated', array(
    'showRelated' => isset($showRelated) ? (boolean)$showRelated : false,
));

?>
    <div class="administracjaPubliczna row">
    	
    	<? if( $object->getData('file')=='1' ) { ?>
    	
	    <div class="col-lg-3 objectSide">
	        <div class="objectSideInner">
	            <ul class="dataHighlights side">
	            
	            	
	            	<? if( $object->getData('budzet_plan')*1000 ) {?>
	            	<li class="dataHighlight big">
	                    <p class="_label">Budżet roczny</p>
	                    <div>
	                        <p class="_value pull-left"><?= number_format_h($object->getData('budzet_plan')*1000) ?> PLN</p>
	                        <p class="pull-right nopadding"><a class="btn btn-sm btn-default" href="/dane/administracja_publiczna/<?= $object->getId() ?>/budzet">Szczegóły &raquo;</a></p>
	                    </div>
	                </li>
	                <? } ?>
	                
	                
	                
	                
	            	
	                <? 
	                	if( $www = $object->getData('www') ) {
							$url = ( stripos($www, 'http')===false ) ? 'http://' . $www : $www;
	                ?>
	                <li class="dataHighlight<? if( $object->getData('budzet_plan')*1000 ) {?> topborder<?}?>">
	                    <p class="_label">Adres WWW</p>
	                    <p class="_value"><a target="_blank" title="<?= addslashes($object->getTitle()) ?>" href="<?= $url ?>"><?= $www; ?></a></p>
	                </li>
	                <? } ?>
	                
	                <? if( $email = $object->getData('email') ) {?>
	                <li class="dataHighlight">
	                    <p class="_label">Adres e-mail</p>
	                    <p class="_value"><a target="_blank" href="mailto:<?= $email ?>"><?= $email; ?></a></p>
	                </li>
	                <? } ?>
	                
	                <? if( $object->getData('phone') ) {?>
	                <li class="dataHighlight">
	                    <p class="_label">Telefon</p>
	                    <p class="_value"><?= $object->getData('phone'); ?></p>
	                </li>
	                <? } ?>
	                
	                <? if( $object->getData('fax') ) {?>
	                <li class="dataHighlight">
	                    <p class="_label">Fax</p>
	                    <p class="_value"><?= $object->getData('fax'); ?></p>
	                </li>
	                <? } ?>
					
					
					
					
	                
	            </ul>
	
	
	    
	
	        </div>
	    </div>
	
	
	    <div class="col-lg-9 objectMain">
	        <div class="object mpanel">
	            
	            <?
	            $adres = $object->getData('adres_str');
                $re = "/^([0-9][0-9][-][0-9][0-9][0-9])/";

                if (preg_match($re, $adres, $matches)) {
                    $adres_map = substr($adres, 7);
                } else {
                    $adres_map = $adres;
                }
                ?>
	            <div class="profile_baner" data-adres="<?= urlencode($adres) ?>">
	                <div class="bg">
	                    <img
                            src="http://maps.googleapis.com/maps/api/staticmap?center=<?= urlencode($adres_map) ?>&markers=<?= urlencode($adres_map) ?>&zoom=15&sensor=false&size=640x155&scale=2&feature:road"/>

                        <div class="content">
	                        <p><?= $object->getData('adres_str') ?></p>
	                        <button class="btn btn-info"><?= __d('dane', 'LC_DANE_VIEW_KRSPODMIOTY_OTWORZ_MAPE') ?></button>
	                    </div>
	                </div>
	                <div id="googleMap">
	                    <script>
	                        var googleMapAdres = '<?= $adres ?>';
	                    </script>
	                </div>
	            </div>
				
				
	            <div class="block-group">
	            		            	           	
	            	
	            	<? if( isset($info['opis_html']) && $info['opis_html'] ) { ?>
		            	<div class="block">		            		
		            		<div class="content opis">
		            			<?= $info['opis_html'] ?>
		            		</div>
		            	</div>
	            	<? } ?>
	            	
	            		            	
	            	<? if ( 
	            		( $tree = $object->getLayer('tree') ) && 
	            		( $items = $tree['items'] ) 
	            	) { ?>
	                <div class="block">
	                    <div class="block-header">
	                    	
	                    	<div class="tree">
								<ul>
									<li>
										<h2 class="label">Podległe instytucje</h2>
										<?
							    			echo $this->Element('Dane.objects/administracja_publiczna/list', array(
									    		'items' => $items,
									    		'i' => 0,
									    	));
									    ?>
									</li>
								</ul>
										
		                        
						    
                        	</div>
	                    	
	                    </div>
	               
	                </div>
		            <? } ?>
	            
	            </div>
	                
	
	        </div>
	    </div>
	    
	    <? } else { ?>
	    
	    <div class="col-md-9 col-md-offset-1">
	    	<div class="mpanel">
		    
			    <div class="block-group">
	            	
	            	
	            	<? if( isset($info['opis_html']) && $info['opis_html'] ) { ?>
		            	<div class="block">
		            		<div class="content opis">
		            			<?= $info['opis_html'] ?>
		            		</div>
		            	</div>
	            	<? } ?>
	            	
	            	<? if ( 
	            		( $tree = $object->getLayer('tree') ) && 
	            		( $items = $tree['items'] ) 
	            	) { ?>
	                <div class="block">
	                    <div class="block-header">
	                    	
	                    	<div class="tree">
								<ul>
									<li>
										<h2 class="label">Podległe instytucje</h2>
										<?
							    			echo $this->Element('Dane.objects/administracja_publiczna/list', array(
									    		'items' => $items,
									    		'i' => 0,
									    	));
									    ?>
									</li>
								</ul>
                        	</div>
	                    	
	                    </div>
	                </div>
		            <? } ?>
	            
	            </div>
		    		    	
	    	</div>
	    </div>
	    
	    <? } ?>
	    
    </div>

<?= $this->Element('dataobject/pageEnd'); ?>