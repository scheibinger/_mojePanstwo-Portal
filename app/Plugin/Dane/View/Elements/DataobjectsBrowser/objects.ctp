<?
if (empty($objects)) {
    echo '<p class="noResults">' . __d('dane', 'LC_DANE_BRAK_WYNIKOW') . '</p>';
} else {
    ?>

    <ul class="list-group list-dataobjects">
        <?
        $bg = false;
        foreach ($objects as $object) {
            echo $this->Dataobject->render($object['Dataobject'], 'default', array(
                'bg' => $bg,
                'hlFields' => $dataBrowser->hlFields,
                'routes' => $dataBrowser->routes,
            ));
            $bg = !$bg;
        }
        ?>
    </ul>

<? } ?>