<?php

class DataobjectHelper extends AppHelper
{
    /**
     * @var array
     */
    protected $object;
    public $helpers = array('Number');

    private $thumbnail_sizes_map = array(
        'poslowie' => '0',
    );

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

    public function setObject($object)
    {
        $this->object = $object;
    }

    public function render($object, $theme = 'default', $options = array())
    {
        // debug( $object->getData() );
        $bg = isset($options['bg']) ? $options['bg'] : false;
        $hlFields = isset($options['hlFields']) ? $options['hlFields'] : false;
        $bigTitle = isset($options['bigTitle']) ? $options['bigTitle'] : false;
        $hlFieldsPush = isset($options['hlFieldsPush']) ? $options['hlFieldsPush'] : false;
        $routes = isset($options['routes']) ? $options['routes'] : array();
        $forceLabel = isset($options['forceLabel']) ? $options['forceLabel'] : false;

        $this->setObject($object);
        if (!empty($routes))
            $object->addRoutes($routes);

        /*
        if ($theme != 'dataobjectSlider') {
            $path = $this->getRenderPath($object, $theme);
            if (!file_exists($path))
                $theme = 'default';
        }
        */
				
        return $this->_View->element($theme, array(
            'item' => $this->object->getObject(),
            'object' => $this->object,
            'theme' => $theme,
            'bg' => $bg,
            'hlFields' => $hlFields,
            'hlFieldsPush' => $hlFieldsPush,
            'bigTitle' => $bigTitle,
            'forceLabel' => $forceLabel,
            'file' => $this->object->getDataset(),
            'thumbSize' => $this->getThumbSize(),
            'gid' => @$this->object->id,
        ), array('plugin' => 'Dane'));
    }

    public function highlights($fields = false, $fieldsPush = false)
    {
				
        $output = '';
        $fields = $this->object->getHiglightedFields($fields, $fieldsPush);

        $fields_count = count($fields);
        if ($fields_count) {

            $col_width = 3;

            if ($fields_count == 1)
                $col_width = 12;
            elseif ($fields_count == 2)
                $col_width = 6;
            elseif ($fields_count == 3)
                $col_width = 4;
            elseif ($fields_count == 5)
                $col_width = 2;
            elseif ($fields_count == 6)
                $col_width = 2;

            $output .= '<div class="row dataHighlights dimmed';
            if ($col_width >= 6)
                $output .= ' inl';
            $output .= '">';

            foreach ($fields as $field => $field_params) {
				
				$output .= $this->getHTMLForField($field, $field_params, array(
					'col_width' => $col_width,
				));

            }

            $output .= '</div>';
        }

        return $output;

    }
	
	public function hlTable($data, $col_width = 3)
	{
		
		if( empty($data) )
			return '';
			
		$output = '<div class="dataHighlights normal">';
		$index = 0;
		
		foreach( $data as $d )
		{
						
			$id = $d['id'];
			$label = $d['label'];
			$value = $d['value'];
			
			$d['type'] = $d['options']['type'];
			$html = $this->getHTMLForField($id, $d, array(
				'col_width' => $col_width,
				'hidden' => ($index >= 4),
			));
			
			if( $html )
			{
				$output .= $html;
				$index++;
			}
		}
		
		$output .= '</div>';
		
		return $output;		
	}
	
	public function hlTableForObject($object, $fields, $col_width = 3)
	{
		$data = array();
		if( empty($fields) )
			return '';
				
		foreach( $fields as $field )
		{
		
			$schema = $object->getSchemaForFieldname( $field );
			if( $schema )
			{
				
				$options = array(
					'type' => isset($schema[2]) ? $schema[2] : 'string',
				);
				
				if( !empty($schema[3]) && is_array($schema[3]) )
					$options = array_merge($options, $schema[3]);
				
				$data[] = array(
					'id' => $field,
					'label' => $schema[1],
					'value' => $object->getData( $field ),
					'options' => $options,
				);	
				
			}
		
		}
		
		return $this->hlTable($data, $col_width);
	}
	
