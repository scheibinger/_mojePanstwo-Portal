<?php $this->Combinator->add_libs('css', $this->Less->css('new-look')) ?>
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
                <div class="building"></div>
                <div class="stat posel zarobki">
                    <p>Zarobki posła</p>
                    <strong>209 304
                        <small>PLN/rok</small>
                    </strong>
                    <span>wydatki na posła</span>
                </div>
                <div class="stat biuro przejazd">
                <p>Przejazd posła<br>samochodem własnym lub innym</p>
                    <strong>209 304
                        <small>PLN/rok</small>
                    </strong>
                    <span>wydatki na biuro poselskie</span>
                </div>
            </div>
            <div class="scene biuro" data-scene="3">
                <div class="stat biuro biura">
                    <p>Koszty wynajmu lokalu<br>na biura poselskie</p>
                    <strong>209 304
                        <small>PLN/rok</small>
                    </strong>
                    <span>wydatki na biuro poselskie</span>
                </div>
            </div>
            <div class="scene szpital" data-scene="4">
                <div class="stat biuro korespondencja">
                    <p>Korespondencja i ogłoszenia</p>
                    <strong>209 304
                        <small>PLN/rok</small>
                    </strong>
                    <span>wydatki na biuro poselskie</span>
                </div>
                <div class="stat biuro badania">
                    <p>Badanie lekarskie<br>i szkolenia pracowników</p>
                    <strong>209 304
                        <small>PLN/rok</small>
                    </strong>
                    <span>wydatki na biuro poselskie</span>
                </div>
            </div>
            <div class="scene bank" data-scene="5">
                <div class="stat biuro rachunki">
                    <p>Obsługa rachunkowo-księgowa<br>i bankowa biura poselskiego</p>
                    <strong>209 304
                        <small>PLN/rok</small>
                    </strong>
                    <span>wydatki na biuro poselskie</span>
                </div>
            </div>
            <div class="scene spotkanie" data-scene="6">
                <div class="name">Spotkanie z posłem<br/>imię i nazwisko</div>
                <div class="stat biuro sala">
                    <p>Koszty wynajmowania sal<br>na spotkanie z wyborcami</p>
                    <strong>209 304
                        <small>PLN/rok</small>
                    </strong>
                    <span>wydatki na biuro poselskie</span>
                </div>
            </div>
            <div class="scene tlumaczenia" data-scene="7">
                <div class="stat biuro ekspertyzy">
                    <p>Ekspertyzy, opinie, tłumaczenia</p>
                    <strong>209 304
                        <small>PLN/rok</small>
                    </strong>
                    <span>wydatki na biuro poselskie</span>
                </div>
            </div>
            <div class="scene dom" data-scene="8">
                <div class="stat biuro prywatny">
                    <p>Koszty wynajmu kwatery prywatnej</p>
                    <strong>209 304
                        <small>PLN/rok</small>
                    </strong>
                    <span>wydatki na biuro poselskie</span>
                </div>
                <div class="stat biuro dom">
                    <p>Koszty najmu kwatery<br>w Domu poselskim</p>
                    <strong>209 304
                        <small>PLN/rok</small>
                    </strong>
                    <span>wydatki na biuro poselskie</span>
                </div>
            </div>
            <div class="scene droga" data-scene="9">
                <div class="stat biuro taksowka">
                    <p>Przejazdy posła teksówkami</p>
                    <strong>209 304
                        <small>PLN/rok</small>
                    </strong>
                    <span>wydatki na biuro poselskie</span>
                </div>
            </div>
            <div class="scene lotnisko" data-scene="10">
                <div class="building"></div>
                <div class="stat posel loty">
                    <p>Podróże służbowe pracowników<br>biura poselskiego</p>
                    <strong>209 304
                        <small>PLN/rok</small>
                    </strong>
                    <span>wydatki na posła</span>
                </div>
            </div>
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