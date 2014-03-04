<?php if (!(isset($_COOKIE['_mPCookieLaw']) && ($_COOKIE['_mPCookieLaw']))) { ?>
    <div class="cookieLaw">
        <div class="container">
            <div class="row col-xs-12 col-sm-10">
                <p>Strona korzysta z plików cookies w celu realizacji usług. Możesz określić warunki przechowywania lub
                    dostępu do plików cookies w Twojej przeglądarce.</p>
            </div>
            <div class="row col-xs-12 col-sm-2 text-center">
                <button class="btn btn-default btn-sm">Rozumiem</button>
            </div>
        </div>
    </div>
<?php } ?>
<footer>
    <div>
        <div class="col-lg-4 pull-left">
            <?php echo $this->Html->link(__('LC_FOOTER_ABOUT_US'), '/pages/about_us', array('target' => '_self')); ?>
            <span class="separator">|</span>
            <?php echo $this->Html->link(__('LC_FOOTER_REGULATIONS'), '/pages/regulations', array('target' => '_self')); ?>
            <span class="separator">|</span>
            <?php echo $this->Html->link(__('LC_FOOTER_REPORT_BUG'), '/pages/report_bug', array('target' => '_self')); ?>
            <? /*
            <span class="separator">|</span>
            <?php echo $this->Html->link(__('LC_FOOTER_CONTACT_US'), '/pages/contact_us', array('target' => '_self')); ?>
            */
            ?>
        </div>
        <div class="col-lg-4 pull-right">
            <?php echo __('LC_FOOTER_COPYRIGHTS') ?>
            <span class="separator">|</span>
            <a href="http://epf.org.pl" target="_blank">
                <?php echo __('LC_FOOTER_EPF') ?>
            </a>
        </div>
    </div>
</footer>