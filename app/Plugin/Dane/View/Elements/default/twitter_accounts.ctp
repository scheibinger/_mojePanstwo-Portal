<?

$number_format = array(
    'places' => 0,
    'before' => '',
    'escape' => false,
    'decimals' => '.',
    'thousands' => ' '
);

?>

<p class="line signature text-muted">
    <?= $object->getData('description'); ?>
</p>

</div>
</div>


<div>

    <?

    $a2013 = array(
        'liczba_retweetow_wlasnych_2013',
        'liczba_tweetow_wlasnych_2013',
        'liczba_wzmianek_rts_2013',
        'liczba_odpowiedzi_rts_2013'
    );
    $ord = @substr($this->request->query['order'], 0, stripos($this->request->query['order'], ' '));


    if (in_array($ord, $a2013)) {
        ?>


        <div class="row indicators">
            <div class="col-lg-2 indicator">
                <p class="value"><?= $this->Number->format($object->getData('liczba_tweetow_wlasnych_2013'), $number_format) ?></p>

                <p class="label">Liczba tweetów własnych w 2013 r.</p>
            </div>
            <div class="col-lg-2 indicator">
                <p class="value"><?= $this->Number->format($object->getData('liczba_retweetow_wlasnych_2013'), $number_format) ?></p>

                <p class="label">Liczba retweetów w 2013 r.</p>
            </div>
            <div class="col-lg-2 indicator">
                <p class="value"><?= $this->Number->format($object->getData('liczba_wzmianek_rts_2013'), $number_format) ?></p>

                <p class="label">Liczba wzmianek w 2013 r. (+&nbsp;retweety)</p>
            </div>
            <div class="col-lg-2 indicator">
                <p class="value"><?= $this->Number->format($object->getData('liczba_odpowiedzi_rts_2013'), $number_format) ?></p>

                <p class="label">Liczba odpowiedzi w 2013 r. (+&nbsp;retweety)</p>
            </div>
            <div class="col-lg-2 indicator">
                <p class="value"><?= $this->Number->format($object->getData('liczba_obserwujacych'), $number_format) ?></p>

                <p class="label">Liczba obserwujących</p>
            </div>


        </div>

    <?
    } else {
        ?>

        <div class="row indicators">
            <div class="col-lg-2 indicator">
                <p class="value"><?= $this->Number->format($object->getData('liczba_tweetow'), $number_format) ?></p>

                <p class="label">Liczba tweetów</p>
            </div>
            <div class="col-lg-2 indicator">
                <p class="value"><?= $this->Number->format($object->getData('liczba_retweetow_wlasnych'), $number_format) ?></p>

                <p class="label">Liczba retweetów</p>
            </div>
            <div class="col-lg-2 indicator">
                <p class="value"><?= $this->Number->format($object->getData('liczba_wzmianek_rts'), $number_format) ?></p>

                <p class="label">Liczba wzmianek (+&nbsp;retweety)</p>
            </div>
            <div class="col-lg-2 indicator">
                <p class="value"><?= $this->Number->format($object->getData('liczba_odpowiedzi_rts'), $number_format) ?></p>

                <p class="label">Liczba odpowiedzi (+&nbsp;retweety)</p>
            </div>
            <div class="col-lg-2 indicator">
                <p class="value"><?= $this->Number->format($object->getData('liczba_obserwujacych'), $number_format) ?></p>

                <p class="label">Liczba obserwujących</p>
            </div>

        </div>
    <?
    }
    ?>

    <div>
