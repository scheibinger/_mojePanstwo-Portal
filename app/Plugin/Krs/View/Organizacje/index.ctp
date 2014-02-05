<?php $this->Combinator->add_libs('css', $this->Less->css('krs', array('plugin' => 'Krs'))) ?>
<?php $this->Combinator->add_libs('js', 'Krs.index.js') ?>

<div<? if ($results) echo(' class="results"'); ?> id="krs">
    <div class="header">
        <div class="container">
            <h2 class="col-xs-12 col-md-8 col-md-offset-2"><?= __d('krs', 'LC_KRS_HEADER') ?></h2>

            <p class="col-xs-12 col-md-8 col-md-offset-2"><?= __d('krs', 'LC_KRS_HEADLINE') ?></p>

            <div class="searchKRS input-group col-xs-12 col-md-10 col-md-offset-1">
                <input type="text" class="form-control input-lg" name="q"
                       placeholder="<?= __d('krs', 'LC_KRS_SEARCH_PLACEHOLDER') ?>">
                    <span class="input-group-btn">
                        <button class="btn btn-success btn-lg" type="button" data-icon="&#xe600;"></button>
                    </span>
            </div>
        </div>
    </div>
    <div class="resultsList">
        <div class="container">
            <h3>Największe spółki publiczne</h3>
        </div>
    </div>
    <div class="poslowie">
        <div class="container">
            <h3><?= __d('krs', 'LC_KRS_POSLOWIE_HEADLINE') ?></h3>

            <div class="row">
                <div class="blockInfo col-xs-6 col-md-3">
                <div class="logo">
                        <img class="main" src="http://resources.sejmometr.pl/s_kluby/1_t.png"
                             alt="Platforma Obywatelska"/>
                    </div>
                    <div class="name">Platforma Obywatelska</div>
                    <div class="info">122 NGO / 314 biznes</div>
                    <div class="link">
                        <a href="#"><?= __d('krs', 'LC_KRS_POSLOWIE_BLOCK_LINK') ?></a>
                    </div>
                </div>
                <div class="blockInfo col-xs-6 col-md-3">
                    <div class="logo">
                        <img class="main" src="http://resources.sejmometr.pl/s_kluby/1_t.png"
                             alt="Platforma Obywatelska"/>
                    </div>
                    <div class="name">Platforma Obywatelska</div>
                    <div class="info">122 NGO / 314 biznes</div>
                    <div class="link">
                        <a href="#"><?= __d('krs', 'LC_KRS_POSLOWIE_BLOCK_LINK') ?></a>
                    </div>
                </div>
                <div class="blockInfo col-xs-6 col-md-3">
                    <div class="logo">
                        <img class="main" src="http://resources.sejmometr.pl/s_kluby/1_t.png"
                             alt="Platforma Obywatelska"/>
                    </div>
                    <div class="name">Platforma Obywatelska</div>
                    <div class="info">122 NGO / 314 biznes</div>
                    <div class="link">
                        <a href="#"><?= __d('krs', 'LC_KRS_POSLOWIE_BLOCK_LINK') ?></a>
                    </div>
                </div>
                <div class="blockInfo col-xs-6 col-md-3">
                    <div class="logo">
                        <img class="main" src="http://resources.sejmometr.pl/s_kluby/1_t.png"
                             alt="Platforma Obywatelska"/>
                    </div>
                    <div class="name">Platforma Obywatelska</div>
                    <div class="info">122 NGO / 314 biznes</div>
                    <div class="link">
                        <a href="#"><?= __d('krs', 'LC_KRS_POSLOWIE_BLOCK_LINK') ?></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="poslowieDetails">
        <div class="container">
            <div class="row">
                <div class="blockInfo col-xs-6 col-md-3">
                    <div class="logo">
                        <div class="circle">
                            <img class="main" src="http://resources.sejmometr.pl/s_kluby/1_t.png"
                                 alt="Platforma Obywatelska"/>
                        </div>
                        <img class="addon" src="http://resources.sejmometr.pl/s_kluby/1_t.png"
                             alt="Platforma Obywatelska"/>
                    </div>
                    <div class="name">Platforma Obywatelska</div>
                    <div class="info">122 NGO / 314 biznes</div>
                    <div class="link">
                        <a href="#" target="_self"><?= __d('krs', 'LC_KRS_POSLOWIE_BLOCK_LINK') ?></a>
                    </div>
                </div>
                <div class="blockInfo col-xs-6 col-md-3">
                    <div class="logo">
                        <div class="circle">
                            <img class="main" src="http://resources.sejmometr.pl/s_kluby/1_t.png"
                                 alt="Platforma Obywatelska"/>
                        </div>
                        <img class="addon" src="http://resources.sejmometr.pl/s_kluby/1_t.png"
                             alt="Platforma Obywatelska"/>
                    </div>
                    <div class="name">Platforma Obywatelska</div>
                    <div class="info">122 NGO / 314 biznes</div>
                    <div class="link">
                        <a href="#" target="_self"><?= __d('krs', 'LC_KRS_POSLOWIE_BLOCK_LINK') ?></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>