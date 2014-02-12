<?php $this->Combinator->add_libs('css', $this->Less->css('home')) ?>
<?php $this->Combinator->add_libs('js', 'home') ?>

<div id="home" class="container">
    <div class="header row">
        <div class="col-md-12">
            <h1>
                <?php echo __('LC_MAINHEADER_TEXT') ?>
            </h1>
        </div>
    </div>
	
	<? /*
    <div class="globalSearch row">
        <div class="col-sm-10 col-md-8 col-md-offset-2 col-lg-6 col-sm-offset-1 col-md-offset-2 col-lg-offset-3">

            <div class="input-group">
                <form action="/dane" method="get">
                    <input name="q" type="text" class="form-control"
                           placeholder="<?php echo __('LC_SEARCH_PUBLIC_DATA_PLACEHOLDER') ?>">
                    <input type="submit" name="submit" style="display: none;"/>
	                <span class="input-group-btn">
	                    <button class="btn btn-default" type="button" data-icon="&#xe600;"></button>
	                </span>
                </form>
            </div>

        </div>
    </div>
	*/ ?>
	
	
	<? foreach( $folders as $folder )
	{
	?>
    <div class="apps row">
		<? if($folder['folder']['name']) {?><div class="h2cont"><h2 class="col-lg-10 col-lg-offset-1"><? echo $folder['folder']['name']; ?>:</h2></div><?}?>
        <div class="col-md-12 col-lg-12">
            <ul class="row">
                <?php foreach ( $folder['apps'] as $key => $app ) { ?>
                    <li class="col-xs-5 col-sm-2<?php
                    if ($key % 2 == 0)
                        echo(' ' . 'col-xs-offset-1');
                    if ($key % 2 == 0 && $key % 5 != 0)
                        echo(' ' . 'col-sm-offset-0');
                    if ($key % 5 == 0)
                        echo(' ' . 'col-sm-offset-1');
                    ?>">
	                    <a class="appContruct" href="/<?= $app['slug'] ?>">
	                        <div class="appIcon">
	                            <div class="innerIcon">
	                                <img
	                                    src="/<?= $app['plugin'] ?>/icon/<?= $app['slug'] ?>.svg"
	                                    alt="<?= $app['name'] ?>"/>
	                            </div>
	                        </div>
	                        <div class="appName">
	                            <?= $app['name'] ?>
	                        </div>
	                    </a>
                    </li>
                <?php } ?>
            </ul>
        </div>
    </div>
	<? } ?>

</div>