<div class="row">
    <div class="content col-md-12">
        <p class="header">
            <?php echo __d('dane', 'LC_DANE_CRAWLER_SITES_HEADLINE'); ?>
        </p>

        <p class="title">
            <a href="<?php echo $this->Html->url(array('plugin' => 'Dane', 'controller' => $item['dataset'], 'action' => 'view', 'id' => $item['object_id'])); ?>"
               title="<?php if ($item['data']['nazwa'] !== '') {
                   echo $item['data']['nazwa'];
               } else {
                   echo $item['data']['url'];
               } ?>"><?php if ($item['data']['nazwa'] !== '') {
                    echo $item['data']['nazwa'];
                } else {
                    echo $item['data']['url'];
                } ?></a>
        </p>

        <p class="line signature"><?php echo __d('dane', 'LC_DANE_CRAWLER_SITES_LINKS', true) . ': <strong>' . $item['data']['liczba_linkow'] . '</strong>'; ?></p>

        <p class="line signature"><?php echo __d('dane', 'LC_DANE_CRAWLER_SITES_DOCUMENTS', true) . ': <strong>' . $item['data']['liczba_dokumentow'] . '</strong>'; ?></p>
    </div>
</div>