<?php $this->Combinator->add_libs('css', $this->Less->css('dataobject', array('plugin' => 'Dane'))) ?>
<?php $this->Combinator->add_libs('css', $this->Less->css('dataobjectslider', array('plugin' => 'Dane'))) ?>
<?php $this->Combinator->add_libs('css', $this->Less->css('sejmometr', array('plugin' => 'Sejmometr'))) ?>
<?php $this->Combinator->add_libs('css', $this->Less->css('new-look')) ?>

<?php $this->Combinator->add_libs('js', '../plugins/highcharts/js/highcharts'); ?>
<?php $this->Combinator->add_libs('js', '../plugins/highcharts/locals'); ?>

<?php $this->Combinator->add_libs('js', 'Sejmometr.sejmometr.js'); ?>

<?php echo $this->Html->script('../plugins/TimelineJS/build/js/storyjs-embed.js', array('block' => 'scriptBlock')); ?>

<div id="sejmometr" class="newLayout">

<div class="headline strip">
    <div class="container">
        <h1 class="header text-center">Sejmometr</h1>

        <div class="content-container col-xs-12">
            <h5>Sejm jest organem władzy ustawodawczej w Polsce. Tworzą
                go posłowie, którzy są
                reprezentantami Narodu dlatego mogą, a nawet powinni być przez ten Naród oceniani. Szerokie
                udostępnianie informacji o poselskich działaniach leży w interesie każdego z 460 posłów. Obywatele
                nie
                mający dostępu do takich danych swoje poglądy wyrobią w oparciu o inne, niekoniecznie obiektywne
                źródła
                informacji. Postanowiliśmy wesprzeć tych, którzy chcieliby wiedzieć jak pracują nasi posłowie i w
                jakich
                warunkach wykonują swój mandat poselski. Stworzyliśmy aplikację, która prezentuje rozmaite dane
                związane
                z sejmową codziennością!
            </h5>

            <div class="searchInput search col-xs-12 col-md-10 col-md-offset-1">
            <form action="/sejmometr/szukaj">
                    <div class="input-group">
                        <input name="q" value="" type="text" autocomplete="off"
                               placeholder="Szukaj w pracach Sejmu..."
                               class="form-control input-lg">
	                <span class="input-group-btn">
	                      <button class="btn btn-success btn-lg button big" type="submit" data-icon="&#xe600;"></button>
	                </span>
                    </div>
                </form>
            </div>

            <div class="shortcut submenu">
                <ul>
                <li class="active">
                        <a href="/sejmometr">Sejmometr</a>
                    </li>
                    <li>
                        <a href="/dane/legislacja_projekty_ustaw">Projekty ustaw</a>
                    </li>
                    <li>
                        <a href="/dane/sejm_druki">Druki sejmowe</a>
                    </li>
                    <li>
                        <a href="/dane/poslowie" target="_self">Posłowie</a>
                    </li>
                    <li>
                        <a href="/dane/sejm_kluby" target="_self">Kluby parlamentarne</a>
                    </li>
                    <li>
                        <a href="/dane/sejm_interpelacje" target="_self">Interpelacje</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>

<?php /* BEGIN TIMELINE strip li */ ?>
<div class="timeline strip">
    <div class="container">
        <div class="head col-xs-12">
            <h2>Posiedzenia <strong>Sejmu</strong></h2>
        </div>
    </div>
</div>

<div id="timeline-embed" data-source="1"></div>
<?php /* END TIMELINE strip */ ?>

