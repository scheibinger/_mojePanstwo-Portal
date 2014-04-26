<?php $this->Combinator->add_libs('css', $this->Less->css('view-zamowieniapubliczne', array('plugin' => 'Dane'))); ?>
<?php $this->Combinator->add_libs('js', 'Dane.view-zamowieniapubliczne'); ?>


<?= $this->Element('dataobject/pageBegin'); ?>

    <div class="row">
        <div class="col-lg-9">

            <div class="object mpanel">
				
				<div class="block-group">
				
				<?
					foreach( $object->getLayer('details') as $key => $value ) { if( $value ) {
				?>
				
				
				
				
                <div class="block">
                    <div class="block-header">
	                    <h2 class="pull-left label"><?php echo __d('dane', __('LC_DANE_VIEW_ZAMOWIENIAPUBLICZNE_' . $key)); ?></h2>
                    </div>

                    <div class="content">

                        <div class="textBlock"><?php echo( $value ); ?></div>

                    </div>
                </div>
                
                <? } } ?>
                
				</div>

               
                
                <div id="source">
                	
                </div>

            </div>

        </div>
        <div class="col-lg-3">

            <div class="block nosidepadding">
                <h2><?php echo __d('dane', __('LC_DANE_VIEW_ZAMOWIENIAPUBLICZNE_ZAMAWIAJACY')); ?></h2>

                <div class="content">
                    <ul>
                        <li class="title"><?php echo $object->getData('zamawiajacy_nazwa'); ?></li>
                        <li>
                            <a href="<?php echo (preg_match('/http\:\/\//', $object->getData('zamawiajacy_www'))) ? $object->getData('zamawiajacy_www') : 'http://' . $object->getData('zamawiajacy_www'); ?>"
                               target="_blank"><?php echo $object->getData('zamawiajacy_www'); ?></a></li>
                        <li>
                            <a href="mailto:<?php echo $object->getData('zamawiajacy_email'); ?>"><?php echo $object->getData('zamawiajacy_email'); ?></a>
                        </li>
                    </ul>
                </div>
            </div>

        </div>
    </div>

<? /*
    <div class="object">
        <div class="documentMain col-md-8">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h2><?php echo __d('dane', __('LC_DANE_VIEW_ZAMOWIENIAPUBLICZNE_PRZEDMIOT')); ?></h2>
                </div>
                <div class="panel-body">
                    <?php echo($details['przedmiot']); ?>
                </div>
            </div>
        </div>
        <div class="documentInfo col-md-4">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h2><?php echo __d('dane', __('LC_DANE_VIEW_ZAMOWIENIAPUBLICZNE_ZAMAWIAJACY')); ?></h2>
                </div>
                <div class="panel-body">
                    
                </div>
            </div>
        </div>
    </div>
    */
?>

<?= $this->Element('dataobject/pageEnd'); ?>

<script type="text/javascript">
	var zamowienie = {
		ogloszenie_nr: '<?= $object->getData('ogloszenie_nr') ?>',
		data: '<?= $object->getDate() ?>'
	};
</script>