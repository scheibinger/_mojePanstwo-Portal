<ul class="options list-group">
    <?
    $field = $filter['filter']['field'];
    $name = str_replace('.', ':', $field);
    $value = array_key_exists($field, $conditions) ? $conditions[$field] : false;
	
	$href_base = '';
	
    if( $parts = explode('/', $this->request->url) ) {
	    
	    $parts = array_filter($parts);
	    array_pop( $parts );
	    $href_base = '/' . implode('/', $parts) . '/';
	    
    }

    if (isset($facet['params']['options']) && is_array($facet['params']['options']) && !empty($facet['params']['options'])) {
        foreach ($facet['params']['options'] as $option) {

            // debug($option, true, false);

            $fid = 'filter_input_' . $field . $option['id'];
            if (is_array($value))
                $checked = in_array($option['id'], $value);
            else
                $checked = ($option['id'] == $value);

            ?>
            <li class="option checkbox list-group-item<? if ($checked) { ?> active<? } ?>">
                <a href="<?= $href_base . $option['id'] ?><? if( isset($this->request->query['q']) ) echo addslashes("?q=" . $this->request->query['q']); ?>"
                   target="_self">
                    <span
                        class="badge"><?= $this->Number->currency($option['count'], '', array('places' => 0)) ?></span>

                    <div class="checkbox-inline"><?= $this->Text->truncate($option['label'], 45) ?></div>
                </a>
            </li>
        <?
        }
    }
    ?>
</ul>