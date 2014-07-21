<?
	echo $this->Combinator->add_libs('css', $this->Less->css('view-gminy', array('plugin' => 'Dane')));
	if( $object->getId()=='903' ) $this->Combinator->add_libs('css', $this->Less->css('view-gminy-krakow', array('plugin' => 'Dane')));

	echo $this->Element('Dane.dataobject/menuTabs', array(
		'menu' => $_menu,
	));