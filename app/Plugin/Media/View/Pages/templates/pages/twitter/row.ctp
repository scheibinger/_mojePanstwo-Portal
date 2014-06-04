<div class="row rank-row">
    <? if ($group['mode'] == 'tags') { ?>
        <ul id="tagsCloud">
            <?
            foreach ($stats['tags'] as $tag) {
                $href = '/dane/twitter/?!bez_retweetow=1&tags[]=' . $tag['id'];
                ?>
                <li style="font-size: <?= $tag['size'] ?>px;"><a href="<?= $href ?>"><?= $tag['tag'] ?></a></li>
            <? } ?>
        </ul>
    <? } else { ?>
        <? foreach ($group['types'] as $type) { ?>
            <div class="col-md-2 rank-col">
                <h4 class="label label-<?= $type['class'] ?>"><a href="/dane/twitter_accounts/?typ_id[]=<?= $type['id'] ?>"><?= $type['title'] ?></a></h4>
                <? include('mode.ctp'); ?>
            </div>
        <? } ?>
    <? } ?>
</div>