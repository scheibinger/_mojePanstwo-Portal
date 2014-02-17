<?php $this->Combinator->add_libs('css', $this->Less->css('powiadomienia', array('plugin' => 'Powiadomienia'))); ?>
<?php $this->Combinator->add_libs('css', $this->Less->css('frazy', array('plugin' => 'Powiadomienia'))); ?>
<?php $this->Combinator->add_libs('css', $this->Less->css('dane', array('plugin' => 'Powiadomienia'))); ?>
<?php $this->Combinator->add_libs('css', $this->Less->css('dataobject', array('plugin' => 'Dane'))); ?>
<?php echo $this->Html->script('plugins/scriptaculous/lib/prototype', array('block' => 'scriptBlock')); ?>
<?php echo $this->Html->script('plugins/scriptaculous/src/scriptaculous', array('block' => 'scriptBlock')); ?>
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

        <?php // echo $this->Form->create('Dataobjects', array('type' => 'get')); ?>

        <div class="frazy col-xs-12 col-md-3 pull-left">

            <div class="keywords">
                <label><?php echo __d('powiadomienia', "LC_POWIADOMIENIA_FRAZY_USER") ?>:</label>
                <ul>
                    <?php if ($phrases) {
                        foreach ($phrases as $index => $phrase) {
                            ?>
                            <li class="<?php if (isset($this->request->query['keyword']) == false || $this->request->query['keyword'] == $phrase['Phrase']['id']) echo 's'; ?><?php if ($phrase['UserPhrase']['alerts_unread_count']) { ?> nonzero<?php } ?>"
                                data-id="<?php echo $phrase['Phrase']['id']; ?>"
                                title="<?php echo str_replace('"', '', $phrase['Phrase']['q']); ?>">
                                <div class="inner radio-inline">
                                    <input type="radio" name="data[Dataobject][ids]"
                                           id="PowiadomieniaFrazaId<?php echo $index ?>"
                                           value="<?php echo $phrase['Phrase']['id']; ?>" <?php echo (isset($this->data['Dataobject']['ids']) && $this->data['Dataobject']['ids'] == $phrase['Phrase']['id']) ? 'checked' : null; ?>/>
                                    <label for="PowiadomieniaFrazaId<?php echo $index ?>">
                                        <a class="wrap"
                                           href="<?php echo $this->Html->url(array("controller" => "powiadomienia", "action" => "index", "?" => array("keyword" => $phrase['Phrase']['id'], "mode" => (isset($this->request->query['mode'])) ? $this->request->query['mode'] : null))) ?>"
                                           target="_self">
                                            <?php echo $phrase['Phrase']['q']; ?>
                                        </a>

                                        <div class="count">
                                            <span
                                                class="badge<?php if ($phrase['UserPhrase']['alerts_unread_count'] > 0) { ?> nonzero<?php } ?>">
			                                    <?= $phrase['UserPhrase']['alerts_unread_count']; ?>
			                                </span>
                                        </div>
                                        <a href="<?php echo $this->Html->url(array('action' => 'remove', $phrase['UserPhrase']['id'])); ?>"
                                           class="delete pull-right" data-icon="&#xe601;"></a>
                                    </label>
                                </div>
                            </li>
                        <?
                        }
                    }?>

                    <span class="nokeywords<?php if ($phrases != null) {
                        echo ' hidden';
                    } ?>"><?php echo __d('powiadomienia', "LC_POWIADOMIENIA_FRAZY_NOKEYWORDS") ?><span>

                </ul>

                <? // <button class="btn btn-primary">Filtruj</button> ?>

            </div>

        </div>
        <div class="dane col-xs-12 col-md-9 pull-right">

            <? include('_alerts.ctp'); ?>

        </div>

        <?php // echo $this->Form->end(); ?>

    </div>
</div>