<?php $this->Combinator->add_libs('css', $this->Less->css('dataobject', array('plugin' => 'Dane'))) ?>
<?php $this->Combinator->add_libs('css', $this->Less->css('dataobjectslider', array('plugin' => 'Dane'))) ?>
<?php $this->Combinator->add_libs('css', $this->Less->css('sejmometr', array('plugin' => 'Sejmometr'))) ?>
<?php $this->Combinator->add_libs('css', $this->Less->css('new-look')) ?>

<?php $this->Combinator->add_libs('js', '../plugins/highcharts/js/highcharts'); ?>
<?php $this->Combinator->add_libs('js', '../plugins/highcharts/locals'); ?>

<?php $this->Combinator->add_libs('js', 'Sejmometr.sejmometr.js'); ?>
<?php echo $this->Html->script('../plugins/TimelineJS/build/js/storyjs-embed.js', array('block' => 'scriptBlock')); ?>

<div id="sejmometr" class="newLayout">

    <div class="headline block">
        <div class="container">
            <h1 class="header text-center">Sejmometr</h1>

            <h5 class="col-xs-11 col-md-10 col-md-offset-1">Sejm jest organem władzy ustawodawczej w Polsce. Tworzą
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

            <div class="searchInput search col-xs-12">
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
                <ul class="col-xs-12">
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

    <div class="mpanel block">
        <div class="container">
            <div class="col-xs-12">
                <h2>Posiedzenia <strong>Sejmu</strong></h2>
            </div>
        </div>
    </div>

    <div id="timeline-embed" data-source="1"></div>

    <div class="mpanel">

    </div>

</div>