<div class="poslowie strip">
    <div class="container">
        <div class="head col-xs-12">
            <h2>Aktualni <strong>Posłowie</strong></h2>

            <div class="pull-right">
                <button type="button" class="btn btn-default">Lista alfabetyczna</button>
                <button type="button" class="btn btn-link">Według okręgów mandatowych</button>
            </div>
            <div class="pull-left">
                <p>Kliknij na nazwisko posła, aby pokazać jego szczegółowe dane.</p>
            </div>
        </div>
        <div class="content-container col-xs-12">
            <ul>
                <li class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
                    <a href="http://mojepanstwo.pl/dane/poslowie/1">Abramowicz Adam<img
                            src="http://resources.sejmometr.pl/s_kluby/2_a_t.png" alt="Prawo i Sprawiedliwość"></a>
                </li>
                <li class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
                    <a href="http://mojepanstwo.pl/dane/poslowie/1">Abramowicz Adam<img
                            src="http://resources.sejmometr.pl/s_kluby/2_a_t.png" alt="Prawo i Sprawiedliwość"></a>
                </li>
                <li class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
                    <a href="http://mojepanstwo.pl/dane/poslowie/1">Abramowicz Adam<img
                            src="http://resources.sejmometr.pl/s_kluby/2_a_t.png" alt="Prawo i Sprawiedliwość"></a>
                </li>
                <li class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
                    <a href="http://mojepanstwo.pl/dane/poslowie/1">Abramowicz Adam<img
                            src="http://resources.sejmometr.pl/s_kluby/2_a_t.png" alt="Prawo i Sprawiedliwość"></a>
                </li>

                <li class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
                    <a href="http://mojepanstwo.pl/dane/poslowie/1">Abramowicz Adam<img
                            src="http://resources.sejmometr.pl/s_kluby/2_a_t.png" alt="Prawo i Sprawiedliwość"></a>
                </li>
                <li class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
                    <a href="http://mojepanstwo.pl/dane/poslowie/1">Abramowicz Adam<img
                            src="http://resources.sejmometr.pl/s_kluby/2_a_t.png" alt="Prawo i Sprawiedliwość"></a>
                </li>
                <li class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
                    <a href="http://mojepanstwo.pl/dane/poslowie/1">Abramowicz Adam<img
                            src="http://resources.sejmometr.pl/s_kluby/2_a_t.png" alt="Prawo i Sprawiedliwość"></a>
                </li>
                <li class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
                    <a href="http://mojepanstwo.pl/dane/poslowie/1">Abramowicz Adam<img
                            src="http://resources.sejmometr.pl/s_kluby/2_a_t.png" alt="Prawo i Sprawiedliwość"></a>
                </li>
            </ul>
            <div class="getMore text-center">
                <a class="btn btn-primary btn-lg" href="http://mojepanstwo.pl/dane/poslowie"
                   target="_self">Pokaż całą listę</a>
            </div>
        </div>
    </div>
</div>

<div class="raportWydatki strip">
    <div class="container">
        <div class="col-xs-12">
            <div class="liczba">113 209 340
                <small>PLN</small>
            </div>
            <div class="infoLine">
                Tyle kosztowały wydatki związane z pracą posłów w 2013 roku
            </div>
            <div class="checkIt">
                <a class="btn btn-primary btn-lg" href="#" onclick="return false;">Zobacz historię wydatków
                    <small>(już wkrótce)</small>
                </a>
            </div>
        </div>
    </div>
</div>

