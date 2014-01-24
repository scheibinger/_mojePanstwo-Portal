<?php $this->Combinator->add_libs('css', $this->Less->css('view-crawlersites', array('plugin' => 'Dane'))) ?>

<div id="crawlerSites">
    <iframe id="crawlerSitesWindow" src="<?= $object->data['url']; ?>" frameborder="0" height="100%"
            width="100%"></iframe>
</div>