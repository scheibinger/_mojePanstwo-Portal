<div class="row dimmed">
    <div class="content col-md-12">
        <div class="col-md-1">
            <a href="<?php echo $this->Html->url(array('plugin' => 'Dane', 'controller' => $item['dataset'], 'action' => 'view', 'id' => $item['object_id'])); ?>">
                <img
                    src="http://resources.sejmometr.pl/mowcy/a/2/<?php echo $item['data']['mowca_id'] ?>.jpg"
                    alt="<?php echo $item['data']['mowca_id'] ?>"/>
            </a>
        </div>
        <div class="col-md-11">
            <p class="line signature"><?php echo __d('dane', 'LC_DANE_SEJM_INTERPELACJE_DATE_ENTRY', true) . ': <strong>' . $this->Czas->dataSlownie($item['data']['data_wplywu']) . '</strong>'; ?></p>

            <p class="line signature"><?php echo __d('dane', 'LC_DANE_AUTHOR', true) . ': <strong>' . $item['data']['poslowie_str'] . '</strong>'; ?></p>

            <p class="line signature"><?php echo __d('dane', 'LC_DANE_SEJM_INTERPELACJE_ADDRESSEE', true) . ': <strong>' . $item['data']['adresaci_str'] . '</strong>'; ?></p>
        </div>
    </div>
</div>