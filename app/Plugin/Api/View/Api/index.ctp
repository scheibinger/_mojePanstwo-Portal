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


<h1>Informacje ogólne</h1>

<div class="container-fluid">
    <div class="row">
        <div class="col-xs-4">
            <h3>Dlaczego otwarte dane?</h3>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam viverra sapien sit amet lacus sagittis euismod. Vestibulum ac nisl ultricies, venenatis nibh at, luctus ligula.</p>
            <a class="btn btn-primary" href="<?php echo $this->Html->url(array('action' => 'view')); ?>">Więcej</a>
        </div>

        <div class="col-xs-4">
            <h3>Opis techniczny</h3>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam viverra sapien sit amet lacus sagittis euismod. Vestibulum ac nisl ultricies, venenatis nibh at, luctus ligula.</p>
            <a class="btn btn-primary" href="<?php echo $this->Html->url(array('action' => 'technical_info')); ?>">Więcej</a>
        </div>

        <div class="col-xs-4">
            <h3>Dlaczego otwarte dane?</h3>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam viverra sapien sit amet lacus sagittis euismod. Vestibulum ac nisl ultricies, venenatis nibh at, luctus ligula.</p>
            <a class="btn btn-primary" href="<?php echo $this->Html->url(array('action' => 'view')); ?>">Więcej</a>
        </div>
    </div>
</div>


<h1>Dostępne API</h1>

<div class="container-fluid">
    <div class="row">
    <?php foreach($apis as $api) { ?>
        <div class="col-xs-4">
        <h3><?php echo $api['name'] ?></h3>

        <p><?php echo $api['description'] ?></p>

        <a class="btn btn-primary" href="<?php echo $this->Html->url(array('action' => 'view', 'version' => $version, 'slug' => $api['slug'])); ?>">Zobacz</a>
        </div>
    <?php } ?>
    </div>
</div>


<h1>Klienci API</h1>