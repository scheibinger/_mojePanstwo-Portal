<ul class="tabsList">
    <li data-mode="1"
        class="new<?php echo (isset($this->request->query['data']['Dataobject']['visited']) && $this->request->query['data']['Dataobject']['visited'] == '1') ? null : ' s'; ?>"
        title="new">
        <a href="#" data-icon-after="&#xe602;"><?php echo __d('powiadomienia', "LC_POWIADOMIENIA_DANE_NEW") ?>
            <?php
            /*
            * @TODO: fix this or remove permamently
            <small<?php $tempNumber = 9;
                if ($tempNumber > 0) {
                    echo ' nonzero';
                } ?>>
                <?php if ($tempNumber > 999) {
                    echo '999+';
                } else {
                    echo $tempNumber;
                } ?>
            </small>
             */
            ?>
        </a>
        <input type="submit" name="data[Dataobject][visited]" value="0"/>
    </li>
    <li data-mode="2"
        class="read<?php echo (isset($this->request->query['data']['Dataobject']['visited']) && $this->request->query['data']['Dataobject']['visited'] == '1') ? ' s' : null; ?>"
        title="read">
        <a href="#" data-icon-after="&#xe603;"><?php echo __d('powiadomienia', "LC_POWIADOMIENIA_DANE_READ") ?></a>
        <input type="submit" name="data[Dataobject][visited]" value="1"/>
    </li>
    <a class="notifyAllRead<?php if (true) { //@TODO : przywrocic
        echo ' hidden';
    } ?>" data-icon-after="&#xe604;"><?php echo __d('powiadomienia', "LC_POWIADOMIENIA_DANE_ALLREADED") ?></a>
</ul>

<? include('_objects.ctp'); ?>