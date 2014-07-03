<div class="objectPageHeaderContainer subobjectContainer">
    <div class="container">
        <div class="col-md-9">
            <div class="objectPageHeader">
                <?php
                echo $this->Dataobject->render($object, 'subobject', $objectOptions);
                ?>
            </div>
        </div>
        <div class="col-md-3">
            
			<? if( $neighbours = $object->getLayer('neighbours') ) {?>
			<ul class="pagination pagination-sm pagination-neighbours">
				<? if($neighbours['previous']) {?><li><a title="<?= addslashes($neighbours['previous']['title']) ?>" href="<?= $neighbours['previous']['id'] ?>">←</a></li><? } ?>
				<? if($neighbours['next']) {?><li><a title="<?= addslashes($neighbours['next']['title']) ?>" href="<?= $neighbours['next']['id'] ?>">→</a></li><? } ?>
			</ul>
			<? } ?>
            
        </div>
    </div>
</div>

<?
	if( isset($_submenu) && !empty($_submenu) )
		echo $this->Element('Dane.dataobject/menuTabs', array(
			'menu' => $_submenu,
		));
?>