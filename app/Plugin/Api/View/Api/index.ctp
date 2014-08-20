<?php $this->Combinator->add_libs('css', $this->Less->css('api', array('plugin' => 'Api'))) ?>
<?php $this->Combinator->add_libs('css', $this->Less->css('new-look')) ?>

<div id="api" class="newLayout">
    <div class="jumbotron">
        <div class="container">
            <h1>API</h1>

            <p>Sejm jest organem władzy ustawodawczej w Polsce. Tworzą go posłowie, którzy są reprezentantami Narodu
                dlatego
                mogą, a nawet powinni być przez ten Naród oceniani. Szerokie udostępnianie informacji o poselskich
                działaniach leży w interesie każdego z 460 posłów. Obywatele nie mający dostępu do takich danych swoje
                poglądy wyrobią w oparciu o inne, niekoniecznie obiektywne źródła informacji. Postanowiliśmy wesprzeć
                tych,
                którzy chcieliby wiedzieć jak pracują nasi posłowie i w jakich warunkach wykonują swój mandat poselski.
                Stworzyliśmy aplikację, która prezentuje rozmaite dane związane z sejmową codziennością!</p>

            <div class="searchBar col-md-12">
                <form method="GET">
                    <div class="col-md-12 searchFor">
                        <div class="input-group">
                            <input type="text" name="q" placeholder="Szukaj w API..." value=""
                                   class="form-control input-lg"
                                   autocomplete="off">
                        <span class="input-group-btn">
                            <button class="btn" type="submit"></button>
                        </span>
                        </div>
                    </div>
                </form>
            </div>

        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2>Informacje ogólne</h2>

                <div class="option col-xs-12 col-sm-6 col-md-4">
                    <h3>Opis techniczny</h3>

                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam viverra sapien sit amet lacus
                        sagittis
                        euismod. Vestibulum ac nisl ultricies, venenatis nibh at, luctus ligula.</p>
                    <a class="btn btn-primary btn-sm"
                       href="<?php echo $this->Html->url(array('action' => 'technical_info')); ?>">Więcej</a>
                </div>
            </div>
        </div>

        <hr/>

        <div class="row">
            <div class="col-md-12">
                <h2>Dostępne API</h2>

                <?php foreach ($apis as $api) { ?>
                    <div class="option col-xs-12 col-sm-6 col-md-4" data-icon="">
                        <h3>
                            <span class="icon">
                                <img src="<?php echo '/' . $api['plugin'] . '/icon/' . $api['slug'] . '.svg' ?>"
                                     alt=""/>
                            </span><?php echo $api['name'] ?>
                        </h3>

                        <p><?php echo $api['description'] ?></p>
                        <a class="btn btn-primary btn-sm"
                           href="<?php echo $this->Html->url(array('action' => 'view', 'slug' => $api['slug'])); ?>">Zobacz</a>
                    </div>
                <?php } ?>
            </div>
        </div>

        <? if (!empty($clients)) { ?>
            <hr/>

            <div class="row">
                <div class="col-md-12">
                    <h2>Klienci API</h2>
                </div>
            </div>
        <? } ?>

    </div>
</div>