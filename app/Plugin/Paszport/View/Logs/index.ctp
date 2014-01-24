<?php echo $this->Element('logged'); ?>

<div class="container userCenter">
    <div class="row">
        <div class="col-xs-12 col-sm-3">
            <?php echo $this->element('left_nav_block'); ?>
        </div>
        <div class="col-xs-12 col-sm-9">
            <h3><?php echo __d('paszport', $title_for_layout); ?></h3>

            <table class="logs table table-striped">
                <tr>
                    <th><?php echo __d('paszport', 'LC_PASZPORT_CREATED'); ?></th>
                    <th><?php echo __d('paszport', 'LC_PASZPORT_ACTION'); ?></th>
                    <th><?php echo __d('paszport', 'LC_PASZPORT_IP'); ?></th>
                    <th><?php echo __d('paszport', 'LC_PASZPORT_ADDITIONAL_INFO'); ?></th>
                </tr>
                <?php foreach ($this->data as $log) { ?>
                    <tr>
                        <td><a href="#" class="ago" data-toggle="tooltip"
                               data-original-title="<?php echo $log['Log']['created']; ?>"><?php echo $this->Time->timeAgoInWords($log['Log']['created']); ?></a>
                        </td>
                        <td><?php echo __d('paszport', $log['Log']['msg']); ?></td>
                        <td><?php echo $log['Log']['ip']; ?></td>
                        <td><?php echo $log['Log']['user_agent']; ?></td>
                    </tr>
                <?php } ?>
            </table>

        </div>
    </div>
</div>