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

function pl_wiek($data)
{
    $birthDate = explode("-", substr($data, 0, 10));
    $age = (date("md", date("U", mktime(0, 0, 0, $birthDate[1], $birthDate[2], $birthDate[0]))) > date("md") ? @((date("Y") - $birthDate[0]) - 1) : @(date("Y") - $birthDate[0]));
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

function dataSlownie($data)
{
    $_data = $data;
	
	if( strpos($data, '/') ) {
		$parts = explode('/', $data);
		$data = $parts[2] . '-' . $parts[1] . '-' . $parts[0];
	}
	
    $timestamp = strtotime($data);
    if (!$timestamp)
        return false;

    $data = date('Y-m-d', $timestamp);

    if ($data == date('Y-m-d', time())) // TODAY
    {

        $str = 'dzisiaj';

    } else {


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

        $dzien = (int)$parts[2];
        $miesiac = (int)$parts[1];
        $rok = (int)$parts[0];


        $str = $dzien . ' ' . $___vars['miesiace']['celownik'][$miesiac] . ' ' . $rok . ' r.';

    }

    /*
    $time_str = @substr($_data, 11, 5);
    if( $time_str )
        $str .= ' ' . $time_str;
    */


    return '<span class="_ds" value="' . strip_tags($data) . '">' . $str . '</span>';

}


if (!function_exists('startsWith')) {
    function startsWith($haystack, $needle)
    {
        return $needle === "" || stripos($haystack, $needle) === 0;
    }
}

if (!function_exists('endsWith')) {
    function endsWith($haystack, $needle)
    {
        return $needle === "" || strtoupper(substr($haystack, -strlen($needle))) === strtoupper($needle);
    }
}

#    Output easy-to-read numbers
#    by james at bandit.co.nz

function _currency($value)
{
	$parts = explode(',', number_format($value, 2, ',', ' '));	
	return '<span class="_currency">' . $parts[0] . '<span class="_subcurrency">,' . $parts[1] . ' PLN</span></span>';
}

function _number($value)
{
	return '<span class="_number">' . number_format($value, $decimals = 0, $dec_point = '', $thousands_sep = ' ') . '</span>';
}

function number_format_h($n, $decimals = 0, $dec_point = '.', $thousands_sep = ' ')
{
    // first strip any formatting;
    $n = (0 + str_replace(",", "", $n));
	
    // is this a number?
    if (!is_numeric($n)) return false;
	
	$_n = abs( $n );
	
    // now filter it;
    if ($_n > 1000000000000000) return round(($n / 1000000000000000), 1) . ' Bld';
    else if ($_n > 1000000000000) return round(($n / 1000000000000), 1) . ' B';
    else if ($_n > 1000000000) return round(($n / 1000000000), 1) . ' Mld';
    else if ($_n > 1000000) return round(($n / 1000000), 1) . ' M';
    else if ($_n > 1000) return round(($n / 1000), 1) . ' k';

    return number_format($n, $decimals, $dec_point, $thousands_sep);
}

function atomTime($inp = false)
{
    if ($inp === false)
        return date('Y-m-d\TH:i:s\Z', time());
    else
        return date('Y-m-d\TH:i:s\Z', strtotime($inp));
}