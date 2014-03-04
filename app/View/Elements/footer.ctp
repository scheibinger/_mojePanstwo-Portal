<?php if (!(isset($_COOKIE['_mPCookieLaw']) && ($_COOKIE['_mPCookieLaw']))) { ?>
    <div class="cookieLaw">
        <div class="container">
            <div class="row col-xs-8 col-sm-4 col-sm-offset-3">
                <p>Strona korzysta z plików cookies</p>
            </div>
            <div class="row col-xs-4 col-sm-2 text-center">
            <button class="btn btn-default btn-sm">Rozumiem</button>
            </div>
        </div>
    </div>
<?php } ?>
<footer>
    <div>
        <div class="col-lg-4 pull-left">
            <?php echo $this->Html->link(__('LC_FOOTER_ABOUT_US'), '/oportalu', array('target' => '_self')); ?>
            <span class="separator">|</span>
            <?php echo $this->Html->link(__('LC_FOOTER_REGULATIONS'), '/regulamin', array('target' => '_self')); ?>
            <span class="separator">|</span>
            <?php echo $this->Html->link(__('LC_FOOTER_REPORT_BUG'), '/zglosblad', array('target' => '_self')); ?>
            <? /*
            <span class="separator">|</span>
            <?php echo $this->Html->link(__('LC_FOOTER_CONTACT_US'), '/kontakt', array('target' => '_self')); ?>
            */
            ?>
        </div>
        <div class="col-lg-4 pull-right">
            <a href="http://epf.org.pl" target="_blank">
                <?php echo __('LC_FOOTER_EPF') ?>
            </a>
        </div>
    </div>
</footer>