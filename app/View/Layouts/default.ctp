<!DOCTYPE html>
<html lang="en">
<head>
    <title><?= htmlspecialchars(strip_tags($title_for_layout)) ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php echo $this->Html->meta('favicon.ico', '/img/favicon/fav.ico', array('type' => 'icon')); ?>
    <link rel="apple-touch-icon" href="/img/favicon/apple-touch-icon.png">
    <link rel="apple-touch-icon" sizes="72x72" href="/img/favicon/apple-touch-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="114x114" href="/img/favicon/apple-touch-icon-114x114.png">
    <?php
    echo $this->Html->meta(array('property' => 'og:url', 'content' => Router::url($this->here, true)));
    echo $this->Html->meta(array('property' => 'og:type', 'content' => 'website'));
    echo $this->Html->meta(array('property' => 'og:title', 'content' => strip_tags($title_for_layout)));
    echo $this->Html->meta(array('property' => 'og:description', 'content' => strip_tags(__('LC_MAINHEADER_TEXT'))));
    echo $this->Html->meta(array('property' => 'og:image', 'content' => FULL_BASE_URL .
        '/img/favicon/facebook-400x400.png'));
    echo $this->Html->meta(array('property' => 'fb:admins', 'content' => '100000234760647'));
    echo $this->Html->meta(array('property' => 'fb:admins', 'content' => '100000078295509'));
    echo $this->Html->meta(array('property' => 'fb:admins', 'content' => '616010705'));
    echo $this->Html->meta(array('property' => 'fb:app_id', 'content' => FACEBOOK_appId));

    echo $this->Html->css('//fonts.googleapis.com/css?family=Lato:200,300,400,700,900,400italic');
    echo $this->Html->css('//ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/themes/ui-darkness/jquery-ui.min.css');

    $this->Combinator->add_libs('css', $this->Less->css('jquery/jquery-ui-customize'), false);
    $this->Combinator->add_libs('css', $this->Less->css('statusbar'), false);
    $this->Combinator->add_libs('css', $this->Less->css('main'), false);
    $this->Combinator->add_libs('css', $this->Less->css('flatly'), false);

    /* GLOBAL CSS FOR LOGIN FORM FOR PASZPORT PLUGIN*/
    $this->Combinator->add_libs('css', $this->Less->css('loginForm', array('plugin' => 'Paszport')), false);

    /*BOOTSTRAP SELECT LOOKS LIKE BOOTSTRAP BUTTONS*/
    echo $this->Html->css('../js/plugins/bootstrap-select/bootstrap-select.min.css');

    /* SOCIAL BUTTONS */
    echo $this->Html->css('//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css');
    $this->Combinator->add_libs('css', $this->Less->css('social-buttons'), false);

    /* HAD TO BE EXCLUDED CAUSE ERRORS AT BOOTSTRAP */
    echo $this->Html->css('//netdna.bootstrapcdn.com/bootstrap/3.0.2/css/bootstrap.min.css');
    echo $this->Combinator->scripts('css');

    /* BLOCK FOR SPECIAL STYLES THAT CANNOT BE MERGE TO ONE FILE*/
    echo $this->fetch('cssBlock');

    /* ENHANCE SCRIPTS */
    echo $this->Html->script('enhance');
    ?>

    <!--[if lt IE 9]>
    <?php echo $this->Html->script('ie/html5shiv.js'); ?>
    <?php echo $this->Html->script('ie/respond.js'); ?>
    <![endif]-->
