<?
echo $this->Combinator->add_libs('css', $this->Less->css('view-gminy', array('plugin' => 'Dane')));
if ($object->getId() == '903') $this->Combinator->add_libs('css', $this->Less->css('view-gminy-krakow', array('plugin' => 'Dane')));
echo $this->Combinator->add_libs('css', $this->Less->css('view-gminy-radni_powiazania', array('plugin' => 'Dane')));

echo $this->Element('dataobject/pageBegin', array(
    'titleTag' => 'p',
));

$powiazania = $object->getLayer('radni_powiazania');
?>

    <div class="col-md-10 col-md-offset-1">
        <div id="powiazania" class="object mpanel">

            <? if ($powiazania) { ?>

                <h1>Powiązania radnych gminy <?= $object->getData('nazwa') ?> z organizacjami w <a href="/krs">Krajowym
                        Rejestrze Sądowym</a></h1>

                <div class="block-group">

                    <? foreach ($powiazania as $p) { ?>

                        <div class="block">

                            <div class="block-header">
                                <h2 class="label"><a
                                        href="/dane/gminy/<?= $object->getId() ?>/radni/<?= $p['radny']['id'] ?>"><?= $p['radny']['nazwa'] ?></a>
                                </h2>

                                <p class="desc"><?= $p['radny']['komitet'] ?></p>
                            </div>

                            <div class="content row">

                                <div class="col-md-2">

                                    <? if ($p['radny']['avatar'] == '1') { ?>
                                        <img
                                            src="http://resources.sejmometr.pl/avatars/5/<?= $p['radny']['avatar_id'] ?>.jpg"/>
                                    <? } elseif ($p['radny']['plec'] == 'K') { ?>
                                        <img src="http://resources.sejmometr.pl/avatars/g/w.png"/>
                                    <? } else { ?>
                                        <img src="http://resources.sejmometr.pl/avatars/g/m.png"/>
                                    <? } ?>

                                </div>
                                <div class="col-md-10">

                                    <ul>
                                        <?
                                        foreach ($p['organizacje'] as $o) {

                                            $badges = array();

                                            if ($o['relacja']['reprezentat'] == '1')
                                                $badges[] = $o['relacja']['reprezentat_funkcja'] ? $o['relacja']['reprezentat_funkcja'] : 'Członek organu reprezentacji';

                                            if ($o['relacja']['wspolnik'] == '1')
                                                $badges[] = 'Wspólnik';

                                            if ($o['relacja']['akcjonariusz'] == '1')
                                                $badges[] = 'Akcjonariusz';

                                            if ($o['relacja']['prokurent'] == '1')
                                                $badges[] = 'Prokurent';

                                            if ($o['relacja']['nadzorca'] == '1')
                                                $badges[] = 'Członek organu nadzoru';

                                            if ($o['relacja']['zalozyciel'] == '1')
                                                $badges[] = 'Członek komitetu założycielskiego';
                                            ?>
                                            <li>
                                                <a href="/dane/krs_podmioty/<?= $o['id'] ?>"><?= stripslashes($o['nazwa']) ?></a>
                                                <span
                                                    class="badge"><?= implode('</span> <span class="badge">', $badges) ?></span>
                                            </li>
                                        <? } ?>
                                    </ul>

                                </div>

                            </div>

                        </div>

                    <? } ?>
                </div>
            <? } ?>

        </div>
    </div>

<?
echo $this->Element('dataobject/pageEnd');
?>