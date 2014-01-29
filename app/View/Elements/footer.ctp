<footer>
    <div>
        <div class="col-lg-4 pull-left">
            <?php echo $this->Html->link(__('LC_FOOTER_REGULATIONS'), '/pages/regulations', array('target' => '_self')); ?>
            <span class="separator">|</span>
            <?php echo $this->Html->link(__('LC_FOOTER_REPORT_BUG'), '/pages/report_bug', array('target' => '_self')); ?>
            <span class="separator">|</span>
            <?php echo $this->Html->link(__('LC_FOOTER_CONTACT_US'), '/pages/contact_us', array('target' => '_self')); ?>
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