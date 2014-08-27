<div id="_mPCockpit" class="col-md-2">
    <div class="_mPBasic">
        <div class="_mPLogo">
            <a href="/" target="_self">
                <strong>moje</strong>państwo
            </a>
        </div>
        <div class="_mPApplication">
            <div class="_mPSearch _appBlock _appBlockBackground">
                <div class="_mPTitle"><?php echo __('LC_COCKPITBAR_USER_SEARCH'); ?></div>
            </div>
            <div class="_mPAppsList _appBlock _appBlockBackground">
                <div class="_mPTitle"><?php echo __('LC_COCKPITBAR_USER_APPLICATION'); ?></div>
            </div>
            <div class="_mPFavorite _appBlock _appBlockBackground">
                <div class="_mPTitle"><?php echo __('LC_COCKPITBAR_USER_FAVOURITE'); ?></div>
            </div>
        </div>
        <div class="_mpSystem">
            <div class="_mPRunning">

            </div>
            <div class="_mPUser">
                <?php if ($this->Session->read('Auth.User.photo_small')) echo('<img src="' . $this->Session->read('Auth.User.photo_small') . '" />'); ?>
                <a href="<?php echo $this->Html->url(array('plugin' => 'paszport', 'controller' => 'users', 'action' => 'index')); ?>"><?php echo __('LC_COCKPITBAR_USER_LINK'); ?></a>
            </div>
            <div class="_mPPowerButton">
                <?php if ($this->Session->read('Auth.User.id')) { ?>
                    <a href="<?php echo $this->Html->url(array('plugin' => 'paszport', 'controller' => 'users', 'action' => 'logout')); ?>"><?php echo __('LC_COCKPITBAR_LOGOUT'); ?></a>
                <?php } else { ?>
                    <a href="<?php echo $this->Html->url(array('plugin' => 'paszport', 'controller' => 'users', 'action' => 'login')); ?>"><?php echo __('LC_COCKPITBAR_LOGIN'); ?></a>
                <?php } ?>
            </div>
        </div>
    </div>
    <div class="_mPAppList">
        <?php if (!empty($applications['list'])) {
            foreach ($applications['list'] as $app) {
                if ($app['Application']['home'] == '1') {
                    if ($app['Application']['type'] == 'app') {
                        ?>
                        <div class="_appBlock _appBlockBackground">
                            <a class="_appConstruct" href="/<?= $app['Application']['slug'] ?>">
                                <div class="_mPAppIcon">
                                    <img
                                        src="/<?= $app['Application']['plugin'] ?>/icon/<?= $app['Application']['slug'] ?>.svg"
                                        alt="<?= $app['Application']['name'] ?>"/>
                                </div>
                                <div class="_mPTitle"><?= $app['Application']['name'] ?></div>
                            </a>
                        </div>
                    <?php } else if ($app['Application']['type'] == 'folder') { ?>
                        <div class="_appConstruct _appFolder" data-folder-slug="/<?= $app['Application']['slug'] ?>">
                            <div class="_mpAppFolderIcon">
                                <img src="/icon/folder.svg" alt="<?= $app['Application']['name'] ?>"/>
                            </div>
                            <div class="_mPTitle"><?= $app['Application']['name'] ?></div>
                            <div class="_appList">
                                <?php foreach ($app['Content'] as $key => $appList) { ?>
                                    <div class="_appBlock _appBlockBackground">
                                        <a href="/<?= $appList['slug'] ?>">
                                            <div class="_mPAppIcon">
                                                <img src="/<?= $appList['plugin'] ?>/icon/<?= $appList['slug'] ?>.svg"
                                                     alt="<?= $appList['name'] ?>"/>
                                            </div>
                                            <div class="_mPTitle"><?= $appList['name'] ?></div>
                                        </a>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                    <?php
                    }
                }
            }
        } ?>
    </div>
</div>