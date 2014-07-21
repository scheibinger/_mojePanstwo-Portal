<?php

$this->Combinator->add_libs('css', $this->Less->css('view-krspodmioty', array('plugin' => 'Dane')));

echo $this->Element('dataobject/pageBegin');
echo $this->Element('Dane.dataobject/menuTabs', array(
    'menu' => $_menu,
));

if ($zmiany = $object->getLayer('zmiany_umow')) {
    ?>
    <div class="mpanel">
        <div style="margin-top: 25px; margin-bottom: 25px;" class="col-md-10 col-md-offset-1">
            <ul class="list-group less-borders">
                <? foreach ($zmiany as $zmiana) { ?>
                    <li class="list-group-item"><?= $zmiana['zmiana_tekst'] ?></li>
                <? } ?>
            </ul>
        </div>
    </div>
<?
}

echo $this->Element('dataobject/pageEnd');