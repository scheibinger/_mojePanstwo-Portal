<?
$this->Combinator->add_libs('css', $this->Less->css('media', array('plugin' => 'Media')));
$this->Combinator->add_libs('js', 'jquery-tags-cloud-min');
$this->Combinator->add_libs('js', 'Media.media');
?>

    <div class="col-lg-12 plate">
        <div class="container">
            <div class="header">
                <h1><?= __d('media', 'LC_PANSTWOINTERNET_HEADLINE') ?></h1>

                <? // include('templates/stats.ctp'); ?>
            </div>
            <? /*
            <? include('templates/intro.ctp'); ?>
            <? include('templates/navbar.ctp'); ?>
            */
            ?>
        </div>
    </div>

<? // include('templates/pages/media.ctp'); ?>
<? include('templates/pages/twitter.ctp'); ?>
<? // include('templates/pages/prawo.ctp'); ?>
<? // include('templates/pages/kontrowersje.ctp'); ?>
<? // include('templates/pages/wnioski.ctp'); ?>
<? // include('templates/pages/ofundacji.ctp'); ?>
<? // include('templates/pages/dodatek_najpopularniejsi.ctp'); ?>