<?
	$this->Combinator->add_libs('css', $this->Less->css('view-sejmposiedzenia-databrowser-fix', array('plugin' => 'Dane')));
	echo $this->Element('dataobject/menuTabs', array(
		'menu' => $_menu,
	));
