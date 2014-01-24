<div class="keywords">
    <h2><?php echo __d('powiadomienia', "LC_POWIADOMIENIA_FRAZY_USER") ?>:</h2>
    <ul>
        <?php if ($phrases) {
            foreach ($phrases as $index => $phrase) {
                ?>
                <li class="s<?php if ($phrase['UserPhrase']['alerts_unread_count']) { ?> nonzero<?php } ?>"
                    data-id="<?php echo $phrase['Phrase']['id']; ?>"
                    title="<?php echo str_replace('"', '', $phrase['Phrase']['q']); ?>">
                    <div class="inner radio-inline">
                        <input type="radio" name="data[Dataobject][ids]" id="PowiadomieniaFrazaId<?php echo $index ?>"
                               value="<?php echo $phrase['Phrase']['id']; ?>" <?php echo (isset($this->data['Dataobject']['ids']) && $this->data['Dataobject']['ids'] == $phrase['Phrase']['id']) ? 'checked' : null; ?>/>
                        <label for="PowiadomieniaFrazaId<?php echo $index ?>">
                            <?php echo $phrase['Phrase']['q']; ?>
                            <span
                                <?php if ($phrase['UserPhrase']['alerts_unread_count'] > 0) { ?>class="nonzero"<?php } ?>>
                                <?= $phrase['UserPhrase']['alerts_unread_count']; ?>
                            </span>
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

    <button class="btn btn-primary">Filtruj</button>

</div>