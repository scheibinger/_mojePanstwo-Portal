<?
$fid = 1;
$name = 'name';
$label = 'label';
?>

<ul class="options list-group">

    <li class="option checkbox list-group-item">
        <? /*<span class="badge"><?=$this->Number->currency($option['count'], '', array('places' => 0)) ?></span> */ ?>
        <div class="checkbox-inline">
            <input id="<?= $fid ?>" type="checkbox" name="<?= $name ?>[]" value=""/>
            <label for="<?= $fid ?>"><?= $label ?></label>
        </div>
    </li>

</ul>



