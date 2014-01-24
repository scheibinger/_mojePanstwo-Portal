<?= $this->Element('dataobject/pageBegin'); ?>
    <div class="col-md-12 row legislacjaProjekty">
        <div class="object">
            <div class="col-md-10 col-md-offset-1">
                <?php foreach ($object->layers['related']['groups'] as $group) { ?>
                    <div class="panel panel-info">
                        <div class="panel-heading">
                            <h3 class="panel-title"><?php echo $group['title']; ?></h3>
                        </div>
                        <div class="panel-body">
                            <?php foreach ($group['objects'] as $obj) { ?>
                                <?php echo $this->Dataobject->render($obj); ?>
                            <?php } ?>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
<?= $this->Element('dataobject/pageEnd'); ?>