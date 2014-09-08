<ul class="options list-group">
    <?
    $field = $filter['filter']['field'];
    $name = str_replace('.', ':', $field);
    $value = array_key_exists($field, $conditions) ? $conditions[$field] : false;

    // debug($value, true, false);

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
                <a href="/dane/<?= $option['id'] ?><? if (isset($this->request->query['q'])) echo addslashes("?q=" . $this->request->query['q']); ?>"
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