<?php

class DataobjectHelper extends AppHelper
{
    /**
     * @var array
     */
    protected $object;
    public $helpers = array('Number');


    public function __construct(View $view, $settings = array())
    {
        parent::__construct($view, $settings);
    }


    public function getDate($field_pattern = 'data', $add_hour = false)
    {


        if ($this->object->getDate()) {

            $temp = '<span>{day}</span><p>{month} {year}</p>';
            $ts = strtotime($this->object->getDate());

            $formatting = array(
                'day' => date('j', $ts),
                'year' => date('Y', $ts),
                'month' => __(date('M', $ts), true),
            );

            if ($this->object->getTime()) {
                $ts = strtotime($this->object->getTime());
                $hour = date('H:i', $ts);
                $formatting['hour'] = $hour;

                $temp .= '<div class="times">{hour}</div>';
            }

            foreach ($formatting as $key => $partial)
                $temp = preg_replace('/\{' . $key . '\}/', $partial, $temp);

            return $temp;
        }
        return false;
    }

    public function getData($key = null)
    {
        if (is_null($key)) {
            return $this->object->getData();
        } else {
            if ($this->object->getData($key)) {
                return $this->object->getData($key);
            } else {
                return false;
            }
        }
    }

    private function getRenderPath($object, $theme)
    {
        return App::pluginPath('Dane') . '/View/Elements/' . $theme . '/' . $object->getDataset() . '.ctp';
    }

    public function render($object, $theme = 'default')
    {
        $this->object = $object;

        /*
        if ($theme != 'dataobjectSlider') {
            $path = $this->getRenderPath($object, $theme);
            if (!file_exists($path))
                $theme = 'default';
        }
        */

        return $this->_View->element($theme, array('item' => $this->object->getObject(), 'object' => $this->object, 'theme' => $theme, 'file' => $this->object->getDataset()), array('plugin' => 'Dane'));
    }
    
    public function highlights()
    {
	    
	    $output = '';
	    
	    $fields = $this->object->getHighlightsFields();
	    $fields_count = count( $fields );
	    if( $fields_count )
	    {
		    
		    $col_width = 3;
		    
		    if( $fields_count==1 )
		    	$col_width = 12;
	    	elseif( $fields_count==2 )
		    	$col_width =6;
		    elseif( $fields_count==3 )
		    	$col_width = 4;
		    
		    $output .= '<div class="row dataHighlights dimmed">';
		    
		    foreach($fields as $field => $field_params)
		    {
			    
			    $field_value = $this->object->getData( $field );
			    
			    if( is_array($field_params) )
			    {
				    
				    $field_label = $field_params['label'];
				    
				    if( isset($field_params['img']) )
				    {
					    
					    $field_value = '<img src="' . $field_params['img'] . '" />' . $field_value;
					    
				    }
				    
			    }
			    else
			    {
				    $field_label = $field_params;
			    }			    
			    
			    $output .= '<div class="dataHighlight col-md-6"><p class="_label">' . $field_label . ':</p><p class="_value">' . $field_value . '</p></div>';
			    
		    }
		    
		    $output .= '</div>';
	    }
	    
	    return $output;
	    
    }

} 