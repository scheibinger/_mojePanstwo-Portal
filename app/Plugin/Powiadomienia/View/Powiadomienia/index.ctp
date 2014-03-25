<?php $this->Combinator->add_libs('css', $this->Less->css('powiadomienia', array('plugin' => 'Powiadomienia'))); ?>
<?php $this->Combinator->add_libs('css', $this->Less->css('frazy', array('plugin' => 'Powiadomienia'))); ?>
<?php $this->Combinator->add_libs('css', $this->Less->css('dane', array('plugin' => 'Powiadomienia'))); ?>
<?php $this->Combinator->add_libs('css', $this->Less->css('dataobject', array('plugin' => 'Dane'))); ?>

<?php echo $this->Html->script('../plugins/scriptaculous/lib/prototype', array('block' => 'scriptBlock')); ?>
<?php echo $this->Html->script('../plugins/scriptaculous/src/scriptaculous', array('block' => 'scriptBlock')); ?>
<?php $this->Combinator->add_libs('js', 'Powiadomienia.powiadomienia.js'); ?>

<div id="powiadomienia">
    <div class="content col-xs-12">

        <? /*
        <div class="searchPhrase col-md-3">
            <?php echo $this->Form->create('Phrase', array('url' => array('controller' => 'phrases', 'action' => 'index'), 'type' => 'get')); ?>
            <div class="form-group col-md-12 input-group">
                <?php echo $this->Form->input('addphrase', array('label' => false, 'class' => 'newPhrase form-control col-md-10', 'div' => false, 'placeholder' => __d('powiadomienia', "LC_POWIADOMIENIA_FRAZY_DODAJ_FRAZE"))); ?>
                <span class="input-group-btn">
                    <button class="btn btn-primary" type="submit">Dodaj</button>
                </span>
            </div>
            <?php echo $this->Form->end(); ?>
        </div>
        
        <div class="clearfix"></div>
        */
        ?>

        <div class="frazy col-xs-12 col-md-3 pull-left">

            <?php echo $this->element('Powiadomienia.phrases', array('phrases' => $phrases)); ?>

        </div>
        <div class="dane col-xs-12 col-md-9 pull-right">

            <?php echo $this->element('Powiadomienia.tabs'); ?>

            <?php echo $this->element('Powiadomienia.objects-container', array('objects' => $objects)); ?>

        </div>

    </div>
</div>