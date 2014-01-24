<?php $this->Combinator->add_libs('css', $this->Less->css('home')) ?>
<?php $this->Combinator->add_libs('js', 'home') ?>

<div id="home" class="container">
    <div class="header row">
        <div class="col-md-10 col-md-offset-1 col-lg-8 col-lg-offset-2">
            <h2>
                <?php echo __('LC_MAINHEADER_TEXT') ?>
                <!--                <a class="learnMore" href="/przewodnik">-->
                <!--                    --><?php //echo __('LC_MAINHEADER_GUIDE') ?>
                <!--                </a>-->
            </h2>
        </div>
    </div>

    <div class="row">
        <div class="col-md-10 col-md-offset-1 col-lg-8 col-lg-offset-2">
            <p class="msg">
                To jest wersja alpha <b>_mojego</b>Państwa. Portal zostanie uruchomiony wkrótce.
            </p>
        </div>
    </div>

    <? /*
    <div class="globalSearch row">
        <div class="col-sm-10 col-md-8 col-md-offset-2 col-lg-6 col-sm-offset-1 col-md-offset-2 col-lg-offset-3">

            <div class="input-group">
            		<form action="/dane" method="get">
	                <input name="q" type="text" class="form-control" placeholder="<?php echo __('LC_SEARCH_PUBLIC_DATA_PLACEHOLDER') ?>">
	                <input type="submit" name="submit" style="display: none;" />
	                <span class="input-group-btn">
	                    <button class="btn btn-default" type="button" data-icon="&#xe600;"></button>
	                </span>
            		</form>
            </div>

        </div>
    </div>
    */
    ?>

    <div class="apps row">
        <div class="col-md-12 col-lg-12">
            <ul class="row">
                <?php foreach ($_APPLICATIONS as $key => $app) { ?>
                    <li class="col-xs-5 col-sm-2<?php
                    if ($key % 2 == 0)
                        echo(' ' . 'col-xs-offset-1');
                    if ($key % 2 == 0 && $key % 5 != 0)
                        echo(' ' . 'col-sm-offset-0');
                    if ($key % 5 == 0)
                        echo(' ' . 'col-sm-offset-1');
                    ?>">
                        <?php if ($app['Application']['type'] == 'app') { ?>
                            <a class="appContruct" href="/<?= $app['Application']['slug'] ?>">
                                <div class="appIcon">
                                    <div class="innerIcon">
                                        <img
                                            src="/<?= $app['Application']['plugin'] ?>/icon/<?= $app['Application']['slug'] ?>.svg"
                                            alt="<?= $app['Application']['name'] ?>"/>
                                    </div>
                                </div>
                                <div class="appName">
                                    <?= $app['Application']['name'] ?>
                                </div>
                            </a>
                        <?php } else if ($app['Application']['type'] == 'folder') { ?>
                            <div class="appContruct appFolder" data-folder-slug="/<?= $app['Application']['slug'] ?>">
                                <div class="appIcon">
                                    <div class="innerIcon">
                                        <img src="/icon/folder.svg"
                                             alt="<?= $app['Application']['name'] ?>"/>
                                    </div>
                                </div>
                                <div class="appName">
                                    <?= $app['Application']['name'] ?>
                                </div>
                                <ul class="appList">
                                    <?php foreach ($app['Content'] as $key => $appList) { ?>
                                        <li>
                                            <a href="/<?= $appList['slug'] ?>">
                                                <div class="appIcon">
                                                    <div class="innerIcon">
                                                        <img
                                                            src="/<?= $appList['plugin'] ?>/icon/<?= $appList['slug'] ?>.svg"
                                                            alt="<?= $appList['name'] ?>"/>
                                                    </div>
                                                </div>
                                                <div class="appName">
                                                    <?= $appList['name'] ?>
                                                </div>
                                            </a>
                                        </li>
                                    <?php } ?>
                                </ul>
                            </div>
                        <? } ?>
                    </li>
                <?php } ?>
            </ul>
        </div>
    </div>
</div>