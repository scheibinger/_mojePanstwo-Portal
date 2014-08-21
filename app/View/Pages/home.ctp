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

	<div class="apps row">

		<div class="h2cont"><h2 class="col-lg-10 col-lg-offset-1">Dane publiczne:</h2></div>
		<div class="col-md-12 col-lg-12">
			<div class="globalSearch row">
				<div class="col-sm-10 col-md-10 col-lg-10 col-sm-offset-1 col-md-offset-1 col-lg-offset-1">

					<div class="input-group">
						<form action="/dane/szukaj" method="get">
							<input name="q" type="text" class="form-control" autocomplete="off"
							       placeholder="<?php echo __('LC_SEARCH_PUBLIC_DATA_PLACEHOLDER') ?>">
							<input type="submit" value="search" name="submit" style="display: none;"/>
			                <span class="input-group-btn">
			                    <button class="btn btn-success btn-lg" type="button" data-icon="&#xe600;"></button>
			                </span>
						</form>
					</div>

					<ul class="buttons-group">
						<li><a href="/dane" class="btn btn-default">Zbiory danych &raquo;</a></li>
						<li><a href="/powiadomienia" class="btn btn-default">Skonfiguruj powiadomienia &raquo;</a></li>
					</ul>

				</div>
			</div>
		</div>

		<div class="h2cont"><h2 class="col-lg-10 col-lg-offset-1">Aplikacje:</h2></div>
		<div class="col-md-12 col-lg-12">
			<ul class="row">
				<?php foreach ($_APPLICATIONS as $key => $app) {

					if ($app['home'] == '1') {
						?>
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
					<?php
					}

				} ?>
			</ul>
		</div>
	</div>

</div>