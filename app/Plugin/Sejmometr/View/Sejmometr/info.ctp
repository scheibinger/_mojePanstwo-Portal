<?php $this->Combinator->add_libs('css', $this->Less->css('inner-story', array('plugin' => 'Sejmometr'))); ?>
<?php $this->Combinator->add_libs('js', 'Sejmometr.inner-story-libs.js'); ?>
<?php $this->Combinator->add_libs('js', 'Sejmometr.inner-story.js'); ?>

<div id="storyLine">
    <div class="innerStory">
        <div class="far">
            <div class="clouds"></div>
        </div>
        <div class="medium">
            <div class="scene intro" data-scene="1">
                <div class="title">
                    <h3>Środki finansowe ogółem do rozliczenia</h3>

                    <h2>1 209 340
                        <small>PLN</small>
                    </h2>
                </div>
                <div class="infoIcon biuro">Wydatki na biuro poselskie</div>
                <div class="scrollHint"></div>
            </div>
            <div class="scene sejm" data-scene="2">
                <div class="stat posel zarobki">
                    <p>Zarobki posła</p>
                    <strong>209 304
                        <small>PLN/rok</small>
                    </strong>
                    <span>wydatki na posła</span>
                </div>
                <div class="stat posel przejazd">
                    <p>Przejazd posła<br>samochodem własnym lub innym</p>
                    <strong>209 304
                        <small>PLN/rok</small>
                    </strong>
                    <span>wydatki na biuro poselskie</span>
                </div>
            </div>
            <div class="scene biuro" data-scene="3"></div>
            <div class="scene szpital" data-scene="4"></div>
            <div class="scene bank" data-scene="5"></div>
            <div class="scene spotkanie" data-scene="6"></div>
            <div class="scene tlumaczenia" data-scene="7"></div>
            <div class="scene dom" data-scene="8"></div>
            <div class="scene droga" data-scene="9"></div>
            <div class="scene lotnisko" data-scene="10"></div>
            <div class="scene lot" data-scene="11"></div>
            <div class="scene stats" data-scene="12"></div>
        </div>
        <div class="near">
            <div class="posel"></div>
            <div class="samochod"></div>
            <div class="taxi"></div>
            <div class="samolot"></div>
        </div>
    </div>
</div>