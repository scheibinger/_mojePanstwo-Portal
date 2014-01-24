<?php $this->Combinator->add_libs('css', $this->Less->css('htmlexDocMain')); ?>
<?php $this->Combinator->add_libs('css', $this->Less->css('htmlexDoc', array('plugin' => 'Dane'))); ?>

<?php $this->Combinator->add_libs('js', 'toolbar'); ?>

<?= $this->Element('dataobject/pageBegin'); ?>

<?php if (empty($teksty) && $wydarzenie['s_interpelacje_tablice']['dokument_id']) { ?>
    <?php echo $this->Html->css($document->getCSSLocation()); ?>

    <div class="htmlexDoc" data-packages="<?php echo $document->getPackagesCount(); ?>"
         data-current-package="<?php echo $documentPackage; ?>"
         data-pages="<?php echo $document->getPagesCount(); ?>"
         data-document-id="<?php echo $document->getId(); ?>"
         data-dataset="<?php echo $dataset['Dataset']['alias']; ?>">

        <?= $this->Element('toolbar'); ?>

        <div class="document container">
            <div class="row">
                <div class="content col-md-10">
                    <div class="canvas">
                        <?php echo $document->loadHtml($documentPackage); ?>
                    </div>
                    <div class="loadMoreDocumentContent <?php if ($document->getPackagesCount() > 1) {
                        echo 'show';
                    } else {
                        echo 'hide';
                    } ?>"></div>
                </div>

                <? if (!empty($docs) && is_array($docs)) { ?>
                    <div class="sidebox col-md-2">
                        <ul class="categories">
                            <?php foreach ($wydarzenia as $t) { ?>
                                <li class="<?php if ($wydarzenie['s_interpelacje_tablice']['id'] == $t['s_interpelacje_tablice']['id']) { ?>s<?php } ?>">
                                    <a href="?t=<?php echo $t['s_interpelacje_tablice']['id']; ?>">
                                        <p class="nazwa"><?php echo $t['s_interpelacje_tablice']['nazwa']; ?></p>

                                        <div class="desc">
                                            <?php if ($t['s_interpelacje_tablice']['autor_str']) { ?><p>
                                                <span
                                                    class="l"><?= __d('dane', 'LC_DANE_AUTHOR') ?>:</span> <span
                                                    class="v"><?php echo $t['s_interpelacje_tablice']['autor_str']; ?></span>
                                                </p><?php } ?>
                                            <?php if ($t['s_interpelacje_tablice']['adresaci_str']) { ?><p>
                                                <span
                                                    class="l"><?= __d('dane', 'LC_DANE_ADRESAT') ?>
                                                    :</span> <span
                                                    class="v"><?php echo $t['s_interpelacje_tablice']['adresaci_str']; ?></span>
                                                </p><?php } ?>
                                            <?php if ($t['s_interpelacje_tablice']['data'] != '0000-00-00') { ?>
                                                <p>
                                                <span
                                                    class="l"><?= __d('dane', 'LC_DANE_DATA_WPLYWU') ?>:</span> <span
                                                    class="v"><?php echo $t['s_interpelacje_tablice']['data']; ?></span>
                                                </p><?php } ?>
                                            <?php if ($t['s_interpelacje_tablice']['data_ogloszenia'] != '0000-00-00') { ?>
                                                <p><span
                                                    class="l"><?= __d('dane', 'LC_DANE_DATA_OGLOSZENIA') ?>
                                                    :</span> <span
                                                    class="v"><?php echo $t['s_interpelacje_tablice']['data_ogloszenia']; ?></span>
                                                </p><?php } ?>
                                        </div>
                                    </a>
                                </li>
                            <?php } ?>
                        </ul>
                    </div>
                <? } ?>
            </div>
        </div>
    </div>
<?php } else { ?>
    <div class="htmlexDoc">
        <div class="document">
            <div class="content col-md-8">
                <?php foreach ($teksty as $t) { ?>
                    <?php if ($wydarzenie['s_interpelacje_tablice']['typ_id'] == 1 || $wydarzenie['s_interpelacje_tablice']['typ_id'] == 3) { ?>
                        <h2>
                        <?= __d('dane', 'LC_DANE_ADRESAT') ?>
                        : <?php echo $t['wypowiedzi_funkcje']['funkcja_nazwa']; ?></h2><?php } ?>
                    <div class="html">
                        <?php echo $t['s_interpelacje_sekcje_texty']['html']; ?>
                    </div>
                <?php } ?>
            </div>
            <div class="sidebox col-md-4">
                <ul class="tables">
                    <?php foreach ($wydarzenia as $t) { ?>
                        <li<?php if ($wydarzenie['s_interpelacje_tablice']['id'] == $t['s_interpelacje_tablice']['id']) { ?> class="s"<?php } ?>>
                            <a href="?t=<?php echo $t['s_interpelacje_tablice']['id']; ?>">
                                <p class="nazwa"><?php echo $t['s_interpelacje_tablice']['nazwa']; ?></p>

                                <div class="desc">
                                    <?php if ($t['s_interpelacje_tablice']['autor_str']) { ?><p><span
                                            class="l"><?= __d('dane', 'LC_DANE_AUTHOR') ?>:</span> <span
                                            class="v"><?php echo $t['s_interpelacje_tablice']['autor_str']; ?></span>
                                        </p><?php } ?>
                                    <?php if ($t['s_interpelacje_tablice']['adresaci_str']) { ?><p><span
                                            class="l"><?= __d('dane', 'LC_DANE_ADRESAT') ?>:</span> <span
                                            class="v"><?php echo $t['s_interpelacje_tablice']['adresaci_str']; ?></span>
                                        </p><?php } ?>
                                    <?php if ($t['s_interpelacje_tablice']['data'] != '0000-00-00') { ?>
                                        <p>
                                        <span
                                            class="l"><?= __d('dane', 'LC_DANE_DATA_WPLYWU') ?>:</span> <span
                                            class="v"><?php echo $t['s_interpelacje_tablice']['data']; ?></span>
                                        </p><?php } ?>
                                    <?php if ($t['s_interpelacje_tablice']['data_ogloszenia'] == '0000-00-00') { ?>
                                        <p>
                                        <span
                                            class="l"><?= __d('dane', 'LC_DANE_DATA_OGLOSZENIA') ?>
                                            :</span> <span
                                            class="v"><?php echo $t['s_interpelacje_tablice']['data_ogloszenia']; ?></span>
                                        </p><?php } ?>
                                </div>
                            </a>
                        </li>
                    <?php } ?>
                </ul>
            </div>
        </div>
    </div>
<?php } ?>


<?= $this->Element('dataobject/pageEnd'); ?>