</head>
<body>
<div id="_wrapper">
    <header>
        <?php /*echo $_PORTAL_HEADER; */ ?>
        <?php echo $this->Element('statusbar', array(
            'mode' => @$statusbarMode,
            'applications' => array(
                'list' => @$_APPLICATIONS,
                'perPage' => 6,
                'perRow' => 3,
            ),
            'applicationCurrent' => @$_APPLICATION,
            'applicationCrumbs' => @$statusbarCrumbs,
            'streams' => $this->Session->read('Auth.User.streams'),
        ));
        echo $this->Element('Paszport.modal_login');
        ?>
    </header>
    <?php if ($this->Session->read('Message.flash.message')) { ?>
        <div class="flash-message">
            <div class="alert <?php echo (isset($class)) ? $class : 'alert-info'; ?>">
                <div class="container">
                    <?php if (isset($close)): ?>
                        <a class="close" data-dismiss="alert" href="#">×</a>
                    <?php endif; ?>
                    <?php echo $this->Session->flash(); ?>
                </div>
            </div>
        </div>
    <?php } ?>
    <?php if ($this->Session->read('Message.auth.message')) { ?>
        <div class="flash-message">
            <div class="alert <?php echo (isset($class)) ? $class : 'alert-info'; ?>">
                <div class="container">
                    <?php if (isset($close)): ?>
                        <a class="close" data-dismiss="alert" href="#">×</a>
                    <?php endif; ?>
                    <?php echo $this->Session->flash('auth'); ?>
                </div>
            </div>
        </div>
    <?php } ?>
    <div id="_main">

        <?php echo $content_for_layout; ?>

    </div>
    <div id="_sizeControl"></div>
</div>
<?php echo $this->element('footer'); ?>

<?php /* GOOGLE ANALYTIC */ ?>
<script type="application/javascript">
    (function (i, s, o, g, r, a, m) {
        i['GoogleAnalyticsObject'] = r;
        i[r] = i[r] || function () {
            (i[r].q = i[r].q || []).push(arguments)
        }, i[r].l = 1 * new Date();
        a = s.createElement(o),
            m = s.getElementsByTagName(o)[0];
        a.async = 1;
        a.src = g;
        m.parentNode.insertBefore(a, m)
    })(window, document, 'script', '//www.google-analytics.com/analytics.js', 'ga');

    ga('create', 'UA-3303173-6', 'mojepanstwo.pl');
    ga('send', 'pageview');
</script>

<?php
echo $this->Html->script('//ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js');
echo $this->Html->script('//ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js');
echo $this->Html->script('//ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/i18n/jquery-ui-i18n.min.js');

echo $this->Html->script('//netdna.bootstrapcdn.com/bootstrap/3.0.2/js/bootstrap.min.js');

/* PACKAGES FROM VENDOR */
echo $this->Html->script('plugins/history.js/scripts/bundled/html4+html5/jquery.history.js');
echo $this->Html->script('plugins/jquery-cookie/jquery.cookie.js');
echo $this->Html->script('plugins/bootstrap-select/bootstrap-select.min.js'); ?>

<?php /*PHP DATA FOR JS */ ?>
<script type="text/javascript">
    var _mPHeart = {
        translation: jQuery.parseJSON('<?php echo json_encode($translation); ?>'),
        social: {
            facebook: {
                id: "<?php echo @FACEBOOK_appId; ?>",
                key: "<?php echo @FACEBOOK_apiKey; ?>"
            }
        },
        language: {
            twoDig: "<?php switch (Configure::read('Config.language')) { case 'pol': echo "pl"; break; case 'eng': echo "en"; break; }  ?>",
            threeDig: "<?php echo Configure::read('Config.language'); ?>"
        },
        globalSearch: {
            phrase: '<?php echo @htmlspecialchars($q) ?>',
            placeholder: 'Szukaj w danych publicznych...'
        }
    }
</script>

<?php
$this->Combinator->add_libs('js', 'statusbar', false);
$this->Combinator->add_libs('js', 'statusbar-portal', false);
$this->Combinator->add_libs('js', 'main', false);

/* BLOCK FOR SPECIAL SCRIPTS LIKE PROTOTYPE THAT CANNOT BE MERGE TO ONE FILE*/
echo $this->fetch('scriptBlock');
?>

<?php echo $this->Combinator->scripts('js'); ?>

</body>
</html>