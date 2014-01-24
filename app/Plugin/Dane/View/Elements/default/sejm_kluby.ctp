<div class="row">
    <div class="attachment col-md-2">
        <?php if ($item['data']['id'] != 7) { ?>
            <a href="<?php echo $this->Html->url(array('plugin' => 'Dane', 'controller' => $item['dataset'], 'action' => 'view', 'id' => $item['object_id'])); ?>">
                <img
                    src="http://resources.sejmometr.pl/s_kluby/<?php echo $item['data']['id'] ?>_t.png"
                    class="noBorder" alt=""/>
            </a>
        <?php } ?>
    </div>
    <div class="content col-md-10">
        <p class="header">
            <?php if ($item['data']['id'] == '7') { ?>
                <a href="<?php echo $this->Html->url(array('plugin' => 'Dane', 'controller' => $item['dataset'], 'action' => 'view', 'id' => $item['object_id'])); ?>"
                   title="<?php echo __d('dane', 'LC_DANE_SEJM_KLUBY_UNASSOCIATED_MP', true); ?>"><?php echo __d('dane', 'LC_DANE_SEJM_KLUBY_UNASSOCIATED_MP', true); ?></a>
            <?php } else { ?>
                <?php echo __d('dane', 'LC_DANE_SEJM_KLUBY_HEADER', true); ?>
            <?php } ?>
        </p>

        <p class="title">
            <a href="<?php echo $this->Html->url(array('plugin' => 'Dane', 'controller' => $item['dataset'], 'action' => 'view', 'id' => $item['object_id'])); ?>"
               title="<?php echo __d('dane', 'LC_DANE_SEJM_KLUBY_HEADER', true); ?> - <?php echo $item['data']['nazwa'] ?>">
                <?php echo $item['data']['nazwa'] ?>
            </a>
        </p>

        <p class="line signature">
            <?php echo __d('dane', 'LC_DANE_SEJM_KLUBY_NUMBER_MEMBERS', true) . ': <strong>' . $item['data']['liczba_poslow'] . '</strong>'; ?>
        </p>
        <?php
        $menOutput = null;
        $menNumbers = null;
        $womenOutput = null;
        $womenNumbers = null;

        switch ($womenNumbers = $item['data']['liczba_kobiet']) {
            case(($womenNumbers == 0) || ($womenNumbers > 1)):
                $womenOutput = $womenNumbers . ' kobiety';
                break;
            case($womenNumbers == 1):
                $womenOutput = $womenNumbers . ' kobieta';
                break;
        }

        switch ($menNumbers = $item['data']['liczba_kobiet']) {
            case(($menNumbers == 0) || ($menNumbers > 1)):
                $menOutput = $menNumbers . ' mężczyzn';
                break;
            case($menNumbers == 1):
                $menOutput = $menNumbers . ' mężczyzna';
                break;
        }
        ?>
        <p class="line signature">
            <small><?php echo $womenOutput . ', ' . $menOutput; ?></small>
        </p>
    </div>
</div>