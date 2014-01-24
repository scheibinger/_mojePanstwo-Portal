<?php $this->Combinator->add_libs('css', $this->Less->css('krs', array('plugin' => 'Krs'))) ?>

<div class="container innerContent<? if ($results) { ?> results<? } ?>">

    <div class="col-xs-12 col-sm-8 col-sm-offset-2">
        <h1><?php echo __d('krs', 'LC_KRS_HEADLINE'); ?></h1>

        <form action="/krs">
            <div class="input-group main_input">
                <input name="q" value="<?= $q ?>" type="text"
                       placeholder="<?php echo __d('krs', 'LC_KRS_SZUKAJ_ORGANIZACJI'); ?>"
                       class="form-control input-lg">
                <span class="input-group-btn">
                      <input type="submit" class="btn btn-success input-lg" value="<?= __d('krs', 'LC_KRS_SZUKAJ') ?>"/>
                </span>
            </div>
        </form>

        <? if ($results) { ?>
            <div id="results">
                <ul>
                    <? foreach ($objects as $org) { ?>

                        <li>
                            <a href="/dane/krs_podmioty/<?= $org->getId(); ?>" class="title">
                                <?= $org->getData('nazwa'); ?>
                            </a>
                        </li>

                    <? } ?>
                </ul>

                <div class="button">
                    <a href="/dane/krs_podmioty?q=<?= $q ?>"
                       class="btn btn-success"><?php echo __d('krs', 'LC_KRS_WIECEJ_WYNIKOW'); ?></a>
                </div>
            </div>
        <? } else { ?>
            <h2><?php echo __d('krs', 'LC_KRS_SUBHEADLINE'); ?></h2>
        <? } ?>

    </div>
</div>