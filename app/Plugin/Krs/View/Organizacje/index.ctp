<?php $this->Combinator->add_libs('css', $this->Less->css('krs', array('plugin' => 'Krs'))) ?>

<div class="container<? if ($results) echo " results"; ?>" id="krs">
    <div class="row">
        <div class="col-xs-12 col-sm-10 col-md-8 col-sm-offset-1 col-md-offset-2">
            <h2><?php echo __d('krs', 'LC_KRS_HEADLINE'); ?></h2>

            <div class="krsBlock col-xs-12 col-sm-6 pull-left">
                <div class="row">
                    <p><?php echo __d('krs', "LC_KRS_SZUKAJ_ORGANIZACJI"); ?></p>
                </div>
                <div class="row">
                    <form action="/krs" method="get">
                        <div class="input-group">
                            <?php if ($results) {
                                echo $this->Form->input('organizacja', array('label' => false, 'class' => 'form-control', 'placeholder' => __d('krs', "LC_KRS_SZUKAJ_ORGANIZACJI_PLACEHOLDER"), 'id' => 'org', 'name' => 'org', 'value' => $org));
                            } else {
                                echo $this->Form->input('organizacja', array('label' => false, 'class' => 'form-control input-lg', 'placeholder' => __d('krs', "LC_KRS_SZUKAJ_ORGANIZACJI_PLACEHOLDER"), 'id' => 'org', 'name' => 'org', 'value' => $org));
                            }?>
                            <span class="input-group-btn">
                                <button class="btn btn-success<?php if (!$results) echo ' btn-lg' ?>" type="submit"
                                        data-icon="&#xe600;"></button>
                            </span>
                        </div>
                    </form>
                </div>
            </div>
            <div class="krsBlock col-xs-12 col-sm-6 pull-right">
                <div class="row">
                    <p><?php echo __d('krs', "LC_KRS_SZUKAJ_OSOB"); ?></p>
                </div>
                <div class="row">
                    <form action="/krs" method="get">
                        <div class="input-group">
                            <?php if ($results) {
                                echo $this->Form->input('osoba', array('label' => false, 'class' => 'form-control', 'placeholder' => __d('krs', "LC_KRS_SZUKAJ_OSOB_PLACEHOLDER"), 'id' => 'osb', 'name' => 'osb', 'value' => $osb));
                            } else {
                                echo $this->Form->input('osoba', array('label' => false, 'class' => 'form-control input-lg', 'placeholder' => __d('krs', "LC_KRS_SZUKAJ_OSOB_PLACEHOLDER"), 'id' => 'osb', 'name' => 'osb', 'value' => $osb));
                            } ?>
                            <span class="input-group-btn">
                                <button class="btn btn-success<?php if (!$results) echo ' btn-lg' ?>" type="submit"
                                        data-icon="&#xe600;"></button>
                            </span>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="row" id="results">
        <div class="col-xs-12 col-sm-10 col-md-8 col-sm-offset-1 col-md-offset-2">
            <? /*RESULTS FOR FOUND ORGANIZATION*/ ?>
            <? if (isset($organization)) { ?>
                <? if (!empty($organization)) { ?>
                    <ul class="organization">
                        <? foreach ($organization as $org) { ?>
                            <li>
                                <a href="/dane/krs_podmioty/<?= $org->getId(); ?>">
                                    <p><?= $org->getData('nazwa'); ?></p>
                                </a>
                            </li>
                        <? } ?>
                    </ul>
                <? } else { ?>
                    <h2><?php echo __d('krs', 'LC_KRS_SZUKAJ_ORGANIZACJI_NO_RESULTS'); ?></h2>
                <? } ?>
            <? } ?>

            <? /*RESULTS FOR FOUND PERSON*/ ?>
            <? if (isset($osoba)) { ?>
                <? if (!empty($osoba)) { ?>
                    <ul class="osoba">
                        <? foreach ($osoba as $osb) { ?>
                            <li>
                                <a href="/dane/krs_podmioty/<?= $osb->getId(); ?>">
                                    <p><?= $osb->getData('nazwa'); ?></p>
                                </a>
                            </li>
                        <? } ?>
                    </ul>
                <? } else { ?>
                    <h2><?php echo __d('krs', 'LC_KRS_SZUKAJ_OSOBA_NO_RESULTS'); ?></h2>
                <? } ?>
            <? } ?>
        </div>
    </div>
</div>