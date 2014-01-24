<? if ($object->hasRelated()) {
    $related = $object->getLayer('related');
    $groups = $related['groups']; ?>

    <div class="container">
        <div class="objectsPageContent related<? if (!isset($showRelated) || !$showRelated) { ?> hide<? } ?>">
            <div class="related_div col-md-10">
                <ul>
                    <? foreach ($groups as $group) { ?>
                        <li class="related_li <?= $group['id'] ?>">
                            <h4><?= $group['title'] ?>:</h4>
                            <? $objects = $group['objects'];
                            if (!empty($objects)) {
                                ?>
                                <ul>
                                    <? foreach ($objects as $object) { ?>
                                        <li class="related_li_inner">
                                            <?= $this->Dataobject->render($object); ?>
                                        </li>
                                    <? } ?>
                                </ul>
                            <? } ?>
                        </li>
                    <? } ?>
                </ul>
            </div>
        </div>
    </div>

<? } ?>