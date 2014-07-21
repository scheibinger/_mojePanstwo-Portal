<h1>Kim posłowie są z zawodu?</h1>

<p>
    Wśród parlamentarzystów pojawia się wiele różnych profesji.
    Nie ma jednak jednolitych zasad jeśli chodzi o wskazywanie przez posłów swoich zawodów.
    Niektórzy z posłów jako swój zawód podają ten, który wynika z ich wykształcenia, inni natomiast zawód ostatnio
    wykonywany.
    Część posłów wskazuje, że są posłami zawodowymi czyli takimi, którzy poza wykonywaniem mandatu parlamentarnego nie
    pracują, ani nie prowadzą działalności gospodarczej.
    W naszym zestawieniu przedstawiamy czym najczęściej zawodowo zajmują się posłowie.
</p>

<script type="text/javascript">
    zawody = <?= json_encode($zawody_chart) ?>;
</script>

<div id="piechart">!TODO PIECHART!</div>

<div id="table" class="container">
    <? foreach ($zawody as $z) { ?>
        <div class="row">
            <div class="col-xs-6">
                <div class="percent"><?= $z['percent'] ?></div>
                <div class="percent"><?= $z['number'] ?></div>
            </div>
            <div class="col-xs-6">
                <?= $z['name'] ?>
            </div>
        </div>
    <? } ?>
</div>

<a href="<?= Router::url(array('action' => 'index')) ?>" class="btn btn-default">Wróć na główną stronę Sejmometru</a>