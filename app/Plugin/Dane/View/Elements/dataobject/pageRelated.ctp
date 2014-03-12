<? if ($object->hasRelated()) {
    $related = $object->getLayer('related');
    $groups = $related['groups']; ?>


    <div class="mpanel related_div"<? if (!$showRelated) { ?> style="display: none;"<? } ?>>
        <div class="col-lg-9">
            <ul>
                <? foreach ($groups as $group) { ?>
                    <li class="related_li <?= $group['id'] ?>">

                        <div class="block">
                            <h2 class="underline"><?= $group['title'] ?>:</h2>

                            <div class="content">
                                <? $objects = $group['objects'];
                                if (!empty($objects)) {
                                    ?>
                                    <ul>
                                        <? foreach ($objects as $object) { ?>
                                            <li class="related_li_inner">
                                                <?=
                                                $this->Dataobject->render($object, 'default', array(
                                                    'forceLabel' => true,
                                                )); ?>
                                            </li>
                                        <? } ?>
                                    </ul>
                                <? } ?>
                            </div>
                        </div>

                    </li>
                <? } ?>
            </ul>
        </div>
    </div>


<? } ?>