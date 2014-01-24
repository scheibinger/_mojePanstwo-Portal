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

    return implode(' ', $words);

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