<div class="detailPoslowie strip">
    <div class="container">
        <div class="head col-xs-12">
            <h2><strong>Zobacz dane dotyczące aktywności posłow</strong></h2>
        </div>
        <div class="sideMenu col-xs-12 col-sm-4 col-md-2">
            <ul>
                <li class="active">
                    <a href="#wystapienia">Wystąpienia</a>
                </li>
                <li>
                    <a href="#frekwencja">Frekwencja</a>
                </li>
                <li>
                    <a href="#bunty">Bunty</a>
                </li>
            </ul>
        </div>
        <div class="content-container col-xs-12 col-sm-8 col-md-10">
            <?php
            /* WYSTAPAPIENIA BLOCK */
            $items = array();
            /*TEMP VARIABLE*/
            for ($i = 1; $i <= 15; $i++) {
                array_push($items, array('posel_id' => '1', 'posel_name' => 'Abramowicz Adam', 'posel_img' => 'http://resources.sejmometr.pl/mowcy/a/0/1.jpg', 'icon_src' => 'http://resources.sejmometr.pl/s_kluby/2_a_t.png', 'icon_name' => 'Prawo i Sprawiedliwość', 'number' => 192));
            }

            $page = array(
                'class' => 'wystapienia',
                'title' => 'Wystąpienia',
                'text' => 'Posłowie w ramach sprawowania mandatu wypowiadają się na posiedzeniach Sejmu. Zobacz, którzy z nich są najbardziej aktywni',
                'link' => '#rankingLink'
            );

            echo $this->element('Sejmometr.list', array('page' => $page, 'items' => $items));
            /* WYSTAPAPIENIA END BLOCK */
            ?>


            <?php
            /* FREKWENCJA BLOCK */
            $items = array();
            /*TEMP VARIABLE*/
            for ($i = 1; $i <= 15; $i++) {
                array_push($items, array('posel_id' => '1', 'posel_name' => 'Abramowicz Adam', 'posel_img' => 'http://resources.sejmometr.pl/mowcy/a/0/1.jpg', 'icon_src' => 'http://resources.sejmometr.pl/s_kluby/2_a_t.png', 'icon_name' => 'Prawo i Sprawiedliwość', 'number' => 192));
            }

            $page = array(
                'class' => 'frekwencja',
                'title' => 'Frekwencja',
                'text' => 'Poseł musi być obecny na posiedzeniach Sejmu i powinien czynnie w nich uczestniczyć. To poselski obowiązek, którego zaniedbanie powoduje konsekwencje finansowe. Jeżeli poseł ma nieusprawiedliwione nieobecności Marszałek Sejmu zarządza obniżenie uposażenia i diety parlamentarnej albo jednego z tych świadczeń, jeżeli tylko ono przysługuje posłowi. Poseł ze swoich świadczeń traci 1/30 za każdy dzień nieusprawiedliwionej nieobecności na posiedzeniu Sejmu lub za niewzięcie w danym dniu udziału w więcej niż 1/5 głosowań. Sprawdź, który z posłów najcześciej omija sejmowe posiedzenia.',
                'link' => '#rankingLink'
            );

            echo $this->element('Sejmometr.list', array('page' => $page, 'items' => $items));
            /* FREKWENCJA END BLOCK */
            ?>

            <?php
            /* BUNTY BLOCK */
            $items = array();
            /*TEMP VARIABLE*/
            for ($i = 1; $i <= 15; $i++) {
                array_push($items, array('posel_id' => '1', 'posel_name' => 'Abramowicz Adam', 'posel_img' => 'http://resources.sejmometr.pl/mowcy/a/0/1.jpg', 'icon_src' => 'http://resources.sejmometr.pl/s_kluby/2_a_t.png', 'icon_name' => 'Prawo i Sprawiedliwość', 'number' => 192));
            }

            $page = array(
                'class' => 'bunty',
                'title' => 'Bunty',
                'text' => 'Poprzez "bunty" określamy sytuacje polegające na tym, że poseł głosuje przeciwnie niż większość klubu parlamentarnego, do którego należy. Partie zabezpieczają się przed buntami stosując dyscyplinę głosowania. Narzucają tym samym sposób w jaki dany poseł ma zagłosować. Za naruszenie dyscypliny grozi nawet kara finansowa. Powstaje pytanie jak narzędzie dyscypliny głosowania ma się do konstytucyjnego zapisu o tym, że posłowie są przedstawicielami Narodu. W momencie gdy poseł oddaje swój głos zgodnie z wytycznymi partyjnego lidera jest przedstawicielami partii, a nie Narodu. Wydaje się, że dyscyplina poselska nie wpływa korzystnie na interesy obywateli. W sytuacji jej zastosowania na decyzję posła podczas głosowania mają wpływ nie merytoryczne rozważania, ale obawy przed sankcjami, które może wymierzyć partia. W naszym zestawieniu prezentujemy największych buntowników w Sejmie, którzy głosują inaczej niż większość ich klubu parlamentarnego.',
                'link' => '#rankingLink'
            );

            echo $this->element('Sejmometr.list', array('page' => $page, 'items' => $items));
            /* BUNTY END BLOCK */
            ?>

            <?php
            /* INTERPELACJE BLOCK */
            $items = array();
            /*TEMP VARIABLE*/
            for ($i = 1; $i <= 15; $i++) {
                array_push($items, array('posel_id' => '1', 'posel_name' => 'Abramowicz Adam', 'posel_img' => 'http://resources.sejmometr.pl/mowcy/a/0/1.jpg', 'icon_src' => 'http://resources.sejmometr.pl/s_kluby/2_a_t.png', 'icon_name' => 'Prawo i Sprawiedliwość', 'number' => 192));
            }

            $page = array(
                'class' => 'interpelacje',
                'title' => 'Interpelacje',
                'text' => 'Składanie interpelacji jest jednym z poselskich uprawnień. Każdy z posłów może zapytać Prezesa Rady Ministrów lub konkretnego ministra o sprawę, która dotyczy polityki państwa. Członkowie Rady Ministrów muszą udzielić posłowi odpowiedzi nie później niż w ciągu 21 dni od otrzymania interpelacji. Zobacz, który z posłów najczęściej zadaje pytania!',
                'link' => '#rankingLink'
            );

            echo $this->element('Sejmometr.list', array('page' => $page, 'items' => $items));
            /* INTERPELACJE END BLOCK */
            ?>

            <?php
            /* KIM SA Z ZAWODU BLOCK */
            $items = array(
                array('percent' => 65, 'job' => 'Prawnicy', 'more_link' => '#'),
                array('percent' => 15, 'job' => 'Nauczyciele', 'more_link' => '#'),
                array('percent' => 15, 'job' => 'Przedsiębiorcy', 'more_link' => '#'),
                array('percent' => 15, 'job' => 'Przedsiębiorcy', 'more_link' => '#'),
                array('percent' => 15, 'job' => 'Inne', 'more_link' => '#')
            );

            $page = array(
                'class' => 'zawod',
                'title' => 'Kim posłowie są z zawodu?',
                'text' => 'Wśród parlamentarzystów pojawia się wiele różnych profesji. Nie ma jednak jednolitych zasad jeśli chodzi o wskazywanie przez posłów swoich zawodów. Niektórzy z posłów jako swój zawód podają ten, który wynika z ich wykształcenia, inni natomiast zawód ostatnio wykonywany. Część posłów wskazuje, że są posłami zawodowymi czyli takimi, którzy poza wykonywaniem mandatu parlamentarnego nie pracują, ani nie prowadzą działalności gospodarczej. W naszym zestawieniu przedstawiamy czym najczęściej zawodowo zajmują się posłowie.',
                'link' => '#rankingLink'
            );

            echo $this->element('Sejmometr.graph_percent', array('page' => $page, 'items' => $items));
            /* KIM SA Z ZAWODU */
            ?>

            <?php
            /* ETYKA POSELSKA BLOCK */
            $items = array();
            /*TEMP VARIABLE*/
            for ($i = 1; $i <= 15; $i++) {
                array_push($items, array('posel_id' => '1', 'posel_name' => 'Abramowicz Adam', 'posel_img' => 'http://resources.sejmometr.pl/mowcy/a/0/1.jpg', 'icon_src' => 'http://resources.sejmometr.pl/s_kluby/2_a_t.png', 'icon_name' => 'Prawo i Sprawiedliwość', 'number' => 192));
            }

            $page = array(
                'class' => 'etyka_poselska',
                'title' => 'Etyka poselska',
                'text' => 'Kwestiami związanymi z etyką parlamentarzystów zajmuje się Komisja Etyki Poselskiej. Zadaniem komisji jest m. in. rozpatrywanie spraw posłów, którzy zachowują się w sposób nieodpowiadający poselskiej godności. Zobacz czyje zachowanie najczęściej było przedmiotem uchwał Komisji Etyki Poselskiej.',
                'link' => '#rankingLink'
            );

            echo $this->element('Sejmometr.list', array('page' => $page, 'items' => $items));
            /* TYKA POSELSKA END BLOCK */
            ?>

            <?php
            /* POSLANKI POSLOWIE BLOCK */
            $items = array(
                array('title' => 'Sejm RP', 'img_src' => 'http://resources.sejmometr.pl/s_kluby/2_a_t.png', 'setup' => array(array('Mężczyźni', 65), array('Kobiety', 35))),
                array('title' => 'Platforma Obywatelska', 'img_src' => 'http://resources.sejmometr.pl/s_kluby/2_a_t.png', 'setup' => array(array('Mężczyźni', 65), array('Kobiety', 35))),
                array('title' => 'Prawo i Sprawiedliwość', 'img_src' => 'http://resources.sejmometr.pl/s_kluby/2_a_t.png', 'setup' => array(array('Mężczyźni', 65), array('Kobiety', 35))),
                array('title' => 'Twój Ruch', 'img_src' => 'http://resources.sejmometr.pl/s_kluby/2_a_t.png', 'setup' => array(array('Mężczyźni', 65), array('Kobiety', 35))),
                array('title' => 'Polskie Stronnictwo Ludowe', 'img_src' => 'http://resources.sejmometr.pl/s_kluby/2_a_t.png', 'setup' => array(array('Mężczyźni', 65), array('Kobiety', 35)))
            );

            $page = array(
                'class' => 'poslankiPoslowie',
                'title' => 'Posłanki i posłowie',
                'text' => 'Ilość kobiet i mężczyzn w Sejmie i w poszczególnych partiach',
                'link' => '#rankingLink'
            );

            echo $this->element('Sejmometr.graph_circle', array('page' => $page, 'items' => $items));
            /* POSLANKI POSLOWIE END BLOCK */
            ?>
        </div>
    </div>
</div>