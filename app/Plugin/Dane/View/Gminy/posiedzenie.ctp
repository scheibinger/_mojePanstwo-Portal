<?
echo $this->Combinator->add_libs('css', $this->Less->css('view-gminy', array('plugin' => 'Dane')));
if ($object->getId() == '903') $this->Combinator->add_libs('css', $this->Less->css('view-gminy-krakow', array('plugin' => 'Dane')));

echo $this->Element('dataobject/pageBegin', array(
    'titleTag' => 'p',
));

echo $this->Element('Dane.dataobject/menuTabs', array(
    'menu' => $_menu,
));

echo $this->Element('Dane.dataobject/subobject', array(
    'menu' => isset($_submenu) ? $_submenu : false,
    'object' => $posiedzenie,
    'objectOptions' => array(
        'hlFields' => array(),
        'bigTitle' => true,
        'routes' => array(
            'shortTitle' => 'pageTitle'
        ),
    ),
));


echo $this->Element('Dane.DataobjectsBrowser/view', array(
    'page' => $page,
    'pagination' => $pagination,
    'filters' => $filters,
    'switchers' => $switchers,
    'facets' => $facets,
));

echo $this->Element('dataobject/pageEnd');