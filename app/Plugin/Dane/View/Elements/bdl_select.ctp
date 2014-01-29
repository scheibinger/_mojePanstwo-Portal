<?php $this->Combinator->add_libs('css', 'bootstrap-select'); ?>
<?php $this->Combinator->add_libs('css', $this->Less->css('bdl-select', array('plugin' => 'Dane'))); ?>

<?php $this->Combinator->add_libs('js', 'bootstrap-select'); ?>
<?php $this->Combinator->add_libs('js', 'Dane.bdl-select'); ?>

<form id="filters_form" class="bdl-select">
    <ul>
        <? foreach ($dims as $key => $d) {
            if ($key != $expanded_dim) {
                ?>
                <li>
                    <p class="label"><?= $d['label'] ?>:</p>

                    <p class="value">
                        <select onchange="document.getElementById('filters_form').submit();" name="w<?= $d['order'] ?>">
                            <? foreach ($d['options'] as $o) { ?>
                                <option<? if ($o['selected'] == true) { ?> selected="selected"<?php } ?>
                                    value="<?= $o['id'] ?>"><?= $o['value'] ?></option>
                            <? } ?>
                        </select>
                    </p>
                </li>
            <?
            }
        } ?>
    </ul>
</form>