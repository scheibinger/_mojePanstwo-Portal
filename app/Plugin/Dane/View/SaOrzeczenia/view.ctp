<?php $this->Combinator->add_libs('css', $this->Less->css('view-saorzeczenia', array('plugin' => 'Dane'))); ?>

<?= $this->Element('dataobject/pageBegin'); ?>
    <div class="object">
        <div class="document col-md-9">
            <?php echo $html['body']; ?>
        </div>
        <div class="sidebox col-md-3">
            <ul>
                <li><?php echo __d('dane', 'LC_DANE_DATA_WPLYWU') . ': <strong>' . $this->Czas->dataSlownie($object->getData('data_wplywu')) . '</strong>'; ?></li>
                <li><?php echo __d('dane', 'LC_DANE_DATA_ORZECZENIA') . ': <strong>' . $this->Czas->dataSlownie($object->getData('data_orzeczenia')) . '</strong>'; ?></li>
                <li><?php echo __d('dane', 'LC_DANE_DLUGOSC_ROZPATRYWANIA') . ': ' . pl_dopelniacz($object->getData('dlugosc_rozpatrywania'), 'dzień', 'dni', 'dni'); ?></li>
            </ul>
        </div>
    </div>
<?= $this->Element('dataobject/pageEnd'); ?>