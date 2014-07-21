<?
	echo $this->Combinator->add_libs('css', $this->Less->css('view-gminy', array('plugin' => 'Dane')));
	if( $object->getId()=='903' ) $this->Combinator->add_libs('css', $this->Less->css('view-gminy-krakow', array('plugin' => 'Dane')));
	
	echo $this->Element('dataobject/pageBegin', array(
		'titleTag' => 'p',
	));
	
	echo $this->Element('Dane.dataobject/menuTabs', array(
		'menu' => $_menu,
	));
	
	echo $this->Element('Dane.dataobject/subobject', array(
		'menu' => $_submenu,
		'object' => $radny,
		'objectOptions' => array(
			'hlFields' => array(),
	        'bigTitle' => true,
		)
	));
	
	if( $sub_id && $oswiadczenie && $oswiadczenie->getData('dokument_id') ) {
?>
		<p class="subsubtitle">
			<a href="/dane/gminy/<?= $object->getId() ?>/radni/<?= $radny->getId() ?>/oswiadczenia"><span class="glyphicon glyphicon-align-justify"></span> Wszystkie oświadczenia</a>
		</p>
<?
		echo $this->Element('docsBrowser/doc', array(
			'document' => $document,
			'documentPackage' => $documentPackage,
		));
		
	} else {
	
		echo $this->Element('Dane.DataobjectsBrowser/view', array(
			'page' => $page,
			'pagination' => $pagination,
			'filters' => $filters,
			'switchers' => $switchers,
			'facets' => $facets,
		));
		
	}
		
	echo $this->Element('dataobject/pageEnd'); 