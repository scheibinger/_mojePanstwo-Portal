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
	
	echo $this->Element('Dane.dataobjectsBrowser/view', array(
		'page' => $page,
		'pagination' => $pagination,
		'filters' => $filters,
		'switchers' => $switchers,
		'facets' => $facets,
	));
		
	echo $this->Element('dataobject/pageEnd'); 