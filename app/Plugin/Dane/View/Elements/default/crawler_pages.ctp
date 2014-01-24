<div class="row">
    <div class="attachment col-md-2">
        <a href="<?php echo $this->Html->url(array('plugin' => 'Dane', 'controller' => $item['dataset'], 'action' => 'view', 'id' => $item['object_id'])); ?>">
            <img
                src="http://crawler.sds.tiktalik.com/thumbnail/<?php echo $item['data']['id']; ?>.jpg" alt=""/>
        </a>
    </div>
    <div class="content col-md-10">
        <p class="header">
            <?php echo $item['data']['crawler_sites.nazwa'] ?>
        </p>

        <p class="title">
            <a href="<?php echo $this->Html->url(array('plugin' => 'Dane', 'controller' => $item['dataset'], 'action' => 'view', 'id' => $item['object_id'])); ?>"
               title="<?php echo $item['data']['title'] ?>"><?php echo $item['data']['title'] ?></a>
        </p>

        <p class="line signature">
            <?php echo __d('dane', 'LC_DANE_CRAWLER_PAGES_SIZE', true) . ': ' . '<strong>' . $this->Number->toReadableSize($item['data']['liczba_rozmiar']) . '</strong>'; ?>
        </p>

        <p class="line signature">
            <?php echo __d('dane', 'LC_DANE_CRAWLER_PAGES_CONTENT', true) . ': <strong>' . $item['data']['content_type'] . '</strong>'; ?>
        </p>
    </div>
</div>