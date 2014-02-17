<div class="dataContent">
    <div class="results">
        <div class="showResults">
            <div class="objects">
                <?php if (true) { //@ TODO : przywrocic?>
                    <div class="powiadomienia">
                        <?php foreach ($objects as $object) {
                            echo $this->Dataobject->render($object, 'default', array(
                                'forceLabel' => true,
                            ));
                        } ?>
                    </div>
                    <div class="loadMoreContent" data-currentpage="1"></div>
                    <div class="loading"></div>
                <?php } else { ?>
                    <div class="msg">
                        <p><?php echo __d('powiadomienia', "LC_POWIADOMIENIA_DANE_NO_KEYWORDS") ?></p>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>