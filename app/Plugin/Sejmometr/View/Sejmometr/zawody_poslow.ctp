<h1>Kim posłowie są z zawodu?</h1>

<script type="text/javascript">
    zawody = <?= json_encode($zawody_chart) ?>;
</script>

<div id="piechart">!TODO PIECHART!</div>

<div id="table" class="container">
    <? foreach($zawody as $z) { ?>
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