	public function getHTMLForField($field, $field_params, $options)
	{
				
		$output = '';
		$normalizeText = false;
		$col_width = isset( $options['col_width'] ) ? $options['col_width'] : 4;
		$hidden = isset( $options['hidden'] ) ? $options['hidden'] : false;
		
        $field_label = $field_params['label'];
        $field_value = $field_params['value'];
        $field_options = (isset($field_params['options']) && is_array($field_params['options'])) ? $field_params['options'] : array();

        $field_type = $field_params['type'];
        if (stripos($field, 'data') === 0)
            $field_type = 'date';


        if (($field_type == 'date') && !isset($field_options['format'])) {
            if ($field_value == '0000-00-00')
                continue;
            $field_value = dataSlownie($field_value);
        } elseif ($field_type == 'pln') {
            $field_value = (float) $field_value;
            if( !$field_value )
            	return false;
            $field_value = number_format_h($field_value, 2, ',', ' ') . ' PLN';
        } elseif ($field_type == 'integer') {
            if (!$field_value)
                continue;
            else
                $field_value = number_format($field_value, 0, '', ' ');
        } elseif ($field_type == 'percent') {
            $field_value .= '%';
        } elseif ($field_type == 'duration') {
            if (!$field_value)
                continue;
            else
                $field_value = number_format($field_value, 0, '', ' ') . 'm';
        }


        if (isset($field_options['format'])) {
            switch ($field_options['format']) {
                case 'wiek':
                {
                    $field_value = pl_dopelniacz(pl_wiek($field_value), 'rok', 'lata', 'lat');
                    break;
                }

                case 'bytes':
                {
                    $field_value = round($field_params['value'] / 1024);
                    $field_value = number_format($field_value, 0, '', ' ') . 'kB';
                    break;
                }
            }
        }


        if (isset($field_options['dictionary'])) {
            if (is_array($field_value)) {
                if (!empty($field_value))
                    foreach ($field_value as &$v)
                        $v = @$field_options['dictionary'][$v];
            } else {
                $field_value = @$field_options['dictionary'][$field_value];
            }
        }


        if (isset($field_options['truncate'])) {

            $base_part = substr($field_value, 0, $field_options['truncate']);
            $add_part = substr($field_value, $field_options['truncate']);
            $field_value = '<span class="base">' . $base_part . '</span>';
            if ($add_part)
                $field_value .= ' <a href="#" onclick="return false;">...</a><span class="add">' . $add_part . '</span>';

        }


        if (isset($field_options['img']))
            if (preg_match_all('/\{\$(.*?)\}/i', $field_options['img'], $matches))
                for ($m = 0; $m < count($matches[0]); $m++)
                    $field_value = '<img src="' . str_replace($matches[0][$m], $this->object->getData($matches[1][$m]), $field_options['img']) . '" /> ' . $field_value;


        if (isset($field_options['normalizeText']) && $field_options['normalizeText'])
            $normalizeText = true;


        if (isset($field_options['link'])) {
            if (is_array($field_options['link']) && isset($field_options['link']['dataset']) && isset($field_options['link']['object_id'])) {

                if (is_array($field_value)) {
                    for ($f = 0; $f < count($field_value); $f++) {
                        $object_id = ($field_options['link']['object_id'][0] == '$') ?
                            $this->object->getData(substr($field_options['link']['object_id'], 1)) :
                            $field_options['link']['object_id'];

                        $object_id = @$object_id[$f];
                        $href = '/dane/' . $field_options['link']['dataset'] . '/' . $object_id;

                        $field_value[$f] = '<a href="' . $href . '">' . $field_value[$f] . '</a>';
                    }
                } else {
                    $object_id = ($field_options['link']['object_id'][0] == '$') ?
                        $this->object->getData(substr($field_options['link']['object_id'], 1)) :
                        $field_options['link']['object_id'];

                    $href = '/dane/' . $field_options['link']['dataset'] . '/' . $object_id;

                    $field_value = '<a href="' . $href . '">' . $field_value . '</a>';
                }

            } elseif (is_array($field_options['link']) && $field_options['link']['href']) {
                $href = ($field_options['link']['href'][0] == '$') ?
                    $this->object->getData(substr($field_options['link']['href'], 1)) :
                    $field_options['link']['href'];

                $_field_value = $field_value;

                $field_value = '<a';
                if (isset($field_options['link']['newWindow']) && $field_options['link']['newWindow'])
                    $field_value .= ' target="_blank"';
                $field_value .= ' href="' . $href . '">' . $_field_value . '</a>';
            }
        }

        if (isset($field_options['dopelniacz']))
            $field_value = pl_dopelniacz($field_value, $field_options['dopelniacz'][0], $field_options['dopelniacz'][1], $field_options['dopelniacz'][2]);


        if (!empty($field_value)) {

            if (!is_array($field_value) && stripos($field_value, $field_label) === 0)
                $field_value = trim(substr($field_value, strlen($field_label)));

            $output .= '<div class="dataHighlight col-md-' . $col_width . '"';
            if( $hidden )
            	$output .= ' style="display: none;"';
            $output .= '>';

            if ($field_label && !isset($field_options['hide']))
                $output .= '<p class="_label">' . $field_label . ':</p>';

            $output .= '<p class="_value';

            if ($normalizeText)
                $output .= ' normalizeText';

            $output .= '">';

            if (is_array($field_value))
                $output .= '<ul class="hl_ul normalizeText"><li>' . implode('</li><li>', $field_value) . '</li></ul>';
            else
                $output .= $field_value;

            $output .= '</p></div>';

        }
        
        return $output;
		
	}
	
    private function getThumbSize()
    {

        return array_key_exists($this->object->getDataset(), $this->thumbnail_sizes_map) ?
            $this->thumbnail_sizes_map[$this->object->getDataset()] :
            '1';

    }

} 