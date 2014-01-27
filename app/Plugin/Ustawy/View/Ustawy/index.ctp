<?php $this->Combinator->add_libs('css', $this->Less->css('ustawy', array('plugin' => 'Ustawy'))) ?>

<div class="container innerContent<? if ($results) { ?> results<? } ?>">
    <h1><?php echo __d('ustawy', 'LC_USTAWY_HEADLINE'); ?></h1>

    <div class="col-xs-12 col-sm-8 col-sm-offset-2">
        <form action="/ustawy">
            <div class="input-group main_input">
                <input name="q" value="<?= $q ?>" type="text"
                       placeholder="<?php echo __d('ustawy', 'LC_USTAWY_SZUKAJ_ORGANIZACJI'); ?>"
                       class="form-control input-lg">
                <span class="input-group-btn">
                      <input type="submit" class="btn btn-success input-lg"
                             value="<?= __d('ustawy', 'LC_USTAWY_SZUKAJ') ?>"/>
                </span>
            </div>
        </form>

        <? if ($results) { ?>
            <div id="results">
                <ul>
                    <? foreach ($objects as $ustawa) {
                        $ustawa = $ustawa->getData(); ?>

                        <li>
                            <a href="/dane/ustawy/<?= $ustawa['id'] ?>" class="title">
                                <?= __d('ustawy', 'LC_USTAWY_USTAWA') . ' ' . $ustawa['tytul_skrocony'] ?>
                            </a>
                        </li>

                    <? } ?>
                </ul>

                <div class="button">
                    <a class="btn btn-success"
                       href="/dane?q=<?= $q ?>"><?php echo __d('ustawy', 'LC_USTAWY_WIECEJ_WYNIKOW'); ?></a>
                </div>
            </div>

        <? } else { ?>
            <div id="shortcuts">
                <ul>
                    <li><a href="dane/ustawy?typ_id[]=3" target="_self"><?php echo __d('ustawy', 'LC_USTAWY_WIECEJ_KODEKSY'); ?></a></li>
                    <li><a href="dane/ustawy?typ_id[]=2" target="_self"><?php echo __d('ustawy', 'LC_USTAWY_WIECEJ_KONSTYTUCJE'); ?></a></li>
                    <li><a href="dane/ustawy?typ_id[]=4" target="_self"><?php echo __d('ustawy', 'LC_USTAWY_WIECEJ_RATYFIKACJE'); ?></a>
                    <li><a href="dane/ustawy?typ_id[]=1" target="_self"><?php echo __d('ustawy', 'LC_USTAWY_WIECEJ_POZOSTALE'); ?></a></li>
                </ul>
            </div>
        <? } ?>
    </div>
</div>