<?php $this->Combinator->add_libs('css', $this->Less->css('view-wyborydarczyncy', array('plugin' => 'Dane'))); ?>

<?= $this->Element('dataobject/pageBegin'); ?>
    <div class="object">
        <div class="document col-md-10 col-md-offset-1">
            <table class="table table-stripped">
                <?php if ($object->getData('nazwa')) { ?>
                    <tr>
                        <th><?php echo __d('dane', 'LC_DANE_DARCZYNCY_NAZWA'); ?></th>
                        <td><?php echo $object->getData('nazwa'); ?></td>
                    </tr>
                <?php } ?>
                <?php if ($object->getData('data_urodzenia')) { ?>
                    <tr>
                        <th><?php echo __d('dane', 'LC_DANE_DARCZYNCY_DATA_URODZENIA'); ?></th>
                        <td><?php echo $object->getData('data_urodzenia'); ?></td>
                    </tr>
                <?php } ?>
                <?php if ($object->getData('miejsce_urodzenia')) { ?>
                    <tr>
                        <th><?php echo __d('dane', 'LC_DANE_DARCZYNCY_MIEJSCE_URODZENIA'); ?></th>
                        <td><?php echo $object->getData('miejsce_urodzenia'); ?></td>
                    </tr>
                <?php } ?>
                <?php if ($object->getData('wyksztalcenie')) { ?>
                    <tr>
                        <th><?php echo __d('dane', 'LC_DANE_DARCZYNCY_WYKSZTALCENIE'); ?></th>
                        <td><?php echo $object->getData('wyksztalcenie'); ?></td>
                    </tr>
                <?php } ?>
                <?php if ($object->getData('dziedzina')) { ?>
                    <tr>
                        <th><?php echo __d('dane', 'LC_DANE_DARCZYNCY_DZIEDZINA'); ?></th>
                        <td><?php echo $object->getData('dziedzina'); ?></td>
                    </tr>
                <?php } ?>
                <?php if ($object->getData('zawod')) { ?>
                    <tr>
                        <th><?php echo __d('dane', 'LC_DANE_DARCZYNCY_ZAWOD'); ?></th>
                        <td><?php echo $object->getData('zawod'); ?></td>
                    </tr>
                <?php } ?>
                <?php if ($object->getData('powiazania_rodzinne')) { ?>
                    <tr>
                        <th><?php echo __d('dane', 'LC_DANE_DARCZYNCY_POWIAZANIA_RODZINNE'); ?></th>
                        <td><?php echo $object->getData('powiazania_rodzinne'); ?></td>
                    </tr>
                <?php } ?>
                <?php if ($object->getData('osoba')) { ?>
                    <tr>
                        <th><?php echo __d('dane', 'LC_DANE_DARCZYNCY_OSOBA'); ?></th>
                        <td><?php echo $object->getData('osoba'); ?></td>
                    </tr>
                <?php } ?>
                <?php if ($object->getData('rodzaj_powiazania')) { ?>
                    <tr>
                        <th><?php echo __d('dane', 'LC_DANE_DARCZYNCY_RODZAJ_POWIAZANIA'); ?></th>
                        <td><?php echo $object->getData('rodzaj_powiazania'); ?></td>
                    </tr>
                <?php } ?>
                <?php if ($object->getData('kontakt')) { ?>
                    <tr>
                        <th><?php echo __d('dane', 'LC_DANE_DARCZYNCY_KONTAKT'); ?></th>
                        <td><?php echo $object->getData('kontakt'); ?></td>
                    </tr>
                <?php } ?>
                <?php if ($object->getData('email')) { ?>
                    <tr>
                        <th><?php echo __d('dane', 'LC_DANE_DARCZYNCY_EMAIL'); ?></th>
                        <td><?php echo $object->getData('email'); ?></td>
                    </tr>
                <?php } ?>
                <?php if ($object->getData('www')) { ?>
                    <tr>
                        <th><?php echo __d('dane', 'LC_DANE_DARCZYNCY_WWW'); ?></th>
                        <td><?php echo $object->getData('www'); ?></td>
                    </tr>
                <?php } ?>
                <?php if ($object->getData('blog')) { ?>
                    <tr>
                        <th><?php echo __d('dane', 'LC_DANE_DARCZYNCY_BLOG'); ?></th>
                        <td><?php echo $object->getData('blog'); ?></td>
                    </tr>
                <?php } ?>
                <?php if ($object->getData('portale_spolecznosciowe')) { ?>
                    <tr>
                        <th><?php echo __d('dane', 'LC_DANE_DARCZYNCY_PORTALE_SPOLECZNOSCIOWE'); ?></th>
                        <td><?php echo $object->getData('portale_spolecznosciowe'); ?></td>
                    </tr>
                <?php } ?>
                <?php if ($object->getData('telefon')) { ?>
                    <tr>
                        <th><?php echo __d('dane', 'LC_DANE_DARCZYNCY_TELEFON'); ?></th>
                        <td><?php echo $object->getData('telefon'); ?></td>
                    </tr>
                <?php } ?>
                <?php if ($object->getData('adres')) { ?>
                    <tr>
                        <th><?php echo __d('dane', 'LC_DANE_DARCZYNCY_ADRES'); ?></th>
                        <td><?php echo $object->getData('adres'); ?></td>
                    </tr>
                <?php } ?>
                <?php if ($object->getData('dzialalnosc')) { ?>
                    <tr>
                        <th><?php echo __d('dane', 'LC_DANE_DARCZYNCY_DZIALALNOSC'); ?></th>
                        <td><?php echo $object->getData('dzialalnosc'); ?></td>
                    </tr>
                <?php } ?>
                <?php if ($object->getData('regon')) { ?>
                    <tr>
                        <th><?php echo __d('dane', 'LC_DANE_DARCZYNCY_REGON'); ?></th>
                        <td><?php echo $object->getData('regon'); ?></td>
                    </tr>
                <?php } ?>
                <?php if ($object->getData('data_od')) { ?>
                    <tr>
                        <th><?php echo __d('dane', 'LC_DANE_DARCZYNCY_DATA_OD'); ?></th>
                        <td><?php echo $object->getData('data_od'); ?></td>
                    </tr>
                <?php } ?>
                <?php if ($object->getData('data_do')) { ?>
                    <tr>
                        <th><?php echo __d('dane', 'LC_DANE_DARCZYNCY_DATA_DO'); ?></th>
                        <td><?php echo $object->getData('data_do'); ?></td>
                    </tr>
                <?php } ?>
                <?php if ($object->getData('udzial_w_przetargach')) { ?>
                    <tr>
                        <th><?php echo __d('dane', 'LC_DANE_DARCZYNCY_UDZIAL_W_PRZETARGACH'); ?></th>
                        <td><?php echo $object->getData('udzial_w_przetargach'); ?></td>
                    </tr>
                <?php } ?>
                <?php if ($object->getData('data')) { ?>
                    <tr>
                        <th><?php echo __d('dane', 'LC_DANE_DARCZYNCY_DATA'); ?></th>
                        <td><?php echo $object->getData('data'); ?></td>
                    </tr>
                <?php } ?>
                <?php if ($object->getData('inne')) { ?>
                    <tr>
                        <th><?php echo __d('dane', 'LC_DANE_DARCZYNCY_INNE'); ?></th>
                        <td><?php echo $object->getData('inne'); ?></td>
                    </tr>
                <?php } ?>
                <?php if ($object->getData('oswiadczenie_majatkowe')) { ?>
                    <tr>
                        <th><?php echo __d('dane', 'LC_DANE_DARCZYNCY_OSWIADCZENIE_MAJATKOWE'); ?></th>
                        <td><?php echo $object->getData('inne'); ?></td>
                    </tr>
                <?php } ?>
                <?php if ($object->getData('rok')) { ?>
                    <tr>
                        <th><?php echo __d('dane', 'LC_DANE_DARCZYNCY_ROK'); ?></th>
                        <td><?php echo $object->getData('rok'); ?></td>
                    </tr>
                <?php } ?>
                <?php if ($object->getData('uwagi')) { ?>
                    <tr>
                        <th><?php echo __d('dane', 'LC_DANE_DARCZYNCY_UWAGI'); ?></th>
                        <td><?php echo $object->getData('uwagi'); ?></td>
                    </tr>
                <?php } ?>
                <?php if ($object->getData('opis')) { ?>
                    <tr>
                        <th><?php echo __d('dane', 'LC_DANE_DARCZYNCY_OPIS'); ?></th>
                        <td><?php echo $object->getData('opis'); ?></td>
                    </tr>
                <?php } ?>
                <?php if ($object->getData('zrodla_danych')) { ?>
                    <tr>
                        <th><?php echo __d('dane', 'LC_DANE_DARCZYNCY_ZRODLA_DANYCH'); ?></th>
                        <td><?php echo $object->getData('zrodla_danych'); ?></td>
                    </tr>
                <?php } ?>
            </table>
        </div>
    </div>
<?= $this->Element('dataobject/pageEnd'); ?>