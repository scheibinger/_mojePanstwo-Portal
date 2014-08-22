<?
echo $this->Combinator->add_libs('css', $this->Less->css('view-gminy', array('plugin' => 'Dane')));
if ($object->getId() == '903') $this->Combinator->add_libs('css', $this->Less->css('view-gminy-krakow', array('plugin' => 'Dane')));

$this->Combinator->add_libs('css', $this->Less->css('view-radygmindebaty', array('plugin' => 'Dane')));
$this->Combinator->add_libs('js', 'Dane.view-radygmindebaty');

echo $this->Element('dataobject/pageBegin', array(
    'titleTag' => 'p',
));

echo $this->Element('Dane.dataobject/subobject', array(
    'menu' => isset($_submenu) ? $_submenu : false,
    'object' => $debata,
    'objectOptions' => array(
        'hlFields' => array('rady_gmin_posiedzenia.numer', 'numer_punktu'),
        'bigTitle' => true,
    ),
));
?>

    <div class="col-md-12">
        <div class="object mpanel">
            <div class="col-md-7">
                <div id="ytVideo">
                    <div id="player" data-youtube="<?php echo $debata->getData('yt_video_id'); ?>"></div>
                </div>
            </div>
            <div class="col-md-5 wystapienia">

                <div class="block">

                    <div class="block-header">
                        <h2 class="label"><?php echo __d('dane', 'LC_RADYGMINDEBATY_WYSTAPIENIA'); ?></h2>
                    </div>

                    <div class="content">
                        <ul class="nav nav-pills nav-stacked">
                            <?php foreach ($wystapienia as $id => $wystapienie) { ?>
                                <li>
                                    <a data-video-position="<?php echo $wystapienie['video_start']; ?>"
                                       href="#<?php echo $id; ?>">
                                        <span><?php echo (date('H', $wystapienie['video_start']) - 1) . date(':i:s', $wystapienie['video_start']); ?></span> <?php echo $wystapienie['mowca_str']; ?>
                                    </a>
                                </li>
                            <?php } ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?
echo $this->Element('dataobject/pageEnd');
?>