<?
$this->Combinator->add_libs('css', $this->Less->css('view-twitteraccounts', array('plugin' => 'Dane')));


/*
$this->Combinator->add_libs('css', $this->Less->css('view-twitteraccounts', array('plugin' => 'Dane')));
$this->Combinator->add_libs('css', $this->Less->css('dataobjectslider', array('plugin' => 'Dane')));
$this->Combinator->add_libs('js', 'highcharts/highcharts');
$this->Combinator->add_libs('js', 'highcharts/locals');
$this->Combinator->add_libs('js', 'Dane.highcharts-twitter-accounts');
$this->Combinator->add_libs('js', 'Dane.view-twitter-accounts');
$this->Combinator->add_libs('js', 'Dane.dataobjectsslider');

$this->Combinator->add_libs('js', 'storyjs-embed.js');









$tags_data = $object->getLayer('tags_stats');
$tags = $tags_data['data'];

$mentions_data = $object->getLayer('mentions_stats');
$mentions = $mentions_data['data'];

$urls_data = $object->getLayer('urls_stats');
$urls = $urls_data['data'];

$chart_data = $object->getLayer('followers_chart');
?>
	
	
	
	
    <script type="text/javascript">
        var chart_data = '<?php echo json_encode($chart_data); ?>';
    </script>
<?= $this->Element('dataobject/pageBegin'); ?>
    
    
    <div class="upperContent">upperContent</div>
    
    </div>
    
    <div id="timeline-embed"></div>
	<script type="text/javascript">
	var timeline_config = {
		 width: "100%",
		 height: 500,
		 source: '<?= $object->getId() ?>/timeline.json',
		 embed_id: 'timeline-embed',
		 css: '/css/timelinejs/timeline.css',
	     js: '/js/timelinejs/timeline-min.js',
	     
	}
	</script>
	
	<div>
    
    <div class="col-md-12">
        <div class="object">
            
            <div class="col-md-12">
                <div class="dataobjectsSliderRow" data-row="1">
                    <? echo $this->dataobjectsSlider->render($latest_tweets, array(
                        'perGroup' => 3,
                    )); ?>
                </div>
                
            </div>
            
            
            <div>
    	
		    	<div class="col-lg-9 left-panel">
		    		<div id="chart">

	                </div>
		    	</div>
		            
		
		        <div class="col-lg-3 right-panel">
		            <h4>Wzmianki</h4>
		            <ul class="list-group">
		                <? foreach ($mentions as $mention) { ?>
		                    <li class="list-group-item">
		                        <span class="badge"><?php echo $mention['count']; ?></span>
		                        <a href="#" class="small" data-id="<?php echo $mention['id']; ?>">
		                            <?= $mention['twitter_name'] ?>
		                        </a>
		                    </li>
		                <? } ?>
		            </ul>
		            <h4>Hashtagi</h4>
		            <ul class="list-group">
		                <? foreach ($tags as $tag) { ?>
		                    <li class="list-group-item">
		                        <span class="badge"><?php echo $tag['count']; ?></span>
		                        <a href="#" class="small">#<?= $tag['tag'] ?></a>
		                    </li>
		
		                <? } ?>
		            </ul>
		            <h4>Linki</h4>
		            <ul class="list-group">
		                <? foreach ($urls as $url) { ?>
		                    <li class="list-group-item">
		                        <a rel="nofollow" class="small url" href="<?= $url['url'] ?>" target="_blank"
		                           data-url="<?php echo $url['url']; ?>"><?= array_shift(preg_split('/\//', preg_replace('/(http|https)\:\/\//', '', $url['url']))); ?></a>
		                    </li>
		                <? } ?>
		            </ul>
		        </div>
		            
		
		            
		    </div>
            
        </div>
    </div>
*/
?>

<? // echo $this->Element('dataobject/pageEnd'); ?>