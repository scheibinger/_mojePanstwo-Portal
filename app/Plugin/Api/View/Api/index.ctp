<h1>API</h1>

<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam viverra sapien sit amet lacus sagittis euismod. Vestibulum ac nisl ultricies, venenatis nibh at, luctus ligula. Curabitur facilisis sem arcu, tempus auctor risus pharetra in. </p>


<form method="get">
    <div class="input-group">
        <input name="q" class="form-control input-lg" placeholder="Szukaj w API.." autocomplete="off" type="text">
        <span class="input-group-btn">
            <button class="btn btn-success btn-lg" type="submit"
                    data-icon="&#xe600;"></button>
        </span>
    </div>
</form>


<h1>Dostępne API</h1>

<?php foreach($apis as $api) { ?>

<h3><?php echo $api['name'] ?></h3>

<p><?php echo $api['description'] ?></p>

<a href="<?php echo $this->Html->url(array('action' => 'view', 'version' => $version, 'slug' => $api['slug'])); ?>">Zobacz</a>

<?php } ?>

<h1>Klienci API</h1>