<?php if (!(isset($_COOKIE['_mPCookieLaw']) && ($_COOKIE['_mPCookieLaw']))) { ?>
    <div class="cookieLaw">
        <div class="container">
            <p>Strona korzysta z plików cookies</p>
            <button class="btn btn-success btn-xs pull-right">Rozumiem</button>
        </div>
    </div>
<?php } ?>
<footer>
    <div class="container">
        <div class="col-lg-4 pull-left">
            <?php echo $this->Html->link(__('LC_FOOTER_ABOUT_US'), '/oportalu', array('target' => '_self')); ?>
            <span class="separator">|</span>
            <?php echo $this->Html->link(__('LC_FOOTER_API'), 'http://api.mojepanstwo.pl', array('target' => '_self')); ?>
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