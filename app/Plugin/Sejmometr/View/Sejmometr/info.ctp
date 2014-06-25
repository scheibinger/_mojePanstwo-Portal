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
        <div class="infoIcon icon big biuro">Wydatki na biuro poselskie</div>
        <div class="scrollHint"></div>
    </div>
    <div class="scene sejm" data-scene="2">
        <div class="building"></div>
        <div class="stat zarobki">
            <p>Uposażenie poselskie</p>
            <strong>9 304
                <small>PLN/miesiąc</small>
            </strong>

            <div class="icon posel">wydatki na posła - stan na 31.12.2013</div>
        </div>
        <div class="stat przejazd">
            <p>Przejazd posła<br>samochodem własnym lub innym</p>
            <strong>209 304
                <small>PLN/rok</small>
            </strong>

            <div class="icon biuro">wydatki na biuro poselskie</div>
        </div>
    </div>
    <div class="scene biuro" data-scene="3">
        <div class="stat biura">
            <p>Koszty wynajmu lokalu<br>na biura poselskie</p>
            <strong>209 304
                <small>PLN/rok</small>
            </strong>

            <div class="icon biuro">wydatki na biuro poselskie</div>
        </div>
    </div>
    <div class="scene szpital" data-scene="4">
        <div class="stat korespondencja">
            <p>Korespondencja i ogłoszenia</p>
            <strong>209 304
                <small>PLN/rok</small>
            </strong>

            <div class="icon biuro">wydatki na biuro poselskie</div>
        </div>
        <div class="stat badania">
            <p>Badanie lekarskie<br>i szkolenia pracowników</p>
            <strong>209 304
                <small>PLN/rok</small>
            </strong>

            <div class="icon biuro">wydatki na biuro poselskie</div>
        </div>
    </div>
    <div class="scene bank" data-scene="5">
        <div class="stat rachunki">
            <p>Obsługa rachunkowo-księgowa<br>i bankowa biura poselskiego</p>
            <strong>209 304
                <small>PLN/rok</small>
            </strong>

            <div class="icon biuro">wydatki na biuro poselskie</div>
        </div>
    </div>
    <div class="scene spotkanie" data-scene="6">
        <div class="name">Spotkanie z posłem<br/>imię i nazwisko</div>
        <div class="stat sala">
            <p>Koszty wynajmowania sal<br>na spotkanie z wyborcami</p>
            <strong>209 304
                <small>PLN/rok</small>
            </strong>

            <div class="icon biuro">wydatki na biuro poselskie</div>
        </div>
    </div>
    <div class="scene tlumaczenia" data-scene="7">
        <div class="stat ekspertyzy">
            <p>Ekspertyzy, opinie, tłumaczenia</p>
            <strong>209 304
                <small>PLN/rok</small>
            </strong>

            <div class="icon biuro">wydatki na biuro poselskie</div>
        </div>
    </div>
    <div class="scene dom" data-scene="8">
        <div class="stat prywatny">
            <p>Koszty wynajmu kwatery prywatnej</p>
            <strong>209 304
                <small>PLN/rok</small>
            </strong>

            <div class="icon posel">wydatki na posła</div>
        </div>
        <div class="stat dom">
            <p>Koszty najmu kwatery<br>w Domu poselskim</p>
            <strong>209 304
                <small>PLN/rok</small>
            </strong>

            <div class="icon posel">wydatki na posła</div>
        </div>
    </div>
    <div class="scene droga" data-scene="9">
        <div class="stat taksowka">
            <p>Przejazdy posła teksówkami</p>
            <strong>209 304
                <small>PLN/rok</small>
            </strong>

            <div class="icon biuro">wydatki na biuro poselskie</div>
        </div>
    </div>
    <div class="scene lotnisko" data-scene="10">
        <div class="building"></div>
        <div class="stat loty">
            <p>Podróże służbowe pracowników<br>biura poselskiego</p>
            <strong>209 304
                <small>PLN/rok</small>
            </strong>

            <div class="icon posel">wydatki na posła</div>
        </div>
    </div>
    <div class="scene lot" data-scene="11"></div>
    <div class="scene stats" data-scene="12">
        <div class="screen">
            <div class="container">
                <div class="col-xs-12">
                    <div class="moneyLeft">
                        <div class="title">
                            <h3>Pozostało</h3>

                            <h2>1 209 340
                                <small>PLN</small>
                            </h2>
                        </div>
                        <div class="infoIcon icon big biuro">Wydatki na biuro poselskie</div>
                        <div class="moreLinks">
                            <div class="button icon big biuro col-xs-12 col-md-5 pull-left">
                                <a href="#">Zobacz listę wszystkich wydatków na biuro poselskie</a>
                            </div>
                            <div class="button icon big posel col-xs-12 col-md-5 pull-right">
                                <a href="#">Zobacz listę wszystkich wydatków na posła</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="screen">
            <div class="container">
                <div class="col-xs-12">
                    <div class="list">
                        <h3>Lista wszystkich wydatków</h3>

                        <ul class="col-xs-12">
                            <li class="col-xs-12 col-md-6">
                                <div class="txt">Wynagrodzenie pracowników biura poselskiego</div>
                                <div class="cost">1 230 576 PLN/rok</div>
                            </li>
                            <li class="col-xs-12 col-md-6">
                                <div class="txt">Wynagrodzenie pracowników biura poselskiego</div>
                                <div class="cost">1 230 576 PLN/rok</div>
                            </li>
                            <li class="col-xs-12 col-md-6">
                                <div class="txt">Wynagrodzenie pracowników biura poselskiego</div>
                                <div class="cost">1 230 576 PLN/rok</div>
                            </li>
                            <li class="col-xs-12 col-md-6">
                                <div class="txt">Wynagrodzenie pracowników biura poselskiego</div>
                                <div class="cost">1 230 576 PLN/rok</div>
                            </li>
                            <li class="col-xs-12 col-md-6">
                                <div class="txt">Wynagrodzenie pracowników biura poselskiego</div>
                                <div class="cost">1 230 576 PLN/rok</div>
                            </li>
                            <li class="col-xs-12 col-md-6">
                                <div class="txt">Wynagrodzenie pracowników biura poselskiego</div>
                                <div class="cost">1 230 576 PLN/rok</div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="near">
    <div class="posel"></div>
    <div class="samochod"></div>
    <div class="taxi"></div>
    <div class="samolot"></div>
</div>
</div>
</div>