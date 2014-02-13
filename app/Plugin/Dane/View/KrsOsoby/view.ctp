<?= $this->Element('dataobject/pageBegin'); ?>

<?php $this->Combinator->add_libs('css', $this->Less->css('view-krsosoby', array('plugin' => 'Dane'))); ?>
<?php // $this->Combinator->add_libs('js', 'Dane.view-krspodmioty'); ?>

<?
if ($organizacje = $object->getLayer('organizacje')) {
    ?>
    <div class="object">

        <div class="block">
            <h2>Powiązane organizacje:</h2>

            <div class="content">

                <ul class="list-group less-borders">
                    <?
                    foreach ($organizacje as $organizacja) {
                        $kapitalZakladowy = (float)$organizacja['kapital_zakladowy'];
                        ?>
                        <li class="list-group-item">
                            <h3><a href="/dane/krs_podmioty/<?= $organizacja['id'] ?>"><?= $organizacja['nazwa'] ?></a>
                            </h3>

                            <p class="subtitle"><span
                                    class="normalizeText"><?= $organizacja['forma_prawna_str'] ?></span><? if ($kapitalZakladowy) { ?>
                                    <span class="separator">|</span> kapitał zakładowy: <?
                                    //setlocale(LC_MONETARY, 'pl_PL');
                                    //echo money_format('%i', $organizacja['kapital_zakladowy']);
                                    echo number_format($organizacja['kapital_zakladowy'], 2, ',', ' ') . ' PLN';
                                }?>

                                <? if (!empty($organizacja['role']))
                                {
                                ?>
                            <ul class="list-group less-borders role">
                                <? foreach ($organizacja['role'] as $rola) {
                                    ?>
                                    <li class="list-group-item">
                                        <p><span
                                                class="label label-primary"><?= $rola['label'] ?></span> <? if (isset($rola['params']['subtitle']) && $rola['params']['subtitle']) { ?>
                                                <span
                                                    class="sublabel normalizeText"><?= $rola['params']['subtitle'] ?></span><? } ?>
                                        </p>
                                    </li>
                                <?
                                }
                                ?>
                            </ul>
                            <?
                            }
                            ?>
                        </li>
                    <? } ?>
                </ul>
            </div>
        </div>
    </div>
<? } ?>

<?= $this->Element('dataobject/pageEnd'); ?>