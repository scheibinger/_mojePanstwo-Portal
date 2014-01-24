<?php $this->Combinator->add_libs('css', $this->Less->css('ustawy', array('plugin' => 'Ustawy'))) ?>

<div class="container" id="ustawy">
    <?php echo $this->element('searchbar'); ?>
    <ul class="list-group">
        <? foreach ($objects['Dataobject'] as $object) {

            $this->Dataobject->setObject($this, $object);
            echo $this->Dataobject->render();

        } ?>
    </ul>
</div>