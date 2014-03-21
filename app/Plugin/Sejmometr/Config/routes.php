<?

Router::connect('/sejmometr', array('plugin' => 'Sejmometr', 'controller' => 'Sejmometr', 'action' => 'index'));
Router::connect('/sejmometr/:action', array('plugin' => 'Sejmometr', 'controller' => 'Sejmometr'));