<?php $this->Combinator->add_libs('css', $this->Less->css('htmlexDocMain')); ?>
<?php $this->Combinator->add_libs('css', $this->Less->css('mapaprawa', array('plugin' => 'Mapaprawa'))) ?>

<?php $this->Combinator->add_libs('js', 'highcharts/highcharts'); ?>
<?php $this->Combinator->add_libs('js', 'highcharts/locals'); ?>
<?php $this->Combinator->add_libs('js', 'mapaprawa.highcharts-init'); ?>
<?php $this->Combinator->add_libs('js', 'mapaprawa.mapaprawa-graph'); ?>

<?php echo $this->Html->script('//cdn.jsdelivr.net/raphael/2.1.0/raphael-min.js', array('block' => 'scriptBlock')); ?>
<?php echo $this->Html->script('//cdn.jsdelivr.net/jsrender/1.0pre35/jsrender.min.js', array('block' => 'scriptBlock')); ?>

<script>var data = <?php echo json_encode($path); ?></script>

<div id="mapaprawa">
    <div class="container">
        <div class="row headline">
            <div class="col-md-2 intro"><?= __d('mapaprawa', 'LC_MAPAPRAWA_PROJEKT_USTAWY') ?>:</div>
            <div class="col-md-10 content">
                <h2><?= $projekt->getData('tytul_skrocony') ?></h2>
                <button class="innerButton"><?= __d('mapaprawa', 'LC_MAPAPRAWA_DZIALAJ') ?></button>
            </div>
        </div>

        <div class="row descline">
            <div class="col-md-2 intro">&nbsp;</div>
            <div class="col-md-10 content info">
                <div class="section">
                    <h3><?= __d('mapaprawa', 'LC_MAPAPRAWA_PROJEKT_OCOCHODZI') ?></h3>

                    <p class="value"><?= $projekt->getData('opis'); ?></p>
                </div>
            </div>
        </div>

        <div class="row graph">
            <div class="col-md-2">
                sidebar
            </div>
            <div class="col-md-10">
                <div class="graphContent">
                    <div class="lawMapContent content">
                        <div id="lawMap" class="lawMap">
                            <div id="svgLines"></div>
                            <?php $nodeCenter = 150;
                            $padding = 45; ?>

                            <?php foreach ($path as $p) { ?>
                                <div class="slide<?php if (isset($p['status'])) echo ' ' . $p['status']; ?>"
                                     data-slide="<?= $p['id'] ?>">
                                    <div class="desc<? if ($p['sublabel']) { ?> sub<? } ?>">
                                        <p><?= $p['label'] ?></p>
                                        <small class="date"><?= substr($p['date'], 0, 10) ?></small>
                                        <? if ($p['sublabel']) { ?>
                                            <span class="sublabel"><?= $p['sublabel'] ?></span>
                                        <? } ?>
                                    </div>
                                    <div class="lastIcon icon icon-<?= $p['icon'] ?>"></div>
                                    <div class="path">
                                        <?php $pos = $nodeCenter; ?>
                                        <?php $posPadding = true; ?>

                                        <?php foreach ($p['nodes'] as $node) { ?>

                                            <?php if ($posPadding && (count($p['nodes']) > 1)) { ?>
                                                <?php $padding = (count($p['nodes']) * $padding) / 2; ?>
                                                <?php $pos = $pos + $padding - 17.5; ?>
                                                <?php $posPadding = false; ?>
                                            <?php } ?>
                                            <div id="node_<?= $node['id'] ?>"
                                                 class="icon icon-small icon-<?= $node['icon'] ?>
                                            <?php if (isset($node['status'])) {
                                                     echo ' active';
                                                 } ?>"
                                                 style="right:<?= $pos; ?>px"
                                                 <?php if (isset($node['parent_id'])){ ?>data-parent='[<?php foreach ($node['parent_id'] as $index => $i) {
                                                     if ($index != 0) {
                                                         echo ',' . '"' . $i . '"';
                                                     } else {
                                                         echo '"' . $i . '"';
                                                     }
                                                 } ?>]'
                                                <?php } ?>>
                                            </div>
                                            <?php if (isset($node['status'])) { ?>
                                                <?php $nodeCenter = $pos; ?>
                                            <?php } ?>

                                            <?php $pos = $pos - $padding; ?>
                                        <?php } ?>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row info">
            <div class="col-md-10 col-md-offset-2">
                <div class="column col-md-6">
                    <div class="section autor">
                        <h3><?= __d('mapaprawa', 'LC_MAPAPRAWA_AUTOR') ?></h3>

                        <p>Ministerstwo Transportu, Budownictwa i Gospodarki Morskiej</p>
                    </div>
                    <div class="section ludzie">
                        <h3><?= __d('mapaprawa', 'LC_MAPAPRAWA_LUDZIE') ?></h3>

                        <p>Osoby które odegrały kluczowe role w pracach nad projektem.</p>
                        <ul class="ludzieList">
                            <li class="col-xs-12">
                                <div class="col-xs-1">
                                    <div class="row">
                                        <img src="http://resources.sejmometr.pl/mowcy/a/3/393.jpg">
                                    </div>
                                </div>
                                <div class="col-xs-10">
                                    <p class="header">
                                        <a href="/dane/poslowie/402">Jacek Tomczak</a>
                                    </p>

                                    <p>Przedstawiciel wnioskodawców</p>
                                </div>
                            </li>
                            <li class="col-xs-12">
                                <div class="col-xs-1">
                                    <div class="row">
                                        <img src="http://resources.sejmometr.pl/mowcy/a/3/393.jpg">
                                    </div>
                                </div>
                                <div class="col-xs-10">
                                    <p class="header">
                                        <a href="/dane/poslowie/402">Jacek Tomczak</a>
                                    </p>

                                    <p>Przedstawiciel wnioskodawców</p>
                                </div>
                            </li>
                            <li class="col-xs-12">
                                <div class="col-xs-1">
                                    <div class="row">
                                        <img src="http://resources.sejmometr.pl/mowcy/a/3/393.jpg">
                                    </div>
                                </div>
                                <div class="col-xs-10">
                                    <p class="header">
                                        <a href="/dane/poslowie/402">Jacek Tomczak</a>
                                    </p>

                                    <p>Przedstawiciel wnioskodawców</p>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div class="section hyperlink">
                        <a href="#">Osoby które wypowiadały sie w sprawie projektu &gt;</a>
                        <a href="#">Posłowie którzy złożyli podpis pod projektem &gt;</a>
                    </div>
                </div>
                <div class="column col-md-6">
                    <div class="section opinie">
                        <h3><?= __d('mapaprawa', 'LC_MAPAPRAWA_OPINIE') ?></h3>

                        <p>Opinie dotyczące projektu stworzone lub zlecone z pieniedzy publicznych.</p>
                        <ul class="opinieDocs">
                            <li class="col-xs-4 col-sm-3"><img src="http://placehold.it/100x140" alt=""/></li>
                            <li class="col-xs-4 col-sm-3"><img src="http://placehold.it/100x140" alt=""/></li>
                            <li class="col-xs-4 col-sm-3"><img src="http://placehold.it/100x140" alt=""/></li>
                            <li class="col-xs-4 col-sm-3"><img src="http://placehold.it/100x140" alt=""/></li>
                        </ul>
                    </div>
                    <div class="section statystyki">
                        <h3><?= __d('mapaprawa', 'LC_MAPAPRAWA_STATYSTYKI') ?></h3>

                        <p>Dni poswiecone na prace nad projektem <strong>100</strong></p>

                        <div class="innergraph">
                            <div class="highchart"
                                 data-chart='[{"color":"#105A96","count":"51.1","label":"Praca w sejmie"},{"color":"#67DC12","count":"45.7","label":"Praca w rządzie"},{"color":"#CC33C4","count":"3.2","label":"Praca w domu"}]'></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>