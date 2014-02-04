<?



function _ucfirst($str)
{

    $words = explode(' ', trim($str));
    foreach ($words as &$w) {

        $rest = strtolower(substr($w, 1));
        $rest = str_replace(array(
            'Ę', 'Ó', 'Ą', 'Ś', 'Ł', 'Ż', 'Ź', 'Ć', 'Ń',
        ), array(
            'ę', 'ó', 'ą', 'ś', 'ł', 'ż', 'ź', 'ć', 'ń',
        ), $rest);

        $w = strtoupper($w[0]) . $rest;

    }
		
	return str_replace(array(
		' Z ',
	), array(
		' z ',
	), implode(' ', $words));

}

function pl_wiek( $data )
{
	$birthDate = explode("-", substr($data, 0, 10));
    $age = (date("md", date("U", mktime(0, 0, 0, $birthDate[1], $birthDate[2], $birthDate[0]))) > date("md") ? ((date("Y") - $birthDate[0]) - 1) : (date("Y") - $birthDate[0]));
    return $age;
}

function pl_dopelniacz($count = 0, $formA = '', $formB = '', $formC = '', $options = array())
{
    if ($count == 0)
        return '';

    elseif ($count == 1)
        $r = $formA;

    elseif ($count < 5)
        $r = $formB;

    elseif ($count < 22)
        $r = $formC;

    else {
        $d = $count % 10;
        if ($d < 2)
            $r = $formC;

        elseif ($d < 5)
            $r = $formB;

        else
            $r = $formC;
    }


    $options['numberTag'] = isset($options['numberTag']) ? $options['numberTag'] : 'strong';

    if ($options['numberTag'])
        $count = '<' . $options['numberTag'] . '>' . $count . '</' . $options['numberTag'] . '>';

    return $count . '&nbsp;' . $r;
}

if (!function_exists('array_column')) {
    function array_column($array, $column_key, $index_key = null)
    {
        $output = array();
        if (is_array($array) && !empty($array))
            foreach ($array as $record)
                if (array_key_exists($column_key, $record)) {
                    if ($index_key)
                        $output[$record[$index_key]] = $record[$column_key];
                    else
                        $output[] = $record[$column_key];
                }
        return $output;
    }
}

function dataSlownie( $data )
{
	
	$___vars = array(
	    'miesiace' => array(
	        'celownik' => array(
	            1 => 'stycznia',
	            2 => 'lutego',
	            3 => 'marca',
	            4 => 'kwietnia',
	            5 => 'maja',
	            6 => 'czerwca',
	            7 => 'lipca',
	            8 => 'sierpnia',
	            9 => 'września',
	            10 => 'października',
	            11 => 'listopada',
	            12 => 'grudnia',
	        ),
	    ),
	);
	
	$parts = explode('-', substr($data, 0, 10));
    if (count($parts) != 3) return $data;

    $rok = (int)$parts[2];
    $miesiac = (int)$parts[1];
    $dzien = (int)$parts[0];

    return '<span class="_ds" value="' . strip_tags($data) . '">' . $rok . ' ' . $___vars['miesiace']['celownik'][$miesiac] . ' ' . $dzien . ' r.</span>';
}