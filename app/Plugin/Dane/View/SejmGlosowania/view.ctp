<?php $this->Combinator->add_libs('js', 'highcharts/highcharts'); ?>
<?php $this->Combinator->add_libs('js', 'highcharts/locals'); ?>
<?php $this->Combinator->add_libs('js', 'Dane.highcharts-sejmglosowania'); ?>
<?php $this->Combinator->add_libs('css', $this->Less->css('view-sejmglosowania', array('plugin' => 'Dane'))); ?>

<?= $this->Element('dataobject/pageBegin') ?>

<?
$wynikiKlubowe = $object->loadLayer('wynikiKlubowe');
$chartData = array(
    array(
        'id' => 'z',
        'count' => $object->getData('z'),
        'label' => 'Za',
    ),
    array(
        'id' => 'p',
        'count' => $object->getData('p'),
        'label' => 'Przeciw',
    ),
    array(
        'id' => 'w',
        'count' => $object->getData('w'),
        'label' => 'Wstrzymania',
    ),
    array(
        'id' => 'n',
        'count' => $object->getData('n'),
        'label' => 'Nieobecności',
    ),
);
$dictionary = array(
    '1' => array('Za', 'z'),
    '2' => array('Przeciw', 'p'),
    '3' => array('Wstrzymanie', 'w'),
    '4' => array('Brak kworum', 'n'),
);
?>

    <div class="object glosowanie_stats">

        <div class="row">
            <div class="col-md-4 sejm_glosowania">
                <p class="wynikGlosowania <?= $dictionary[$object->getData('wynik_id')][1]; ?> label"><?= $dictionary[$object->getData('wynik_id')][0]; ?></p>

                <div class="highchart" data-wynikiKlubowe='<?= json_encode($chartData) ?>'></div>

            </div>
            <div class="col-md-8">
                <div class="block">
                    <h2>Wyniki klubowe</h2>

                    <table class="clubTable table">
                        <thead>
                        <tr>
                            <th><?= __d('dane', 'LC_SEJMGLOSOWANIA_KLUBY_NAZWAKLUBU') ?></th>
                            <th><?= __d('dane', 'LC_SEJMGLOSOWANIA_KLUBY_LICZEBNOSCKLUBU') ?></th>
                            <th><?= __d('dane', 'LC_SEJMGLOSOWANIA_KLUBY_LICZBAGLOSUJACYCH') ?></th>
                            <th><?= __d('dane', 'LC_SEJMGLOSOWANIA_KLUBY_NIEOBECNI') ?></th>
                            <th><?= __d('dane', 'LC_SEJMGLOSOWANIA_KLUBY_ZA') ?></th>
                            <th><?= __d('dane', 'LC_SEJMGLOSOWANIA_KLUBY_PRZECIW') ?></th>
                            <th><?= __d('dane', 'LC_SEJMGLOSOWANIA_KLUBY_WSTRZYMALISIE') ?></th>
                            <th><?= __d('dane', 'LC_SEJMGLOSOWANIA_KLUBY_LICZBABUNTOW') ?></th>
                        </tr>
                        </thead>
                        <tbody>
                        <? foreach ($object->getLayer('wynikiKlubowe') as $row) { ?>
                            <tr>
                                <td class="club" data-club-id="<?= $row['klub_id'] ?>">
                                    <? if ($row['klub_id'] != '7') { ?>
                                        <img src="http://resources.sejmometr.pl/s_kluby/<?= $row['klub_id'] ?>_a.png"
                                             alt="<?= $row['klub_nazwa'] ?>"/>
                                    <? } ?>
                                    <strong><?= $row['klub_nazwa'] ?></strong>
                                </td>
                                <td><?= $row['l'] ?></td>
                                <td><?= $row['g'] ?></td>
                                <td class="notVoted" data-glos-id="4"><?= $row['n'] ?></td>
                                <td class="voteYes" data-glos-id="1"><?= $row['z'] ?></td>
                                <td class="voteNo" data-glos-id="2"><?= $row['p'] ?></td>
                                <td class="voteHold" data-glos-id="3"><?= $row['w'] ?></td>
                                <td><?= $row['b'] ?></td>
                            </tr>
                        <? } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-md-12">
            <div class="block indywidualneTable">
                <h2>Wyniki indywidualne</h2>

                <? foreach ($object->getLayer('wynikiIndywidualne') as $person) { ?>
                    <div class="slide col-xs-6 col-md-4">
                        <div class="person">
                            <div class="avatar">
                                <img src="http://resources.sejmometr.pl/mowcy/a/0/<?= $person['poslowie']['id'] ?>.jpg"
                                     alt="<?= $person['poslowie']['nazwa'] ?>" onerror="imgFixer(this);"/>
                            </div>
                            <div class="info">
                                <a class="poselName" href="<?= $person['poslowie']['id'] ?>"
                                   target="_self"><?= $person['poslowie']['nazwa'] ?></a>
                                <a class="clubName" href="<?= $person['kluby']['id'] ?>" target="_self"
                                   title="<?= $person['kluby']['nazwa'] ?>">
                                    <img src="http://resources.sejmometr.pl/s_kluby/<?= $person['kluby']['id'] ?>_a.png"
                                         alt="<?= $person['kluby']['nazwa'] ?>"/>
                                </a>
                            </div>
                        </div>
                        <div class="voted btn btn-default btn-glos-<?= $person['glosy']['glos_id'] ?>"
                             data-glos="<?= $person['glosy']['glos_id'] ?>"><?= $person['glosy']['glos_str'] ?></div>
                    </div>
                <? } ?>
                <? debug($object->getLayer('wynikiIndywidualne')); ?>
            </div>
        </div>

    </div>

<?= $this->Element('dataobject/pageEnd') ?>