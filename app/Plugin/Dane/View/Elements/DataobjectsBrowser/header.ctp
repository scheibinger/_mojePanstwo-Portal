<form class="nopadding" method="get" action="<?= $page['href'] ?>">

	<div class="input-group">
		<input id="innerSearch" type="text" class="form-control" autocomplete="off" name="q" placeholder="<?= __d('dane', __('LC_DANE_SEARCH'))?>" data-icon-after="&#xe600;" value="<?= ((isset($this->params->query['q'])) ? htmlspecialchars($this->params->query['q']) : '')?>" />
		<span class="input-group-btn">
			<button type="button" class="btn btn-primary"><span class="glyphicon glyphicon-search"></span></button>
	    </span>
	</div>
	
	<? if( isset($didyoumean) && $didyoumean ) {?>
	<div class="row dataDidyoumean">
		<div class="col-md-12">
			Czy chodziło Ci o "<a href="#"><?= $didyoumean ?></a>"?
		</div>
	</div>
	<? } ?>
	
	<div class="row dataSubheader">
		<div class="col-xs-12 col-sm-4 dataStats">
		    <div class="row">
		    	<p>1 - 20 z <?= _number($pagination['total']) ?></p>
		    </div>
		</div>
		<div class="col-xs-12 col-sm-8 dataSortings">
		    <div class="row">
			
	            <?php // echo $this->Form->submit(__d('dane', 'LC_DANE_SORTUJ'), array('name' => 'search', 'class' => 'sortingButton btn btn-primary input-sm hidden-xs')); ?>
	
	            <?
	            $_query = $this->request->query;
	            unset($_query['order']);
	            unset($_query['search']);
	
	            foreach ($_query as $key => $value) {
	                if (is_array($value)) {
	                    foreach ($value as $_value) {
	                        if ($_value != '')
	                            echo '<input type="hidden" name="' . $key . '[]" value="' . htmlspecialchars($_value) . '" />';
	                    }
	                } else {
	                    if ($value != '')
	                        echo '<input type="hidden" name="' . $key . '" value="' . htmlspecialchars($value) . '" />';
	                }
	            }
	            ?>
	            
	            <? if( isset($controlls) && !empty($controlls) ) { ?>
	            
	            <div class="dataButtons btn-group">
			        
			        <? foreach( $controlls as $controll ) { ?>
			        	
			        	<? if( $controll == 'details' ) { ?>
			        	
			            <button class="dataDetailsToggle btn btn-default btn-sm" data-state="more"><span class="glyphicon glyphicon glyphicon-plus"></span> <span class="text">Więcej szczegółów</span></button> 
			            
			            <? } elseif( $controll == 'sortings' ) { ?>
			            
				            <? if( !empty($orders) ) { ?>

				            <div class="btn-group">
					            <button class="dataSortingToggle dropdown-toggle btn btn-default btn-sm" data-toggle="dropdown"><span class="glyphicon glyphicon-sort"></span> <span class="text">Sortowanie</span></button>
					            <ul class="dataSortingMenu dropdown-menu" role="menu" ></ul>
					            <select style="display: none;" id="DatasetSort" class="form-control input-sm" name="order">
					                <?
					                foreach ($orders as $order) {
					                    if ($order['sorting']['field'] == 'score') {
					                        ?>
					                        <optgroup data-special="result">
					                            <option<? if (isset($order['selected_direction'])) { ?> selected="selected"<? } ?>
					                                value="<?= $order['sorting']['field'] ?> desc"
					                                title="<?= $order['sorting']['label'] ?>"><?= $order['sorting']['label'] ?>
					                            </option>
					                        </optgroup>
					                    <?
					                    } else {
					                        ?>
					                        <optgroup label="<?= $order['sorting']['label'] ?>">
					                            <option<? if (isset($order['selected_direction']) && $order['selected_direction'] == 'desc') { ?> selected="selected"<? } ?>
					                                value="<?= $order['sorting']['field'] ?> desc"
					                                title="<?= $order['sorting']['label'] . ' (' . __d('dane', 'LC_DANE_SORTOWANIE_MALEJACO') . ')' ?>"><?= __d('dane', 'LC_DANE_SORTOWANIE_MALEJACO') ?>
					                            </option>
					                            <option<? if (isset($order['selected_direction']) && $order['selected_direction'] == 'asc') { ?> selected="selected"<? } ?>
					                                value="<?= $order['sorting']['field'] ?> asc"
					                                title="<?= $order['sorting']['label'] . ' (' . __d('dane', 'LC_DANE_SORTOWANIE_ROSNACO') . ')' ?>"><?= __d('dane', 'LC_DANE_SORTOWANIE_ROSNACO') ?>
					                            </option>
					                        </optgroup>
					                    <?
					                    }
					                }
					                ?>
					            </select>
				            </div>
				            
				            <? } ?>
			            
			            <? } ?>
			            
			        <? } ?>
			            
	            </div>	
	            
	            <? } ?>	            
		
		    </div>
		</div>
	</div>

</form>